<?php

namespace SuperNoelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SuperNoelBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ElveHomeController
 * @route("/elfes")
 */
class ElvesHomeController extends Controller
{
    const Malus = 4;

    /**
     * @Route("/")
     */
    public function elvesAction()
    {
        // Connection Manager
        $em = $this->getDoctrine()->getManager();

        // Récupérer les cadeaux non traité
        $gifts = $em->getRepository('SuperNoelBundle:Gift')
            ->findBy(['treated' => false], ['id'=>'ASC'], 1, 0);

        // S'il retourne un résultat
        if (!empty($gifts)) {

            // Récupérer Id de l'enfant
            $idChild = $gifts[0]->getChild()->getId();

            // Récupérer liste des cadeaux de l'enfant en cours
            $wishlist = $em->getRepository('SuperNoelBundle:Gift')
                ->findBy(['child' => $idChild], ['feasibility'=>'DESC'], null, 0);

            // Rajouter Malus
            $malus = 0;
            foreach ($wishlist as $whish) {
                $whish->setFeasibility($whish->getFeasibility() - $malus);
                $malus += self::Malus;
            }

            // Récupérer les catégories
            $categories = $em->getRepository('SuperNoelBundle:Category')->findAll();

        // S'il retourne un résultat vide
        } else {
            $gifts = null;
            $wishlist = null;
            $categories = null;
        }

        return $this->render('Elves/index.html.twig',  [
            'gift' => $gifts[0],
            'wishlist' => $wishlist,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/traitement")
     */
    public function giftTreatementAction()
    {

        // Connection Manager
        $em = $this->getDoctrine()->getManager();

        if (!empty($_POST['id'])) {

            // Récupérer l'objet Gift en cours de traitement
            $gift = $em->getRepository('SuperNoelBundle:Gift')
                ->findOneById($_POST['id']);

            // Faisabilité
            $feasibility = $_POST['notation'] + (5 * $gift->getChild()->getWise());
            if ($_POST['feasible'] == true){
                $feasibility += 50;
            }

            // Modif cadeau en cours
//            $gift->setCategory($_POST['category']); // Blocage BDD
            $gift->setFeasibility($feasibility);
            $gift->setTreated(true);

            // Activation du Malus si dernier cadeau de la liste de l'enfants
            $wishlist = $em->getRepository('SuperNoelBundle:Gift')
                ->findBy(['child' => $gift->getChild()->getId(), 'treated' => false]);

            if (empty($wishlist)) {

                $wishlist = $em->getRepository('SuperNoelBundle:Gift')
                    ->findBy(['child' => $gift->getChild()->getId()]);

                $malus = 0;
                foreach ($wishlist as $whish) {
                    $whish->setFeasibility($whish->getFeasibility() - $malus);
                    $malus += self::Malus;
                }

            }

            // Fin
            $em->flush();
        }

        if (!empty($_POST['newCategory'])) {
            $category = new Category();
            $category->setName($_POST['newCategory']);
            $em->persist($category);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');

    }
}

