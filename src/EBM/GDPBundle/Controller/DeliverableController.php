<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\DocumentProject;
use EBM\UserInterfaceBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DeliverableController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("documentProject",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function indexAction(DocumentProject $documentProject, Project $project)
    {
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        return $this->render('EBMGDPBundle:Deliverable:index.html.twig',
            array('documentProject'=> $documentProject,
                'project'=>$project)
        );
    }
}