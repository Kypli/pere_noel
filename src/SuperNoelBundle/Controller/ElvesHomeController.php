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
        $gift = $em->getRepository('SuperNoelBundle:Gift')
            ->findBy(['treated' => false], ['id'=>'ASC'], 1, 0);

        // S'il retourne un résultat
        if (!empty($gift)) {

            // Récupérer Id de l'enfant
            $idChild = $gift[0]->getChild()->getId();

            // Récupérer infos de l'enfant en cours
            $child = $em->getRepository('SuperNoelBundle:Child')->findById($idChild);

            // Récupérer liste des cadeaux de l'enfant en cours
            $whistlist = $em->getRepository('SuperNoelBundle:Gift')->findByChild($idChild);

            // S'il retourne un résultat vide
        } else {
            $gift = null;
            $child = null;
            $whistlist = null;
        }

        return $this->render('Elves/index.html.twig',  [
            'gift' => $gift[0],
            'child' => $child,
            'whistlist' => $whistlist,
        ]);
    }
}
