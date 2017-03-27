<?php

namespace EBM\GDPBundle\Form;

use EBM\GDPBundle\Form\DataTransformer\TimestampToDatetimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',     TextType::class, array(
            'label' => 'Nom du livrable'))
            ->add('description',      TextareaType::class, array(
                'label' => 'Description du livrable'))
            ->add('deadlineDate',      TextType::class, array(
                'label' => 'Deadline',
                'required' => false,
                'attr' => array('data-plugin'=>'datepicker','class'=>'datepicker')))
            ->add('status',   ChoiceType::class ,  array(
                'choices'  => array(
                    'Ouvert' => 'OPENED',
                    'En cours de réalisation' => 'IN_PROGRESS',
                    'En attente de relecture' => 'WAITING_FOR_REVIEW',
                    'Validé' => 'VALIDATED',
                    'Rejecté' => 'REJECTED',
                    'Archivé' => 'ARCHIVED'),
                'label' => 'Status',
                'attr' => array('class' => 'form-control')))
            ->add('save',      SubmitType::class,array(
                'label' => 'Envoyer',
                'attr' => array('class' => 'btn btn-primary')));


        $builder->get('deadlineDate')
            ->addModelTransformer(new TimestampToDatetimeTransformer());

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\GDPBundle\Entity\DocumentProject'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ebm_gdpbundle_documentproject';
    }


}
