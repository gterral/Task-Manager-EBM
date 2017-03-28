<?php

namespace EBM\KMBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopicType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre du topic'
            ))

            ->add('description', TextType::class, array(
                'label' => 'Description'
            ))

            ->add('tags', EntityType::class, array(
                'label' => 'Tags',
                'class' => 'EBMKMBundle:Tag',
                'choices' => $options['tags'],
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ))

            ->add('posts', CollectionType::class, array(
                'entry_type' => PostType::class,
                'allow_add' => false,
                'allow_delete' => false
            ))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\KMBundle\Entity\Topic',
            "tags" => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ebm_kmbundle_topic';
    }

}
