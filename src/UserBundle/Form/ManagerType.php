<?php

namespace UserBundle\Form;

use DashboardBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManagerType extends RegistrationType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('cin',TextType::class)
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('gender', ChoiceType::class,array(
                'placeholder' => 'choose an option',
                'choices' => array(
                    'male' => 'Male',
                    'female' => 'Female'
                )
            ))
            ->add('birthDate',BirthdayType::class)
            ->add('phone',TextType::class)
            ->add('image',ImageType::class)
            ->add('save', SubmitType::class);

        $builder->remove('plainPassword');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Manager'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_manager';
    }


}
