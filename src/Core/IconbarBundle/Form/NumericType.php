<?php

namespace Core\IconbarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class NumericType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'options' => array()
        ));
    }

    public function getParent()
    {
        return TextType::class;
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['options'] = $options['options'];
    }
}

