<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 04/02/2017
 * Time: 14:13
 */

namespace EBM\GDPBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\UserBundle\Entity\User;
use EBM\GDPBundle\Entity\Comment;
use EBM\GDPBundle\Entity\Conversation;
use EBM\GDPBundle\Entity\Task;
use EBM\UserInterfaceBundle\Entity\Project;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadFakeTasks implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $entityManager
     */
    public function load(ObjectManager $entityManager)
    {
        $task1 = new Task();
        $task1->setName('Faire le ménage');
        $task1->setDeadline(\DateTime::createFromFormat('d/m/Y','30/02/2017'));
        $task1->setStatus('IN_PROGRESS');
        $task1->setType('logistic');
        $entityManager->persist($task1);

        $conversation1 = new Conversation();
        $task1->setConversation($conversation1);

        $comment11 = new Comment();
        $comment11->setContent('Salut les gars ouéééé');
        $conversation1->addComment($comment11);

        $comment12 = new Comment();
        $comment12->setContent('Pas envie de faire le ménage');
        $conversation1->addComment($comment12);

        $task2 = new Task();
        $task2->setName('Ajouter Issues');
        $task2->setStatus('IN_PROGRESS');
        $task2->setDeadline(\DateTime::createFromFormat('d/m/Y','20/02/2017'));
        $task2->setType('IT');
        $entityManager->persist($task2);

        $conversation2 = new Conversation();
        $task2->setConversation($conversation2);

        $comment21 = new Comment();
        $comment21->setContent('Dashboard - Gestion');
        $conversation2->addComment($comment21);

        $comment22 = new Comment();
        $comment22->setContent('Users - Gestion');
        $conversation2->addComment($comment22);

        $projet = new Project();
        $projet->setName("Mon super projet");
        $projet->setDescription("Description de mon super projet");
        $projet->setCode("MSP");
        $projet->addTask($task1);
        $projet->addTask($task2);
        $projet->setProjectType("G1G2");
        $entityManager->persist($projet);

        /* @var User $user */
        $user=$entityManager->getRepository("CoreUserBundle:User")->findOneBy(['username'=>"toto"]);
        $user->addProject($projet);



        $entityManager->flush();

    }
}
