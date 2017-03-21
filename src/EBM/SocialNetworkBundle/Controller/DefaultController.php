<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\Entity\Comment;
use EBM\SocialNetworkBundle\Form\AddCommentType;
use EBM\SocialNetworkBundle\Repository\CommentRepository;
use EBM\SocialNetworkBundle\Repository\PublicationRepository;
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


        /** @var PublicationRepository $repository */
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMSocialNetworkBundle:Publication');

        $listPublications = $repository->getPublicationWithTags($tagsNames);
        $comment = new Comment;
        $form = $this->createForm(AddCommentType::class, $comment);


        return $this->render('EBMSocialNetworkBundle:Default:index.html.twig',
            ['listPublications' => $listPublications,
                'form'          => $form->createView()]);
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