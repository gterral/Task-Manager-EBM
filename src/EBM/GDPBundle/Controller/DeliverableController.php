<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMGDPBundle:Project:index.html.twig');
    }
}
