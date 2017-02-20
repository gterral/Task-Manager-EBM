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

    public function load(ObjectManager $entityManager)
    {
      $task = new Task();
      $task->setName('Faire le ménage');
      $task->setDeadline(date());
      $task->setStatus('In progress');
      $task->setType('logistic');

      $conversation = new Conversation();
      $task->setConversation($conversation);

      $comment = new Comment();
      $comment->setContent('Salut les gars ouéééé');

      $comment->setConversation($conversation);

      $entityManager->persist($task);
      $entityManager->persist($conversation);
      $entityManager->persist($comment);
      $entityManager->flush();
    }
}
