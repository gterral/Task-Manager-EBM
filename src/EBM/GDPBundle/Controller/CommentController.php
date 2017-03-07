<?php

namespace EBM\GDPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EBM\GDPBundle\Entity\Comment;
use EBM\GDPBundle\Entity\Task;
use EBM\GDPBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

}
