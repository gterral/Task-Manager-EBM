<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use EBM\UserInterfaceBundle\Entity\Project;

class ProjectController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function viewDeliverablesAction(Project $project)
    {
        return $this->render('EBMGDPBundle:Project:index.html.twig');
    }
}
