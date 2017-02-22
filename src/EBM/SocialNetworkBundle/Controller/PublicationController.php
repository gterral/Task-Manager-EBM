<?php

namespace EBM\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicationController extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMSocialNetworkBundle:Default:index.html.twig');
    }
}
