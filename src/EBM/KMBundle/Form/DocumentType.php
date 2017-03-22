<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 27/02/2017
 * Time: 08:37
 */

namespace EBM\KMBundle\Form;

use EBM\KMBundle\Entity\Document;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom du document'
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description du document'
            ))
            ->add('tags', EntityType::class, array(
                'label' => 'Tags',
                'class' => 'EBMKMBundle:Tag',
                'choices' => $options['tags'],
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('file', FileType::class, array(
                'label' => 'Dépôt de fichier',
                'required' => false
            ))
            ->add('link', TextType::class, array(
                'label' => 'Lien vers une ressource externe',
                'required' => false
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Valider l\'upload du document'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            "data_class" => Document::class,
            "tags" => null
        ));
    }

}