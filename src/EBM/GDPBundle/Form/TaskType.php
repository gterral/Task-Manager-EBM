<?php

namespace EBM\GDPBundle\Form;


use EBM\GDPBundle\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',     TextType::class)
            ->add('description',      TextareaType::class)
            ->add('deadline',      DateType::class)
            ->add('status',   ChoiceType::class ,  array(
                'choices'  => array(
                    'Ouverte' => 'OPENED',
                    'En cours de r�alisation' => 'IN_PROGRESS',
                    'En attente de relecture' => 'WAITING_FOR_REVIEW',
                    'Valid�' => 'VALIDATED',
                    'Reject�' => 'REJECTED',
                    'Archiv�' => 'ARCHIVED'),))
            ->add('realisationDate',      DateType::class)
            ->add('type',    ChoiceType::class,  array(
                'choices'  => array(
                    'M�canique' => 'mecanique',
                    'Informatique' => 'computer_science',
                    'Gestion' => 'gestion',
                    'Electronique' => 'electricity'),))
            ->add('save',      SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\GDPBundle\Entity\Task'
        ));
    }
}
