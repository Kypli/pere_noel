<?php

namespace SuperNoelBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use SuperNoelBundle\Entity\Child;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class childsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',         TextType::class, array(
                'label' => "Prenom" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('lastname',    TextType::class, array(
                'label' => "Nom" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('mail',    TextType::class, array(
                'label' => "Mail" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('adressnumber',    TextType::class, array(
                'label' => "Numéro de rue" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('adressstreet',    TextType::class, array(
                'label' => "Adresse" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('adresspostal',    TextType::class, array(
                'label' => "Code postal" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('adresscity',    TextType::class, array(
                'label' => "Ville" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('adresscountry',    TextType::class, array(
                'label' => "Pays" ,
                'attr' => array('class' => 'titlefields')
            ))
            ->add('wise',    TextType::class, array(
                'label' => "Sagesse" ,
                'attr' => array('class' => 'titlefields', 'placeholder' => 'Mettez une note de 1 à 5')
            ))
            ->add('message',    TextareaType::class, array(
                'label' => "Message" ,
                'attr' => array('class' => 'titlefields', 'cols' => '20', 'rows' => '15')
            ))
            ->add('envoyer',         SubmitType::class, array(
                'label' => "Envoyer" ,
                'attr' => array('class' => 'glyphicon glyphicon-envelope btn btn-success')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->resolve(array('data_class'=> Child::class));
    }

    public function getBlockPrefix()
    {
        return 'super_noel_bundlechilds_form_type';
    }
}
