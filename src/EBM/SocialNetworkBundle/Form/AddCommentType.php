<?php

namespace EBM\SocialNetworkBundle\Form;

use EBM\SocialNetworkBundle\Entity\Publication;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['entity_manager'];

        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Ajouter un commentaire'
            ])
            ->add('publication', HiddenType::class)
            ->add('save', SubmitType::class);
            /*->add('publication', EntityType::class, [
                'class' => 'EBMSocialNetworkBundle:Publication',
                'choice_label' => 'content'
            ]);*/

        $builder
            ->get('publication')
            ->addModelTransformer(new EntityHiddenTransformer(
                $em,
                Publication::class,
                'id'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\SocialNetworkBundle\Entity\Comment'
        ));
        $resolver->setRequired('entity_manager');
    }
}