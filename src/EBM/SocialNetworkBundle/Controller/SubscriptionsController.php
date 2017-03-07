<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\Form\AddSubscriptionsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubscriptionsController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->get('form.factory')->create(AddSubscriptionsType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Tag bien enregistrée.');

            return $this->redirectToRoute('ebm_social_network_subscriptions');
        }

        return $this->render('EBMSocialNetworkBundle:Subscriptions:index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
