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
use EBM\UserInterfaceBundle\Entity\Project;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadFakeUsers implements FixtureInterface, ContainerAwareInterface
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
        $encoder = $this->container->get('security.password_encoder');

        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('nicolas.mercier-pro@hotmail.fr');
        $userAdmin->setPassword($encoder->encodePassword($userAdmin, 'ebm_admin'));
        $userAdmin->setEnabled(true);
        $userAdmin->addRole("ROLE_ADMIN");

        $userStudent = new User();
        $userStudent->setUsername('toto');
        $userStudent->setEmail('nicolaspro14@gmail.com');
        $userStudent->setPassword($encoder->encodePassword($userStudent, 'ebm_toto'));
        $userStudent->setEnabled(true);
        $userStudent->addRole("ROLE_STUDENT");

        $project_names = array(
            'D�veloppement module1',
            'D�veloppement module2',
            'CycloAppart',
            'Tremonor',
            'MonUniformeScolaire'
        );

        foreach ($project_names as $name_p) {
            // On cr�e la cat�gorie
            $project = new Project();
            $project->setName($name_p);

            // On la persiste
            $manager->persist($project);
        }

        $manager->persist($userAdmin);
        $manager->persist($userStudent);
        $manager->flush();
    }
}
