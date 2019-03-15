<?php

namespace UserBundle\Form;

use DashboardBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends RegistrationType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder,$options);

        $builder
            ->add('cin',TextType::class)
            ->add('type',ChoiceType::class,array(
                'placeholder' => 'choose an option',
                'choices' => array(
                    'vacataire' => 'Vacataire',
                    'permanant' => 'Permanant'
                ),
                'multiple' => false
            ))
            ->add('cv',FileType::class,array(
                'data_class' => null,
                'required' => false
            ))
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('gender',ChoiceType::class,array(
                'placeholder' => 'choose an option',
                'choices' => array(
                    'male' => 'Male',
                    'female' => 'Female',
                ),
                'multiple' => false
            ))
            ->add('birthDate',BirthdayType::class)
            ->add('phone',TextType::class)
            ->add('image',ImageType::class,array(
            ))
            ->add('save',SubmitType::class);

        $builder->remove('plainPassword');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Teacher'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_teacher';
    }


}
