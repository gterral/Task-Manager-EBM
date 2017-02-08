<?php

namespace Core\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        
        // Champs valables pour tous le monde
        $builder
            ->remove('username') // Retirer celui du form parent FOS\UserBundle\Form\Type\RegistrationFormType
            ->add('username',  TextType::class,array('label'=>'Nom d\'utilisateur'))
            ->add('fullname',  TextType::class,array('label'=>'Nom complet'))
            ->remove("plainPassword")
            ->remove('email');
        
        $builder
            ->add('password', PasswordType::class,array('label'=>'cpuser.register.password',"data"=>""))
            ->add('terms', CheckboxType::class,array('mapped'=>false,'required'=>true,'label'=>'J\'accepte les terms of use'));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'user_registration';
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            "role" => "ROLE_CREATOR",
            'data_class' => 'Core\UserBundle\Entity\User'
        ));
    }
}