<?php


namespace ManagementBundle\Form;

use ManagementBundle\Form\ModuleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ModuleImportType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('title')->remove('code')->remove('hours')->remove('coefficient');
  }

  public function getParent()
  {
    return ModuleType::class;
  }
}
