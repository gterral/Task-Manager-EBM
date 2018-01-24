<?php

namespace EBM\UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMUserInterfaceBundle:Default:index.html.twig');
    }
}
