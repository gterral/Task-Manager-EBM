<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\Entity\Comment;
use EBM\SocialNetworkBundle\Entity\Publication;
use EBM\SocialNetworkBundle\Form\AddCommentType;
use EBM\SocialNetworkBundle\Repository\CommentRepository;
use EBM\SocialNetworkBundle\Repository\PublicationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $tags = $user->getTags();
        $projects = $user->getProjectSubscriptions();

        $tagsNames = [];
        $projectsNames = [];

        $em = $this->getDoctrine()->getManager();

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

        $comment = new Comment();
        $comment->setUserComment($this->getUser());

        $a_renvoyer = [];
        /** @var Publication $publication */
        foreach ($listPublications as $publication) {

            $form = $this->createForm(
                AddCommentType::class,
                $comment,
                ['entity_manager' => $em]
            );

            $form->get('publication')->setData($publication);

            $a_renvoyer[] = [
                'publication' => $publication,
                'form' => $form->createView()
            ];

            //$comment->setPublication($publication);
        }

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->persist($comment);
            $em->flush();

        }

        return $this->render('EBMSocialNetworkBundle:Default:index.html.twig',
            ['a_renvoyer' => $a_renvoyer]
        );
    }

    public function voirAction(Publication $publication)
    {
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('EBMSocialNetworkBundle:Comment')->findByPublication($publication);

        return $this->redirectToRoute('ebm_social_network_homepage', array(
            'publication'           => $publication,
            'comments'              => $comments
        ));
    }
}