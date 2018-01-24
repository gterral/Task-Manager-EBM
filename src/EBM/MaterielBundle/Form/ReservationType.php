<?php

namespace EBM\MaterielBundle\Form;


use EBM\MaterielBundle\Entity\ReservationMachine;
use EBM\MaterielBundle\Entity\Machine;
use EBM\MaterielBundle\Controller\MachineController;
//use EBM\GDPBundle\Form\DataTransformer\TimestampToDatetimeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('user',     TextType::class, array(
//                'label' => 'Nom & prénom',
//                'attr' => array('disabled' => 'disabled')))
//            ->add('projet',      ChoiceType::class, array(
//                'label' => 'Projet associé',
//                'choices' => array('projet 1' => 'projet1')))
            ->add('machine', ChoiceType::class, array(
                'label' => 'Machine à réserver',
                'choices' => array('machine 1' => '6',
                                    'machine 2' => '7')))
            ->add('description',      TextareaType::class, array(
                'label' => 'Description de la réservation'))
            ->add('debut',      DateTimeType::class, array(
                'label' => 'Date de début de réservation'))
            ->add('fin',      DateTimeType::class, array(
                'label' => 'Date de fin de réservation'))
            ->add('save',      SubmitType::class,array(
                'label' => 'Valider',
                'attr' => array('class' => 'btn btn-primary')));

//        $builder->get('deadline')
//            ->addModelTransformer(new TimestampToDatetimeTransformer());
//        $builder->get('realisationDate')
//            ->addModelTransformer(new TimestampToDatetimeTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\MaterielBundle\Entity\ReservationMachine'

        ));
    }
}
