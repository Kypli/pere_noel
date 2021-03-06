<?php
namespace SuperNoelBundle\Controller;

use SuperNoelBundle\Entity\Child;
use SuperNoelBundle\Entity\Gift;
use SuperNoelBundle\Form\childsFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function addAction(Request $request)
    {
        $child = new Child();
        $form = $this->createForm(childsFormType::class, $child);

        $form->handleRequest( $request );
        if ($form->isSubmitted() && $form->isValid()) {
            $child->setDelivered(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist( $child );
            $em->flush();
            header('Location: /enfant/' . $child->getId());
            exit;
        }
        return $this->render('Home/home.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
    * @Route("/enfant/{id}")
    */
    public function giftAction(Child $child, Request $request)
    {
        $gift = new Gift();

        $errorMessage = false;

        $formBuilder = $this->createFormBuilder($gift);
        $formBuilder
            ->add('name', TextType::class)
            ->add('save',         SubmitType::class, array(
                'label' => "Envoyer" ,
                'attr' => array('class' => 'glyphicon glyphicon-envelope btn btn-success')
            ));

        $form = $formBuilder->getForm();

        $form->handleRequest( $request );
        if ($form->isSubmitted() && $form->isValid()) {
            $gifts = $child->getGifts();
            if ($gifts && $gifts->count() >=10) {
                $errorMessage = 'Petit Malin faut pas abuser !!!!!! ';
            } else {
                $gift->setTreated(false);
                $gift->setCategory(null);
                $gift->setChild($child);

                $em = $this->getDoctrine()->getManager();
                $em->persist( $gift );
                $em->flush();

                header('Location: /enfant/' . $child->getId());
                exit;
            }
        }

        return $this->render('Home/gifts.html.twig', array(
            'form' => $form->createView(),
            'child'=> $child,
            'errorMessage' => $errorMessage
        ));
    }

}
