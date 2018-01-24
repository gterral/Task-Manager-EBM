<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\Entity\ProjectSubscription;
use EBM\SocialNetworkBundle\Form\AddProjectSubscriptionsType;
use EBM\SocialNetworkBundle\Form\AddTagSubscriptionsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

class SubscriptionsController extends Controller
{


    public function indexAction(Request $request)
    {
        // Pour l'abonnement aux tags
        $user = $this->getUser();
        $tagform = $this->get('form.factory')->create(AddTagSubscriptionsType::class, $user);

        if ($request->isMethod('POST') && $tagform->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Tag bien enregistrée.');

            return $this->redirectToRoute('ebm_social_network_subscriptions');
        }


        // Pour l'abonnement aux projets
        $user = $this->getUser();
        $projectform = $this->get('form.factory')->create(AddProjectSubscriptionsType::class, $user);

        if ($request->isMethod('POST') && $projectform->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Projet bien enregistré.');

            return $this->redirectToRoute('ebm_social_network_subscriptions');
        }

        return $this->render('EBMSocialNetworkBundle:Subscriptions:index.html.twig', array(
            'tagform' => $tagform->createView(),
            'projectform' => $projectform->createView(),
            'usertags' => $user->getTags(),
            'userprojects' => $user->getProjectSubscriptions()
        ));
    }
}








