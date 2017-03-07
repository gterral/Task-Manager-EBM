<?php

namespace EBM\KMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TagController extends Controller
{
    //Todo : Intégrer une interface de monitoring des tags, création, suppression, tags spéciaux, monitoring...
    public function indexAction() {

        // Juste des tests sur le service
        //$tags = $this->get('ebmkm.tag')->getAllTags();

        $tags = $this->get('ebmkm.tag')->getTagsByType('general');

        return $this->render('EBMKMBundle:Tag:index.html.twig', array('tags' => $tags));
    }

    /**
     * Provides a simple API to grab tags using its beginning.
     *
     * @param $begin
     * @return JsonResponse
     */
    public function getTagsByBeginAction($begin) {
        $output = new JsonResponse();
        $output->setData($this->get('ebmkm.tag')->getTagsByBeginning($begin));
        return $output;
    }


}
