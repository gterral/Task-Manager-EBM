<?php

namespace EBM\KMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMKMBundle:Default:index.html.twig');
    }
}
