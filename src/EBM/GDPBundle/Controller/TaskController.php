<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaskController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMGDPBundle:Task:index.html.twig');
    }
}
