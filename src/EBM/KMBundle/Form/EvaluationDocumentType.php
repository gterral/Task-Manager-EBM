<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 07/03/2017
 * Time: 08:33
 */

namespace EBM\KMBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationDocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', IntegerType::class, array(
                'label' => 'note du document'
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Noter'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\KMBundle\Entity\EvaluationDocument'
        ));
    }

}