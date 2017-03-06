<?php

namespace EBM\SocialNetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


#Recuperer les tags que l'user like
#Recuperer le projet de user
#Recuperer les follows du user
#Afficher tous les publications qui correspondent a l'un des trois
class PublicationController extends Controller
{
    public function indexAction(User $user)
    {
        #FAUX
        return $this->render('EBMSocialNetworkBundle:Publication:index.html.twig', array('listPubli' => $user->getTags(),
            'project' => $project);

    }
}

#Vue d'une publication en détails lorsque je clique dessus

#Ajout d'une publication

#Supprimer une publication

#Modifier une publication