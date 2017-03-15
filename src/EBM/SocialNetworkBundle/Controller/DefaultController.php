<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $tags = $user->getTags();
        $projects = $user->getProjects();

        $tagsNames = [];
        $projectsNames = [];

        foreach ($tags as $tag)
        {
            $tagsNames[] = $tag->getName();
        }

        foreach ($projects as $project)
        {
            $projectsNames[] = $project->getName();
        }


        /** @var PublicationRepository $repository */
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMSocialNetworkBundle:Publication');

        $listPublications = $repository->getPublicationWithSubscriptions($tagsNames, $projectsNames);


        return $this->render('EBMSocialNetworkBundle:Default:index.html.twig',
            ['listPublications' => $listPublications]);
    }
}
