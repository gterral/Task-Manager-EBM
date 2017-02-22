<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 04/02/2017
 * Time: 14:13
 */

namespace Core\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\UserBundle\Entity\User;
use EBM\GDPBundle\Entity\Comment;
use EBM\GDPBundle\Entity\Conversation;
use EBM\GDPBundle\Entity\Task;
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

      $project1 = new Project();
      $project1->setId(1);
      $project1->setName('Projet 1 - GestionProjet');
      $project1->setProjectType('Mécanique');
      $project1->code('2017-01');
      $project1->description('Le projet 1 consite en la réalisation d\'un vélo manette permettant de faire du vélo en intérieur toutes en ayant les conditions réelles extérieures de pente et difficulté de montée');
      $project1->setIsActive(true);
      $project1->setCreationDate(\DateTime::createFromFormat('d/m/Y','02/01/2017'));
      $project1->setLastUpdate(\DateTime::createFromFormat('d/m/Y','22/02/2017'));

      $task1 = new Task();
      $task1->setName('Faire le ménage');
      $task1->setDeadline(\DateTime::createFromFormat('d/m/Y','22/02/2017'));
      $task1->setStatus('In progress');
      $task1->setType('logistic');
      $task1->setProject($project1);

      $conversation1 = new Conversation();
      $task1->setConversation($conversation1);

      $comment11 = new Comment();
      $comment11->setContent('Salut les gars ouéééé');
      $comment11->setConversation($conversation1);

      $comment12 = new Comment();
      $comment12->setContent('Pas envie de faire le ménage');
      $comment12->setConversation($conversation1);

        $task2 = new Task();
        $task2->setName('Ajouter Issues');
        $task2->setDeadline(\DateTime::createFromFormat('d/m/Y','20/02/2017'));
        $task2->setStatus('In progress');
        $task2->setType('IT');
        $task2->setProject($project1);

        $conversation2 = new Conversation();
        $task2->setConversation($conversation2);

        $comment21 = new Comment();
        $comment21->setContent('Dashboard - Gestion');
        $comment21->setConversation($conversation2);

        $comment22 = new Comment();
        $comment22->setContent('Users - Gestion');
        $comment22->setConversation($conversation2);

      $entityManager->persist($task1);
      $entityManager->persist($conversation1);
      $entityManager->persist($comment11);
      $entityManager->persist($comment12);

      $entityManager->persist($task2);
      $entityManager->persist($conversation2);
      $entityManager->persist($comment21);
      $entityManager->persist($comment22);

      $entityManager->flush();
    }
}
