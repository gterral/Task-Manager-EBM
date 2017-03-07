<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\Form\AddProjectSubscriptionsType;
use EBM\SocialNetworkBundle\Form\AddTagSubscriptionsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubscriptionsController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $tagform = $this->get('form.factory')->create(AddTagSubscriptionsType::class, $user);
        $projectform = $this->get('form.factory')->create(AddProjectSubscriptionsType::class, $user);

        if ($request->isMethod('POST') && $tagform->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Tag bien enregistrée.');

            return $this->redirectToRoute('ebm_social_network_subscriptions');
        }

        if ($request->isMethod('POST') && $projectform->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Projet suivi.');

            return $this->redirectToRoute('ebm_social_network_subscriptions');
        }

        return $this->render('EBMSocialNetworkBundle:Subscriptions:index.html.twig', array(
            'tagform' => $tagform->createView(),
            'projectform' => $projectform->createView()
        ));
    }
}
