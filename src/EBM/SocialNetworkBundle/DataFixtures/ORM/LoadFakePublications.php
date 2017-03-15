<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 04/02/2017
 * Time: 14:13
 */

namespace Core\UserBundle\DataFixtures\ORM;

use Core\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EBM\SocialNetworkBundle\Entity\Comment;
use EBM\SocialNetworkBundle\Entity\Likes;
use EBM\SocialNetworkBundle\Entity\Publication;
use EBM\UserInterfaceBundle\Entity\Project;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EBM\KMBundle\Entity\Tag;

class LoadFakePublications implements FixtureInterface, ContainerAwareInterface
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
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.password_encoder');

        $tag1 = new Tag();
        $tag1->setName('Mécanique');
        $tag1->setDescription('Tag de méca');
        $tag1->setType('type meca');

        $project1 = new Project();
        $project1->setDescription('Premier projet de malade');
        $project1->setSlug('slug');
        $project1->setIsActive(0);
        $project1->setName('Projet number 1');
        $project1->setProjectType('projet de ouf');
        $project1->setCode(34);

        $project2 = new Project();
        $project2->setDescription('Premier projet de malade');
        $project2->setSlug('slug');
        $project2->setIsActive(0);
        $project2->setName('Projet number 2 create by gomar');
        $project2->setProjectType('projet de ouf');
        $project2->setCode(33);

        $tag2 = new Tag();
        $tag2->setName('Elec');
        $tag2->setDescription('Tag de elec');
        $tag2->setType('type elec');

        $user1 = new User();
        $user1->setUsername('Margot');
        $user1->setEmail('m.quettelart@gmail.com');
        $user1->setPassword($encoder->encodePassword($user1, 'ebm_margot'));
        $user1->setEnabled(true);
        $user1->addRole("ROLE_STUDENT");

        $pub1 = new Publication();
        $pub1->setContent('ptdr');
        $pub1->addTag($tag1);
        $pub1->addTag($tag2);
        $pub1->setUserPublication($user1);

        $pub2 = new Publication();
        $pub2->setContent('Je push sur GIT');
        $pub2->addTag($tag1);
        $pub2->setUserPublication($user1);

        $comment1 = new Comment();
        $comment1->setContent('Je commit sur GIT');
        $comment1->setPublication($pub1);

        $like2 = new Likes();
        $like2->setPublication($pub2);

        $manager->persist($tag1);
        $manager->persist($project1);
        $manager->persist($project2);
        $manager->persist($user1);
        $manager->persist($pub1);
        $manager->persist($pub2);
        $manager->persist($comment1);
        $manager->persist($like2);
        $manager->flush();

    }
}
