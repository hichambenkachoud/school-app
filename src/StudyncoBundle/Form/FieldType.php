<?php

namespace StudyncoBundle\Form;

use StudyncoBundle\Entity\Category;
use StudyncoBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)

            ->add('type', ChoiceType::class,array(
                'placeholder' => 'Choose an option',
                'choices' => array(
                    'list' => 'STRING',
                    'table' => 'TABLE',
                    'condition' => 'BOOLEAN',
                    'numéro' => 'NUMBER'
                ),
                'multiple' => false
            ))
            ->add('tableName', ChoiceType::class, array(
                'placeholder' => 'Choose an option',
                'choices' => array(
                    'ville' => 'cities',
                    'pays' => 'countries',
                    'établissement' => 'organizations'
                ),
                'multiple' => false,
                'required' => false
            ))
            ->add('category', EntityType::class,array(
                'class' => Category::class,
                'query_builder' => function(CategoryRepository $c){
                    return $c->getCategoryParent();
                },
                'choice_label' => 'title',
                'placeholder' => 'Choose an option',
                'multiple' => false,
                'required' => true,
            ))
            ->add('save', SubmitType::class,array('label' => 'Enregistrer'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StudyncoBundle\Entity\Field'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'studyncobundle_field';
    }


}
