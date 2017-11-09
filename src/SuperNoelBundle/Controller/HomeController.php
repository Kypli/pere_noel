<?php
namespace SuperNoelBundle\Controller;

use SuperNoelBundle\Entity\Child;
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

        $child = new Child();    // On crée un objet Child
        $formBuilder = $this->createFormBuilder($child); // On crée le FormBuilder

        // On ajoute les champs de l'entité Child que l'on veut à notre formulaire
        $formBuilder
            ->add('firstname',         TextType::class)
            ->add('lastname',    TextType::class)
            ->add('mail',    TextType::class)
            ->add('adressnumber',    TextType::class)
            ->add('adressstreet',    TextType::class)
            ->add('adresscity',    TextType::class)
            ->add('adresscountry',    TextType::class)
            ->add('adresspostal',    TextType::class)
            ->add('message',    TextareaType::class)
            ->add('wise',    TextType::class)
            ->add('save',         SubmitType::class)
        ;

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        // CreateView() permet à la vue d’afficher le formulaire
        return $this->render('Home/home.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
