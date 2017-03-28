<?php

namespace EBM\GDPBundle\Form;


use Core\UserBundle\Repository\UserRepository;
use EBM\GDPBundle\Entity\Task;
use EBM\GDPBundle\Form\DataTransformer\TimestampToDatetimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idProject = $options['idProject'];
        $builder
            ->add('name',     TextType::class, array(
                'label' => 'Nom de la tâche'))
            ->add('description',      TextareaType::class, array(
                'label' => 'Description de la tâche'))
            ->add('deadline',      TextType::class, array(
                'label' => 'Deadline',
                'required' => false,
                'attr' => array('data-plugin'=>'datepicker','class'=>'datepicker')))
            ->add('status',   ChoiceType::class ,  array(
                'choices'  => array(
                    'Ouverte' => 'OPENED',
                    'En cours de r�alisation' => 'IN_PROGRESS',
                    'En attente de relecture' => 'WAITING_FOR_REVIEW',
                    'Validé' => 'VALIDATED',
                    'Rejecté' => 'REJECTED',
                    'Archivé' => 'ARCHIVED'),
                'label' => 'Status',
                'attr' => array('class' => 'form-control')))
            ->add('membersAssigned',   EntityType::class ,  array(
                'label' => 'Membres du projet assignés',
                'multiple' => true,
                'choice_label' => 'username',
                'required'=>false,
                'class' => "Core\\UserBundle\\Entity\\User",
                'query_builder' => function(UserRepository $er) use($idProject) {
                    return $er->createQueryBuilder('u')
                        ->join('u.projects', 'proj')
                        ->where('proj.id = :projId')
                        ->setParameter("projId",$idProject);
                },
                'attr' => array('class' => 'form-control')))
            ->add('type',    ChoiceType::class,  array(
                'choices'  => array(
                    'Mécanique' => 'mecanique',
                    'Informatique' => 'computer_science',
                    'Gestion' => 'gestion',
                    'Electronique' => 'electricity'),
                'label' => 'Type de la tâche',
                'attr' => array('class' => 'form-control')))
            ->add('realisationDate',      TextType::class,array(
                'label' => 'Date de réalisation prévue',
                'required' => false,
                'attr' => array('data-plugin'=>'datepicker')))
            ->add('save',      SubmitType::class,array(
                'label' => 'Envoyer',
                'attr' => array('class' => 'btn btn-primary')));


            $builder->get('deadline')
                ->addModelTransformer(new TimestampToDatetimeTransformer());
            $builder->get('realisationDate')
                ->addModelTransformer(new TimestampToDatetimeTransformer());

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\GDPBundle\Entity\Task',
            'idProject' => ''
        ));
    }
}
