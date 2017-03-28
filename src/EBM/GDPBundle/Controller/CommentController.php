<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\DocumentProject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EBM\GDPBundle\Entity\Comment;
use EBM\GDPBundle\Entity\Task;
use EBM\GDPBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use EBM\GDPBundle\Entity\Conversation;
use EBM\UserInterfaceBundle\Entity\Project;

class CommentController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("task",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function addCommentOnTaskAction(Task $task,Request $request,Project $project)
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form = $this->createForm(CommentType::class, $comment,
            ['action'=>$this->generateUrl('ebmgdp_task_comment_add',['code'=>$project->getCode(),'id'=>$task->getId()])]
        );
        // On crée un objet Conversation
        if ($task->getConversation() == null){
            $conversation = new Conversation();
            $task->setConversation($conversation);
        }
        else{
            $conversation = $task->getConversation();
        }

        $comment->setUtilisateur($this->getUser());
        $conversation->addComment($comment);

        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($conversation);
            $em->persist($comment);
            $em->flush();

            return $this->redirect($request->headers->get('referer'));

        }
        return $this->render('EBMGDPBundle:Comment:add.html.twig',
            array('task'=> $task,
                'form'=> $form->createView(),
                'project'=>$project)
        );

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("task",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     * @ParamConverter("comment",options={"mapping": {"idc":"id"}})
     */
    public function editCommentOnTaskAction(Task $task,Request $request,Project $project,Comment $comment)
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $form = $this->createForm(CommentType::class, $comment,
            ['action'=>$this->generateUrl('ebmgdp_task_comment_edit',['code'=>$project->getCode(),'id'=>$task->getId(),'idc'=>$comment->getId()])]
        );

        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($request->headers->get('referer'));

        }
        return $this->render('EBMGDPBundle:Comment:edit.html.twig',
            array('task'=> $task,
                'form'=> $form->createView(),
                'project'=>$project,
                'comment'=>$comment)
        );

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("task",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     * @ParamConverter("comment",options={"mapping": {"idc":"id"}})
     */
    public function deleteCommentOnTaskAction(Task $task,Project $project,Comment $comment,Request $request)
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();


        return new JsonResponse(array('success' => true));

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     * @ParamConverter("documentProject",options={"mapping": {"id":"id"}})
     */
    public function addCommentOnDeliverableAction(Project $project, DocumentProject $documentProject, Request $request)
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment,
            ['action'=>$this->generateUrl('ebmgdp_deliverable_comment_add',['code'=>$project->getCode(),'id'=>$documentProject->getId()])]
        );

        // On crée un objet Conversation
        if ($documentProject->getConversation() == null){
            $conversation = new Conversation();
            $documentProject->setConversation($conversation);
        }
        else{
            $conversation = $documentProject->getConversation();
        }

        $comment->setUtilisateur($this->getUser());
        $conversation->addComment($comment);

        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($request->headers->get('referer'));

        }
        return $this->render('EBMGDPBundle:Comment:add.html.twig',
            array('documentProject'=> $documentProject,
                'form'=> $form->createView(),
                'project'=>$project)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("documentProject",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     * @ParamConverter("comment",options={"mapping": {"idc":"id"}})
     */
    public function editCommentOnDeliverableAction(DocumentProject $documentProject,Project $project,Comment $comment,Request $request)
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $form = $this->createForm(CommentType::class, $comment,
            ['action'=>$this->generateUrl('ebmgdp_deliverable_comment_edit',['code'=>$project->getCode(),'id'=>$documentProject->getId(),'idc'=>$comment->getId()])]
        );

        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($request->headers->get('referer'));

        }
        return $this->render('EBMGDPBundle:Comment:edit.html.twig',
            array('documentProject'=> $documentProject,
                'form'=> $form->createView(),
                'project'=>$project,
                'comment'=>$comment)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("documentProject",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     * @ParamConverter("comment",options={"mapping": {"idc":"id"}})
     */
    public function deleteCommentOnDeliverableAction(DocumentProject $documentProject,Project $project,Comment $comment,Request $request)
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();


        return new JsonResponse(array('success' => true));

    }
}
