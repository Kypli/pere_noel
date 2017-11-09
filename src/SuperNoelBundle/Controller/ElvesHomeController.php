<?php

namespace SuperNoelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ElveHomeController
 * @route("/elfes")
 */
class ElvesHomeController extends Controller
{
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
            $whistlist = $em->getRepository('SuperNoelBundle:Gift')
                ->findBy(['child' => $idChild], ['feasibility'=>'DESC'], null, 0);

            // Récupérer les catégories
            $categories = $em->getRepository('SuperNoelBundle:Category')->findAll();

        // S'il retourne un résultat vide
        } else {
            $gifts = null;
            $whistlist = null;
        }

        return $this->render('Elves/index.html.twig',  [
            'gift' => $gifts[0],
            'whistlist' => $whistlist,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/giftTreatement")
     */
    public function giftTreatementAction()
    {
        // Connection Manager
        $em = $this->getDoctrine()->getManager();

        if (!empty($_POST['gift'])) {
            $id = $_POST['id'];
            $notation = $_POST['notation'];
            $notation = $_POST['notation'];
        }

        header('Elves/index.html.twig');
    }
}

