<?php

namespace StudyncoBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WordType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,
                array('required' => true))

            ->add('definition', TextType::class,
                array('required' => false))

            ->add('isSynonym', CheckboxType::class,
                array('required' => false))

            ->add('parent', EntityType::class,
                array(
                'class' => 'StudyncoBundle:Word',
                'choice_label' => 'title',
                'placeholder' => 'choose an option',
                'multiple' => false,
                'required' => false
            ))
            ->add('save', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StudyncoBundle\Entity\Word'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'studyncobundle_word';
    }


}
