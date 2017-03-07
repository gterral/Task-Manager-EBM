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

    public function planningMachineAction($machine)
    {
        return $this->render('EBMMaterielBundle:Default/machines:planningMachine.html.twig', array('machine' => $machine));
    }

    public function reservationMachineAction($debut, $fin)
    {
        return $this->render('EBMMaterielBundle:Default/machines:reservationMachine.html.twig', array('debut' => $debut, 'fin' => $fin));
    }

    /*
     * useful methods
     */

    public function getAllMachines()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:Machine');

        return $repository->findAll();
    }

}
