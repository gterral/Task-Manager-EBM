<?php

namespace EBM\KMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, array(
                'label' => 'Contenu du post',
                'attr' => array(
                    'autocomplete'=>'off',
                    'class'=>'well'
                )
                //TODO update le textarea
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Go !',
                'attr' => array('class'=>'btn btn-primary waves-effect waves-light')
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\KMBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ebm_kmbundle_post';
    }


}
