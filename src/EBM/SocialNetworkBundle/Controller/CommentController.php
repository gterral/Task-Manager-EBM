<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\EBMSocialNetworkBundle;
use EBM\SocialNetworkBundle\Entity\Comment;
use EBM\SocialNetworkBundle\Form\AddCommentType;
use EBM\SocialNetworkBundle\Form\AddPublicationType;
use EBM\SocialNetworkBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class CommentController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("publication",options={"mapping": {"id":"id"}})
     */
    public function addAction(Request $request, Publication $publication)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $_POST['form'];

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $comment->setPublication($publication);
            $em->persist($comment);
            $em->flush();
        }
    }
}