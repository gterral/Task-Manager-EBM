<?php

namespace Core\IconbarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GenderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        // Sélection du genre soit masculin soit féminin
        // en base, la valeur sera soit M soit F
        $resolver->setDefaults(array(
            'choices' => array(
                '<i class="fa fa-male"></i>' => 'M',
                '<i class="fa fa-female"></i>' => 'F',
            ),
            'expanded' => true,
            'multiple' => false,
            'required' => false
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}

