<?php

namespace EBM\KMBundle\Controller;

use Core\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkillsController extends Controller
{
    public function renderUserSkillsAction() {
        /** @var User $user */
        $user = $this->getUser();

        return $this
            ->render('EBMKMBundle:Skills:usersSkill.html.twig', array('user' => $user));
    }
}
