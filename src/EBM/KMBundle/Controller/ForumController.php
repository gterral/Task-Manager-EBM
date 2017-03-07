<?php

namespace EBM\KMBundle\Controller;

use EBM\KMBundle\Entity\Post;
use EBM\KMBundle\Entity\Topic;
use EBM\KMBundle\Form\PostType;
use EBM\KMBundle\Form\TopicType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ForumController extends Controller
{
    public function indexAction()
    {
        $topics = $this->getDoctrine()->getRepository('EBMKMBundle:Topic')->findAll(); //TODO : pagination
        return $this->render('EBMKMBundle:Forum:index.html.twig', array('topics' => $topics));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */

    public function createTopicAction(Request $request)
    {
        // Création du topic et du premier post
        $topic = new Topic();
        $post = new Post();

        // Liens entre les différents éléments
        $topic->addPost($post);
        $topic->setCreator($this->getUser());
        $post->setAuthor($this->getUser());

        // Gestion du formulaire
        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($topic);
            $em->flush();
            return $this->redirectToRoute('ebmkm_forum_topic', array('id' => $topic->getId()));
        }


        return $this->render('EBMKMBundle:Forum:createTopic.html.twig', array('form' => $form->createView()));
    }

    public function viewTopicAction($id)
    {
        $topic = $this->getDoctrine()->getRepository('EBMKMBundle:Topic')->find($id);

        if(!$topic)
        {
            throw new NotFoundHttpException("Topic non trouvé");
        }

        // Incrémentation nombre de vues
        $topic->increaseNbViews();
        $em = $this->getDoctrine()->getManager();
        $em->persist($topic);
        $em->flush();

        return $this->render('EBMKMBundle:Forum:viewTopic.html.twig', array('topic' => $topic));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */

    // public function voterPour(){
    //     if ($natureVote=="yes")
    //  {
    //      $value=$value + 1;
    //  }
    //   if ($natureVote=="non")
    //   {
    //      $value=$value - 1;
    //  }
    // }
    public function answerTopicAction($id, Request $request){
        $topic = $this->getDoctrine()->getRepository('EBMKMBundle:Topic')->find($id);
        $post = new Post();
        $post->setTopic($topic);
        $post->setAuthor($this->getUser());



        $form = $this->createForm(PostType::class, $post);
        //$form->add('Go','submit');
        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('ebmkm_forum_topic', array('id' => $topic->getId()));
        }


        return $this->render('EBMKMBundle:Forum:answerTopic.html.twig', array('form' => $form->createView()));

    }
}
