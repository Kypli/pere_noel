<?php

namespace SuperNoelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SuperNoelBundle\Entity\Child;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
        $em = $this->getDoctrine()->getManager();

        $treatedChilds = $em->getRepository('SuperNoelBundle:Child')
            ->findBy(
                ['delivered' => false],
                [
                    'adresscountry' => 'DESC',
                    'adresscity' => 'DESC',
                    'adressstreet' => 'DESC',
                    'adressnumber' => 'DESC',
                ]
            );

        return $this->render(
            'SantaClaus/index.html.twig',
            [
                'treatedChilds' => $treatedChilds
            ]
        );
    }

    /**
     * @Route("/enfant/{id}")
     */
    public function viewChildAction(Child $child)
    {
        $em = $this->getDoctrine()->getManager();

        $formBuilder = $this->createFormBuilder($child);
        $formBuilder
            ->add('delivered',
                ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'label' => 'Livré:',
            ])
            ->add('Ok',
                SubmitType::class);

        $form = $formBuilder->getForm();

//        var_dump($child);

        return $this->render(
            'SantaClaus/viewChild.html.twig',
            [
                'child' => $child,
                'deliveredForm' => $form->createView(),
            ]
        );
    }
}
