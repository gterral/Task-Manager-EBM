<?php

namespace EBM\MaterielBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EBM\MaterielBundle\Entity\ReservationMachine;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;

class MachineController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMMaterielBundle:Default:index.html.twig');
    }

    public function machineAction()
    {
        return $this->render('EBMMaterielBundle:Default/machines:machine.html.twig');
    }

    public function selectionMachineAction()
    {
        return $this->render('EBMMaterielBundle:Default/machines:selectionMachinePlanning.html.twig', array('machines' => $this->getAllMachines()));
    }

    public function planningMachineAction($machineId)
    {
        return $this
            ->render('EBMMaterielBundle:Default/machines:planningMachine.html.twig',
                array(
                    'machine' => $this->getMachine($machineId),
                    'events' => $this->getAllReservations($machineId)
                )
            );
    }

    public function reservationMachineAction($debut, $fin, Request $request)
    {
        $resa_machine = new ReservationMachine();

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $resa_machine);
        //print_r($resa_machine);

        $listeMachines = array();
        foreach($this->getAllMachines() as $machine)
        {
            $listeMachines[$machine->getNom()] = $machine;
        }

        $formBuilder
            ->add('user', TextType::class, array('disabled' => 'true', 'data' => $this->getUser()))
            ->add('dateCreation', DateType::class, array('disabled' => 'true'))
            ->add('machine', ChoiceType::class, array(
                'choices' => $listeMachines
            ))
            ->add('debut', DateTimeType::class, array('data' => $debut))
            ->add('fin', DateTimeType::class, array('data' => $fin))
            ->add('description', TextareaType::class, array('required' => 'false'))
            ->add('valider', SubmitType::class);


        $form = $formBuilder->getForm();

        if ($request->isMethod('POST')){
            $form->handleRequest($request);

            $resa_machine->setUser($this->getUser());

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($resa_machine);
                $em->flush();

                $request->getSession()->getFlashBag()->add('message', 'Réservation bien enregistrée.');

                return $this->redirectToRoute('ebm_materiel_machines');
            }
        }

        return $this->render('EBMMaterielBundle:Default/machines:reservationMachine.html.twig', array('form' => $form->createView()));

    }

    /*
     * useful methods
     */

    public function getMachine($machineId)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:Machine');

        return $repository->find($machineId);
    }
    public function getAllMachines()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:Machine');

        return $repository->findAll();
    }

    public function getAllReservations($machineId)
    {
        $repositoryReservation = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:ReservationMachine');

        $repositoryMachine = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:Machine');

        return $repositoryReservation->findBy(array('machine' => $repositoryMachine->find($machineId)));
    }

}
