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

        // S'il retourne un résultat vide
        } else {
            $gifts = null;
            $whistlist = null;
        }

        var_dump($gifts);
        return $this->render('Elves/index.html.twig',  [
            'gifts' => $gifts[0],
            'whistlist' => $whistlist,
        ]);
    }
}
