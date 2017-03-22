<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\DocumentProject;
use EBM\GDPBundle\Form\DocumentProjectMandatoryType;
use EBM\GDPBundle\Form\DocumentProjectType;
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
    public function indexAction(DocumentProject $documentProject, Project $project)
    {
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        return $this->render('EBMGDPBundle:Deliverable:index.html.twig',
            array('documentProject'=> $documentProject,
                'project'=>$project)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function addMandatoryAction(Request $request, Project $project)
    {
        $documentProject = new DocumentProject();

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("EBMGDPBundle:DocumentTypeProject");
        $listTypes = $repository->findAll();

        $form = $this->createForm(DocumentProjectMandatoryType::class, $documentProject, array('types' => $listTypes));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $documentProject->addProject($project);
            $em->persist($documentProject);
            $em->flush();

            return $this->redirectToRoute('ebmgdp_deliverable', array('id' => $documentProject->getId(), 'code' => $project->getCode()));
        }

        return $this->render('EBMGDPBundle:Deliverable:add.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function addAction(Request $request, Project $project)
    {
        $documentProject = new DocumentProject();
        $form = $this->createForm(DocumentProjectType::class, $documentProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $documentProject->addProject($project);
            $em->persist($documentProject);
            $em->flush();

            return $this->redirectToRoute('ebmgdp_deliverable', array('id' => $documentProject->getId(), 'code' => $project->getCode()));
        }

        return $this->render('EBMGDPBundle:Deliverable:add.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }
}