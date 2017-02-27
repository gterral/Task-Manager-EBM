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
        return $this->render('EBMMaterielBundle:Default:machine.html.twig');
    }

    public function planningMachineAction()
    {
        return $this->render('EBMMaterielBundle:Default:planningMachine.html.twig');
    }
}
