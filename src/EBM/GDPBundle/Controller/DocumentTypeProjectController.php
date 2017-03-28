<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\DocumentTypeProject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class DocumentTypeProjectController extends Controller
{
    /**
     * Lists all documentTypeProject entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentTypeProjects = $em->getRepository('EBMGDPBundle:DocumentTypeProject')->findAll();

        return $this->render('EBMGDPBundle:Insight:documentTypeProject/index.html.twig', array(
            'documentTypeProjects' => $documentTypeProjects,
        ));
    }

    public function newAction(Request $request)
    {
        $documentTypeProject = new Documenttypeproject();
        $form = $this->createForm('EBM\GDPBundle\Form\DocumentTypeProjectType', $documentTypeProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($documentTypeProject);
            $em->flush();

            return $this->redirectToRoute('ebmgdp_insight_documenttypeproject_show', array('id' => $documentTypeProject->getId()));
        }

        return $this->render('EBMGDPBundle:Insight:documentTypeProject/new.html.twig', array(
            'documentTypeProject' => $documentTypeProject,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param DocumentTypeProject $documentTypeProject
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("documentTypeProject",options={"mapping": {"id":"id"}})
     */

    public function showAction(DocumentTypeProject $documentTypeProject)
    {

        return $this->render('EBMGDPBundle:Insight:documentTypeProject/show.html.twig', array(
            'documentTypeProject' => $documentTypeProject
        ));
    }

    /**
     * @param DocumentTypeProject $documentTypeProject
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("documentTypeProject",options={"mapping": {"id":"id"}})
     */
    public function editAction(Request $request, DocumentTypeProject $documentTypeProject)
    {

        $editForm = $this->createForm('EBM\GDPBundle\Form\DocumentTypeProjectType', $documentTypeProject);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ebmgdp_insight_documenttypeproject_index');
        }

        return $this->render('EBMGDPBundle:Insight:documentTypeProject/edit.html.twig', array(
            'documentTypeProject' => $documentTypeProject,
            'form' => $editForm->createView()
        ));
    }

    /**
     * @param DocumentTypeProject $documentTypeProject
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("documentTypeProject",options={"mapping": {"id":"id"}})
     */
    public function deleteAction(Request $request, DocumentTypeProject $documentTypeProject)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($documentTypeProject);
        $em->flush();

        return $this->redirectToRoute('ebmgdp_insight_documenttypeproject_index');
    }

}
