<?php

namespace EBM\KMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{

    public function searchAction($query)
    {
        $finder = $this->get('fos_elastica.finder.fablab.tags');
        $results = $finder->find($query);
        dump($results);
        return $this->render('@EBMKM/Search/results.html.twig', array('results' => $results));
    }
}
