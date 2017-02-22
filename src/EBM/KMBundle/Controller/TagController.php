<?php

namespace EBM\KMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TagController extends Controller
{
    //Todo : Intégrer une interface de monitoring des tags, création, suppression, tags spéciaux, monitoring...
    public function indexAction()
    {
        // Juste des tests sur le service
        //$tags = $this->get('ebmkm.tag')->getAllTags();

        $tags = $this->get('ebmkm.tag')->getTagsByType('general');

        return $this->render('EBMKMBundle:Tag:index.html.twig', array('tags' => $tags));
    }
}
