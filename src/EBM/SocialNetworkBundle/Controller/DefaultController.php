<?php

namespace EBM\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $tags = $user->getTags();

        $tagsNames = [];

        foreach ($tags as $tag)
        {
            $tagsNames[] = $tag->getName();
        }

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMSocialNetworkBundle:Publication');

        $listPublications = $repository->getPublicationWithTags($tagsNames);


        return $this->render('EBMSocialNetworkBundle:Default:index.html.twig',
            ['listPublications' => $listPublications]);
    }
}
