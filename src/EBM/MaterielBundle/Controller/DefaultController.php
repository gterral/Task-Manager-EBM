<?php

namespace EBM\MaterielBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EBM\MaterielBundle\Entity\ReservationMachine;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMMaterielBundle:Default:index.html.twig');
    }

    public function reservation_formAction()
    {
        $resa_machine = new ReservationMachine();

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $resa_machine);

        $formBuilder
            ->add('debut', DateType::class)
            ->add('fin', DateType::class);

        $form = $formBuilder->getForm();

        return $this->render('EBMMaterielBundle:Default:reservation_form.html.twig', array('form' => $form->createView()));
    }
}
