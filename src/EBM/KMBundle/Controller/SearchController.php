<?php

namespace EBM\KMBundle\Controller;


use EBM\KMBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;


class SearchController extends Controller
{

    public function searchAction($query)
    {
        // Key : The key for the template. Value :  Elastic index.
        $indexs = array(
            'tags' => 'tags',
            'posts' => 'post',
            'ressources' => 'ressources',
        );

        $results = [];

        foreach ($indexs as $index_key => $index_value) {
            $finder = $this->get('fos_elastica.finder.fablab.'.$index_value);
            $results[$index_key] = $finder->find($query);
        }

        return $this->render('@EBMKM/Search/results.html.twig', array('indexs' => $indexs, 'results' => $results));
    }

    public function searchByTagAction($tag_id) {
        if(!$tag = $this->getDoctrine()->getRepository('EBMKMBundle:Tag')->find($tag_id))
            throw new HttpException(404,'Not found');

        $results = [];

        // Key : The key for the template. Value :  Repository.
        $indexs = array(
            'topics' => 'EBMKMBundle:Topic',
            'ressources' => 'EBMKMBundle:Document',
        );

        foreach ($indexs as $index_key => $index_value) {
            $finder = $this
                ->getDoctrine()
                ->getRepository($index_value)
                ->createQueryBuilder($index_key)
                ->where(':tag MEMBER OF '.$index_key.'.tags')
                ->setParameter('tag', $tag)
                ->getQuery();

            $results[$index_key] = $finder->getResult();
        }
dump($results);

        return $this->render('@EBMKM/Search/results.html.twig', array('indexs' => $indexs, 'results' => $results));
    }
}
