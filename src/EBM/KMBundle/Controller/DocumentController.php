<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 27/02/2017
 * Time: 08:56
 */

namespace EBM\KMBundle\Controller;


use EBM\KMBundle\Entity\Document;
use EBM\KMBundle\Form\DocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DocumentController extends Controller
{

    public function indexAction(){

        $documents = $this->getDoctrine()->getRepository('EBMKMBundle:Document')->findAll();

        return $this->render('EBMKMBundle:Documents:index.html.twig', array("documents" => $documents));
    }
    
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadAction(Request $request){

        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $file */
            $file = $document->getFile();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('files_directory'),
                $fileName
            );

            // replace the file by its name
            $document->setFile($fileName);

            // The document's author is the current user
            $user = $this->getUser();
            $document->setAuthor($user);

            // Persist the newly created document
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirect($this->generateUrl('ebmkm_homepage'));

        }

        return $this->render('EBMKMBundle:Documents:upload.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    public function detailAction($id){
        $document = $this->getDoctrine()->getRepository('EBMKMBundle:Document')->find($id);
        return $this->render('EBMKMBundle:Documents:detail.html.twig', array('document' => $document));
    }

}