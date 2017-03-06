<?php

namespace EBM\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMSocialNetworkBundle:Publication');

        $listPublications = $repository->findAll();

        return $this->render('EBMSocialNetworkBundle:Default:index.html.twig',
            ['listPublications' => $listPublications]);
    }
}
