<?php

namespace StudyncoBundle\Form;

use StudyncoBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre', 'required'=> false))
            ->add('description', TextType::class, array('label' => 'Description', 'required' => false))
            ->add('parent', EntityType::class,array(
                'class' => 'StudyncoBundle:Category',
                'choice_label' => 'title',
                'placeholder' => 'Choose an option',
                'multiple' => false,
                'required' => false,
            ))
            ->add('save', SubmitType::class,array('label' => 'Enregistrer'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StudyncoBundle\Entity\Category'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'studyncobundle_category';
    }


}
