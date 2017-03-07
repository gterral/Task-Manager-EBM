<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 27/02/2017
 * Time: 08:56
 */

namespace EBM\KMBundle\Controller;


use EBM\KMBundle\Entity\Document;
use EBM\KMBundle\Entity\EvaluationDocument;
use EBM\KMBundle\Entity\Post;
use EBM\KMBundle\Entity\Topic;
use EBM\KMBundle\Form\DocumentType;
use EBM\KMBundle\Form\EvaluationDocumentType;
use EBM\KMBundle\Form\PostType;
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

    public function detailAction($id, Request $request){
        /** @var Document $document */
        $document = $this->getDoctrine()->getRepository('EBMKMBundle:Document')->find($id);
        $em = $this->getDoctrine()->getManager();

        // SEE AND POST COMMENTS
        $user = $this->getUser();
        if($document->getCommentTopic()){
            $topic = $document->getCommentTopic();
        }
        else{
            $topic = new Topic();
            $topic
                ->setTitle($document->getName())
                ->setCreator($user);
            $document->setCommentTopic($topic);
        }

        $post = new Post();
        $post->setTopic($topic);
        $post->setAuthor($this->getUser());

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($topic);
            $em->persist($post);
            $em->persist($document);
            $em->flush();
            return $this->redirectToRoute('ebmkm_forum_topic', array('id' => $topic->getId()));
        }

        // GET THE GRADE OF THE DOCUMENT OR EVALUATE IT
        if(sizeof($document->getEvaluations()) > 0){
            $moyenne = 0;
            foreach ($document->getEvaluations() as $evaluation){
                $moyenne += $evaluation->getValue();
            }
            $moyenne = $moyenne/sizeof($document->getEvaluations());
        }
        else{
            $moyenne = -1;
        }

        $personalEvaluation = $this->getDoctrine()->getRepository('EBMKMBundle:EvaluationDocument')
            ->findBy(['author' => $this->getUser(), 'document' => $document]);

        $evaluation = new EvaluationDocument();
        $evaluationForm = $this->createForm(EvaluationDocumentType::class, $evaluation);
        $evaluationForm->handleRequest($request);
        if($evaluationForm->isSubmitted() && $evaluationForm->isValid()){
            $evaluation->setAuthor($this->getUser());
            $evaluation->setDocument($document);
            $em->persist($evaluation);
            $em->flush();
            return $this->redirectToRoute('ebmkm_file_detail', array('id' => $document->getId()));
        }

        return $this->render('EBMKMBundle:Documents:detail.html.twig', array(
            'document' => $document,
            'grade' => $moyenne,
            'form' => $form->createView(),
            'personalEvaluation' => $personalEvaluation,
            'evaluationForm' => $evaluationForm->createView()
        ));
    }

}