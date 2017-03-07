<?php

namespace EBM\MaterielBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function reservationMachineAction($machine, $debut, $fin)
    {
        return $this->render('EBMMaterielBundle:Default/machines:reservationMachine.html.twig', array('machine' => $machine, 'debut' => $debut, 'fin' => $fin));
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
