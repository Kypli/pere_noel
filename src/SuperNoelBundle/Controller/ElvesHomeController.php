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
        $gifts = $em->getRepository('SuperNoelBundle:Gift')->findByTreated(0);

        // S'il retourne un résultat
        if (!empty($gifts)) {
            $child = $gifts[0]->getChild();
//            var_dump($child);
            // Récupérer liste des cadeaux de l'enfant en cours
            $whistlist = $em->getRepository('SuperNoelBundle:Gift')->findByChild($child);
        // S'il retourne un résultat vide
        } else {
            $gifts = null;
            $whistlist = null;
        }

//        var_dump($gifts[0]);
//        var_dump($whistlist);
        return $this->render('SuperNoelBundle:Elves:index.html.twig',  [
            'gift' => $gifts[0],
            'whistlist' => $whistlist,
        ]);
    }
}