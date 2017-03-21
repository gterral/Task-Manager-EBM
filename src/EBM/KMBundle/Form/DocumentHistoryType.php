<?php

namespace EBM\KMBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentHistoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tags', EntityType::class, array(
            'label' => 'Tags',
            'class' => 'EBMKMBundle:Tag',
            'choices' => $options['tags'],
            'choice_label' => 'name',
            'expanded' => true,
            'multiple' => true,
        ))       ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\KMBundle\Entity\DocumentHistory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ebm_kmbundle_documenthistory';
    }


}
