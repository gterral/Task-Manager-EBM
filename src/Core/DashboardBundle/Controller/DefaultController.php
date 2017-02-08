<?php

namespace Core\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // Ajouter une bannière type succès
        $request->getSession()->getFlashBag()->add('notifications',array("title"=>"Ceci est un message signalant un succès","status"=>"success"));

        // Pour changer la couleur de la bannière, changer la valeur de "status" parmi :
        // success (vert)
        // warning (orange)
        // danger (rouge)
        // info (bleu)

        return $this->render('CoreDashboardBundle:Default:overview.html.twig');
    }
}
