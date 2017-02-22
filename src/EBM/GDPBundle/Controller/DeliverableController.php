<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeliverableController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMGDPBundle:Deliverable:index.html.twig');
    }
}