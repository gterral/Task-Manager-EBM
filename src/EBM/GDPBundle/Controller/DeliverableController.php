<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\DocumentProject;
use EBM\GDPBundle\Entity\FileEntity;
use EBM\GDPBundle\Form\FileEntityType;
use EBM\UserInterfaceBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class DeliverableController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("documentProject",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function indexAction(DocumentProject $documentProject, Project $project, Request $request)
    {
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $file = new FileEntity();

        $form = $this->createForm(FileEntityType::class,$file);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $documentProject->addFileEntities($file);
            $em->persist($file);
            $em->persist($documentProject);
            $em->flush();

            return $this->redirectToRoute(
                'ebmgdp_deliverable',array('code'=>$project->getCode(),'id'=>$documentProject->getId())
            );
        }

        return $this->render('EBMGDPBundle:Deliverable:index.html.twig',
            array('documentProject'=> $documentProject,
                'project'=>$project,
                'form'=>$form->createView())
        );
    }
}