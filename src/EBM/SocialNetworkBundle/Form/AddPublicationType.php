<?php

namespace EBM\SocialNetworkBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class)

            ->add('tags', EntityType::class ,  array(
                'class' => 'EBMKMBundle:Tag',
                'choice_label' => 'name',
                'multiple' => true,
                ))

           ->add('projects', EntityType::class ,  array(
                'class' => 'EBMUserInterfaceBundle:Project',
                'choice_label' => 'name',
                'multiple' => true,
            ))
            ->add('save', SubmitType::class);
    }




    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\SocialNetworkBundle\Entity\Publication'
        ));
    }
}