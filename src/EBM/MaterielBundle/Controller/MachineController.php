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

        return $this->render('EBMMaterielBundle:Default/machines:selectionMachinePlanning.html.twig');
    }

    public function planningMachineAction()
    {
        return $this->render('EBMMaterielBundle:Default/machines:planningMachine.html.twig');
    }

    public function reservationMachineAction($debut, $fin)
    {
        return $this->render('EBMMaterielBundle:Default/machines:reservationMachine.html.twig', array('debut' => $debut, 'fin' => $fin));
    }
}
