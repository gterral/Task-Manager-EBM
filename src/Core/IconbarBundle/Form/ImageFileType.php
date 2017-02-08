<?php
// src/Core/IconbarBundle/Form/ImageFileType.php

namespace Core\IconbarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageFileType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      // Formulaire charger image depuis un fichier
        $label = !empty($options) && !empty($options['label']) ? $options['label'] : "";
        $fileOptions=array();
        if (strlen($label) > 0)
            $fileOptions['label'] = $label;
        $builder ->add('file', FileType::class,$fileOptions);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Core\IconbarBundle\Entity\Image'
    ));
  }
  
}
