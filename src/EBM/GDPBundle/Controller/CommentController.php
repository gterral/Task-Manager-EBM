<?php

namespace EBM\GDPBundle\Controller;

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
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        // On cr�e un objet Conversation
        if ($task->getConversation() == null){
            $conversation = new Conversation();
            $task->setConversation($conversation);
        }
        else{
            $conversation = $task->getConversation();
        }

        $conversation->addComment($comment);

        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
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

        if (!$comment) {
            throw $this->createNotFoundException('Commentaire non trouvé.');
        }

        $form = $this->createForm(CommentType::class, $comment);


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
    public function deleteCommentOnTaskAction(Task $task,Request $request,Project $project,Comment $comment)
    {

        if (!$comment) {
            return new JsonResponse(array('success' => false,'error' => "Commentaire supprimé"));
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();


        return new JsonResponse(array('success' => true));

    }

}
