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
use EBM\KMBundle\Entity\CompetenceUser;
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


        $user1 = $entityManager->getRepository('CoreUserBundle:User')->findOneBy(array('username' => 'admin'));
        $user2 = $entityManager->getRepository('CoreUserBundle:User')->findOneBy(array('username' => 'toto'));

        // Toto est compétent sur tag 1
        $cmp1 = new CompetenceUser();
        $cmp1->setTag($tag1);
        $user2->addSkill($cmp1);

        // Et sur tag 2
        $cmp2 = new CompetenceUser();
        $cmp2->setTag($tag2);
        $user2->addSkill($cmp2);

        // Admin sur tag 3
        $cmp3 = new CompetenceUser();
        $cmp3->setTag($tag3);
        $user1->addSkill($cmp3);

        // Et admin le recommande
        $cmp1->addRecommendation($user1);

        $entityManager->persist($cmp1);
        $entityManager->persist($cmp2);
        $entityManager->persist($cmp3);
        $entityManager->persist($user1);
        $entityManager->persist($user2);


        $entityManager->flush();
    }
}
