<?php
namespace SuperNoelBundle\Controller;

use SuperNoelBundle\Entity\Child;
use SuperNoelBundle\Form\childsFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction() {

        $child = new Child();    //On crée un objet Child
        $form = $this->createForm(childsFormType::class, $child); //On crée le FormBuilder


// createView() permet à la vue d’afficher le formulaire
        return $this->render('Home/home.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
