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
use EBM\SocialNetworkBundle\Entity\Comment;
use EBM\SocialNetworkBundle\Entity\Likes;
use EBM\SocialNetworkBundle\Entity\Publication;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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

    public function load(ObjectManager $manager)
    {

        $pub1 = new Publication();
        $pub1->setContent('ptdr');

        $pub2 = new Publication();
        $pub2->setContent('Je push sur GIT');

        $comment1 = new Comment();
        $comment1->setContent('Je commit sur GIT');
        $comment1->setPublication($pub1);

        $like2 = new Likes();
        $like2->setPublication($pub2);

        $manager->persist($pub1);
        $manager->persist($pub2);
        $manager->persist($comment1);
        $manager->persist($like2);
        $manager->flush();
    }
}
