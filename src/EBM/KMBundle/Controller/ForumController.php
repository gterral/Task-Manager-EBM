<?php

namespace EBM\KMBundle\Controller;

use Core\UserBundle\Entity\User;
use EBM\KMBundle\Entity\Post;
use EBM\KMBundle\Entity\Topic;
use EBM\KMBundle\Entity\Vote;
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

    public function upVotePostAction (User $user_id, Post $post_id ) {
        $em = $this->getDoctrine()->getManager();
        $votes = $post_id->getVotes() ;
        $nUser = 0;
        foreach ($votes as $vote) {
            if ($vote->getUser() == $user_id){
                $nUser++;
            }
        }
        if ($nUser>0) {
            return $this->redirectToRoute('ebmkm_forum_topic', array('id' => $post_id->getTopic()->getId()));
        }
        else {
            $vote = new Vote();
            $vote->setValue(1);
            $vote->setPost($post_id);
            $vote->setUser($user_id);
            $em->persist($vote);
            $em->flush();
            return $this->redirectToRoute('ebmkm_forum_topic', array('id' => $post_id->getTopic()->getId()));
        }

    }

    public function downVotePostAction (User $user_id,Post  $post_id) {
        $em = $this->getDoctrine()->getManager();
        $votes = $post_id->getVotes() ;
        $nUser = 0;
        foreach ($votes as $vote) {
            if ($vote->getUser() == $user_id){
                $nUser++;
            }
        }
        if ($nUser>0) {
            return $this->redirectToRoute('ebmkm_forum_topic', array('id' => $post_id->getTopic()->getId()));
        }
        else {
            $vote = new Vote();
            $vote->setValue(-1);
            $vote->setPost($post_id);
            $vote->setUser($user_id);
            $em->persist($vote);
            $em->flush();
            return $this->redirectToRoute('ebmkm_forum_topic',  array('id' => $post_id->getTopic()->getId()));

        }
    }
    public function viewTopicAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // Afficher le topic avec la liste des posts
        $topic = $this->getDoctrine()->getRepository('EBMKMBundle:Topic')->find($id);
        if(!$topic) {
            throw new NotFoundHttpException("Topic non trouvé");
        }

        // Gérer le formulaire de réponse
        $answer = new Post();
        $form = $this->createForm(PostType::class, $answer);
        $form->handleRequest($request);


        if($form->isValid()) {
            // Si réponse, la traiter
            $this->denyAccessUnlessGranted('ROLE_USER', null, 'Blblblb');
            $answer->setTopic($topic);
            $answer->setAuthor($this->getUser());
            $em->persist($answer);
            $em->flush();
            return $this->redirectToRoute('ebmkm_forum_topic', array('id' => $id));
        }
        else {
            // Sinon, juste incrémentation nombre de vues
            $topic->increaseNbViews();
            $em->persist($topic);
            $em->flush();
            return $this->render('EBMKMBundle:Forum:viewTopic.html.twig', array('topic' => $topic, 'form' => $form->createView()));
        }
    }

/*
 *
 *$repository = $this->getDoctrine()->getRepository('EBMKMBundle:Vote');

// createQueryBuilder() automatically selects FROM AppBundle:Product
// and aliases it to "p"
$Upquery = $repository->createQueryBuilder('v')
    ->where('v.post_id = :post_id AND v.value= :value')
    ->setParameter('post_id', $post_id)
    ->setParameter('value', 1)
    ->select('count(v.value)')
    ->getQuery()
    ->getSingleScalarResult();

$nUpvotes = $Upquery->getResult();

$Downquery = $repository->createQueryBuilder('v')
    ->select('count(v.value)')
    ->where('v.post_id = :post_id AND v.value= :value')
    ->setParameter('post_id', $post_id)
    ->setParameter('value', -1)
    ->getQuery()
    ->getSingleScalarResult();

$nDownvotes = $Downquery->getResult();

 */


}
