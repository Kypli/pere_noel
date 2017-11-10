<?php

namespace SuperNoelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SuperNoelBundle\Entity\Category;
use SuperNoelBundle\Entity\Gift;
use SuperNoelBundle\Entity\Child;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ElveHomeController
 * @route("/elfes")
 */
class ElvesHomeController extends AbstractController
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
            foreach ($wishlist as $wish) {
                $wish->setFeasibility($wish->getFeasibility() - $malus);
                $malus += self::Malus;
                if ($wish->getFeasibility() < 0) {
                    $wish->setFeasibility(0);
                }
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

            $idChild = $gift->getChild()->getId();

            // Faisabilité
            $feasibility = $_POST['notation'] + (5 * $gift->getChild()->getWise());
            if (isset($_POST['feasible']) && $_POST['feasible'] == true){
                $feasibility += 50;
            }

            // Modif cadeau en cours
            $objCat = $em->getRepository('SuperNoelBundle:Category')
                ->find($_POST['category']);
            $gift->setCategory($objCat);
            $gift->setFeasibility($feasibility);
            $gift->setTreated(true);
            $em->flush();
           // Si tout les cadeaux ont été traités
            $wishlist = $em->getRepository('SuperNoelBundle:Gift')
                ->findBy(['child' => $gift->getChild()->getId(), 'treated' => false]);

            if (empty($wishlist)) {

                // Activation du Malus si dernier cadeau de la liste de l'enfants
                $wishlist = $em->getRepository('SuperNoelBundle:Gift')
                    ->findBy(['child' => $gift->getChild()->getId()]);

                $malus = 0;
                foreach ($wishlist as $whish) {
                    $whish->setFeasibility($whish->getFeasibility() - $malus);
                    $malus += self::Malus;
                }

                // Cadeau bonus pour ceux qui n'en ont pas eu
                $validGift = $em->getRepository('SuperNoelBundle:Gift')
                    ->findBy(['child' => $idChild, 'feasibility' => '>= 50']);

                if (empty($validGift)) {
                    $bonusGift = new Gift();
                    $bonusGift->setName('Cadeau surprise');
                    $bonusGift->setFeasibility(50);
                    $bonusGift->setTreated(true);
                    $objCat = $em->getRepository('SuperNoelBundle:Category')
                        ->find(14);
                    $bonusGift->setCategory($objCat);
                    $objChild = $em->getRepository('SuperNoelBundle:Child')
                        ->find($idChild);
                    $bonusGift->setChild($objChild);
                    $em->persist($bonusGift);
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

        return $this->elvesAction();

    }

    /**
     * @Route("/liste")
     */
    public function listChildren()
    {
        // Connection Manager
        $em = $this->getDoctrine()->getManager();

        $children = $em->getRepository('SuperNoelBundle:Child')
            ->findAll();

        return $this->render('Elves/liste.html.twig',  [
            'children' => $children,
        ]);
    }

    /**
     * @Route("/listeCadeaux")
     */
    public function listGiftsChildren()
    {
        // Connection Manager
        $em = $this->getDoctrine()->getManager();

        if (!empty($_GET['id'])) {

            $gifts = $em->getRepository('SuperNoelBundle:Gift')
                ->findBy(['child' => $_GET['id']], ['feasibility' => 'DESC']);

            $child = $em->getRepository('SuperNoelBundle:Child')
                ->find($_GET['id']);

            return $this->render('Elves/liste.html.twig',  [
                'gifts' => $gifts,
                'child' => $child,
            ]);

        }
    }
}

