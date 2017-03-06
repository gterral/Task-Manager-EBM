<?php

namespace EBM\SocialNetworkBundle\Controller;

use EBM\SocialNetworkBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function viewAction(Publication $publication)
    {
        return $this->render('EBMSocialNetworkBundle:Publication:view.html.twig',
            ['publication' => $publication]);
    }
}

#Vue d'une publication en détails lorsque je clique dessus

#Ajout d'une publication

#Supprimer une publication

#Modifier une publication