<?php

namespace EBM\KMBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('level')
            ->add('tag', EntityType::class, array(
                'label' => 'Tags',
                'class' => 'EBMKMBundle:Tag',
                'choices' => $options['tags'],
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('Go !', SubmitType::class)
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\KMBundle\Entity\CompetenceUser',
            'tags' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ebm_kmbundle_competenceuser';
    }


}
