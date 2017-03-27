<?php

namespace EBM\KMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{

    public function searchAction($query)
    {
        // TODO : improve this.
        $indexs = array(
            'tags' => 'Tags',
            'post' => 'Posts',
        );

        $results = [];

        foreach ($indexs as $index_key => $index_value) {
            $finder = $this->get('fos_elastica.finder.fablab.'.$index_key);
            $results[$index_key] = $finder->find($query);
        }

        return $this->render('@EBMKM/Search/results.html.twig', array('indexs' => $indexs, 'results' => $results));
    }
}
