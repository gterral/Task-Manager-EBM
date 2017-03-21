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


#Recuperer les tags que l'user like
#Recuperer le projet de user
#Recuperer les follows du user
#Afficher tous les publications qui correspondent a l'un des trois
class PublicationController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("publication",options={"mapping": {"id":"id"}})
     */
    public function viewAction(Request $request, Publication $publication)
    {
        $comment = new Comment();
        $comment->setUserComment($this->getUser());
        $form = $this->createForm(AddCommentType::class, $comment);
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {
            $comment->setPublication($publication);
            $em->persist($comment);
            $em->flush();
        }

        $comments = $em->getRepository('EBMSocialNetworkBundle:Comment')->findByPublication($publication);

        return $this->render('EBMSocialNetworkBundle:Publication:view.html.twig',
            ['publication' => $publication,
            'form'=> $form->createView(),
            'comments'=>$comments]);
    }

    public function addAction(Request $request)
    {
        $publication = new Publication();
        $publication->setUserPublication($this->getUser());
        $form = $this->get('form.factory')->create(AddPublicationType::class, $publication);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Publication bien enregistrée.');

            return $this->redirectToRoute('ebm_social_network_homepage');
        }

        return $this->render('EBMSocialNetworkBundle:Publication:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

#Vue d'une publication en détails lorsque je clique dessus

#Ajout d'une publication

#Supprimer une publication

#Modifier une publication