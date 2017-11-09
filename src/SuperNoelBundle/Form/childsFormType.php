<?php

namespace SuperNoelBundle\Form;

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
