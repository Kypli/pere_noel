<?php

namespace SuperNoelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SuperNoelBundle\Entity\Child;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class SantaClausHomeController
 * @route("/pere-noel")
 */
class SantaClausHomeController extends Controller
{
    /**
     * @Route("/", name="santa_claus")
     */
    public function santaClausAction()
    {
        $em = $this->getDoctrine()->getManager();

        $childs = $em->getRepository('SuperNoelBundle:Child')
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
                'childs' => $childs
            ]
        );
    }

    /**
     * @Route("/enfant/{id}", name="santa_claus_view"))
     */
    public function viewChildAction(Request $request, Child $child)
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

        $form->handleRequest( $request );
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($child);
            $em->flush();

            return $this->redirectToRoute('santa_claus');
        }

        return $this->render(
            'SantaClaus/viewChild.html.twig',
            [
                'child' => $child,
                'deliveredForm' => $form->createView(),
            ]
        );
    }
}
