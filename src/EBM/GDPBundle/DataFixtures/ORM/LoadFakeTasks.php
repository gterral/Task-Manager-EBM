<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 04/02/2017
 * Time: 14:13
 */

namespace EBM\GDPBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\UserBundle\Entity\User;
use EBM\GDPBundle\Entity\Comment;
use EBM\GDPBundle\Entity\Conversation;
use EBM\GDPBundle\Entity\DocumentProject;
use EBM\GDPBundle\Entity\DocumentTypeProject;
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

        $document_type1 = new DocumentTypeProject();
        $document_type1->setName('Rapport');
        $entityManager->persist($document_type1);

        $document_type2 = new DocumentTypeProject();
        $document_type2->setName('Presentation');
        $entityManager->persist($document_type2);

        $document_projet1 = new DocumentProject();
        $document_projet1->setName('Compte Rendu 1');
        $document_projet1->setDocumentTypeProject($document_type1);
        $document_projet1->addProject($projet);
        $document_projet1->setDeadlineDate(new datetime('2017-05-15'));
        $document_projet1->setDescription('Rédiger le compte rendu de la derniere RC.');
        $entityManager->persist($document_projet1);

        $comment111 = new Comment();
        $comment111->setContent('Blablablabla on a deposer un livrable');

        $comment112 = new Comment();
        $comment112->setContent('Blablablabla Veuillez corriger ceci ce ci et ceci');

        $comment113 = new Comment();
        $comment113->setContent('Blablablabla nouvelle version du livrable deposé, avec vos commentaires');

        $comment114 = new Comment();
        $comment114->setContent('Blablablabla TB');

        $conversation11 = new Conversation();
        $document_projet1->setConversation($conversation11);
        $conversation11->addComment($comment111);
        $conversation11->addComment($comment112);
        $conversation11->addComment($comment113);
        $conversation11->addComment($comment114);

        $document_projet2 = new DocumentProject();
        $document_projet2->setName('Presentation 1');
        $document_projet2->setDocumentTypeProject($document_type2);
        $document_projet2->addProject($projet);
        $document_projet2->setDeadlineDate(new datetime('2017-05-15'));
        $document_projet2->setDescription('Faire la présentation de la soutance finale.');
        $entityManager->persist($document_projet2);

        /* @var User $user */
        $user=$entityManager->getRepository("CoreUserBundle:User")->findOneBy(['username'=>"toto"]);
        $user->addProject($projet);



        $entityManager->flush();

    }
}
