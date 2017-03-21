<?php

namespace EBM\GDPBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class FileEntityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('File', VichFileType::class, [
            'required' => false,
            'label'=> 'Joindre un document',
            'allow_delete' => true, // not mandatory, default is true
            'download_link' => true, // not mandatory, default is true
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EBM\GDPBundle\Entity\FileEntity'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ebm_gdpbundle_fileentity';
    }


}
