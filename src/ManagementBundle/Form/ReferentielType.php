<?php

namespace ManagementBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReferentielType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('code', TextType::class)
            ->add('yearAcademic',EntityType::class,
                array(
                    'class' => 'ManagementBundle:AcademicYear',
                    'choice_label' => 'title',
                    'placeholder' => 'choose on option',
                    'multiple' => false,
                    'required' => true
                ))
            ->add('level',EntityType::class,
                array(
                    'class' => 'ManagementBundle:Level',
                    'choice_label' => 'title',
                    'placeholder' => 'choose on option',
                    'multiple' => false,
                    'required' => true
                ))
            ->add('filiere',EntityType::class,
                array(
                    'class' => 'ManagementBundle:Filiere',
                    'choice_label' => 'title',
                    'placeholder' => 'choose on option',
                    'multiple' => false,
                    'required' => true
                )
            )
            ->add('save', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ManagementBundle\Entity\Referentiel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'managementbundle_referentiel';
    }


}
