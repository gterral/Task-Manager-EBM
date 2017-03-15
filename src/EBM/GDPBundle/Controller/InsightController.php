<?php

namespace EBM\GDPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class InsightController extends Controller
{

    public function indexAction()
    {
        $repository_project = $this->getDoctrine()->getRepository('EBMUserInterfaceBundle:Project');
        $projects = $repository_project->findAll();
        return $this->render('EBMGDPBundle:Insight:index.html.twig',
            array('listProjects' => $projects));
    }

}
