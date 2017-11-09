<?php

namespace SuperNoelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class SantaClausHomeController
 * @route("/pere-noel")
 */
class SantaClausHomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function santaClausAction()
    {
        return $this->render('SantaClaus/index.html.twig');
    }

    public function viewChildAction()
    {
        return $this->render('SuperNoelBundle:SantaClaus:viewChild.html.twig');
    }
}
