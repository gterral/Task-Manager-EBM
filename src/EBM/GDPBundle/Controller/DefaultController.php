<?php

namespace EBM\GDPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMGDPBundle:Default:index.html.twig');
    }
}
