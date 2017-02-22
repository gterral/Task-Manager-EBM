<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 22/02/2017
 * Time: 15:17
 */

namespace EBM\GDPBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EBM\KMBundle\Entity\Tag;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadFakeTags implements FixtureInterface, ContainerAwareInterface {
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
        $tag1 = new Tag();
        $tag1->setName("Tag 1");
        $tag1->setDescription("La description du tag1");
        $tag1->setType("general");
        $entityManager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setName("Tag 2");
        $tag2->setDescription("La description du tag2");
        $tag2->setType("general");
        $entityManager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setName("Tag 3");
        $tag3->setDescription("La description du tag3");
        $tag3->setType("general");
        $entityManager->persist($tag3);

        $entityManager->flush();
    }
}
