<?php

namespace EBM\GDPBundle\Utilities;


// Ce service centralise les actions sur les profils et médias

use Core\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use EBM\UserInterfaceBundle\Entity\Project;

class PermissionsManager {
    

    private $em;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->em=$entityManager;
    }


    /**
     * Check whether the user has access to project or not
     * If not, this method will throw an exception
     *
     * @param Project $project
     */
    public function isGrantedAccessForProject(Project $project, User $user)
    {
        $userProjects = $user->getProjects();

        if (!$userProjects->contains($project)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Sorry not allowed!');
        }
    }
}