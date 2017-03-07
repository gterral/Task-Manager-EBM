<?php

namespace EBM\KMBundle\Controller;

use Core\UserBundle\Entity\User;
use EBM\KMBundle\Entity\CompetenceUser;
use EBM\KMBundle\Form\CompetenceUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SkillsController extends Controller
{
    public function renderUserSkillsAction() {
        /** @var User $user */
        $user = $this->getUser();

        return $this
            ->render('EBMKMBundle:Skills:usersSkill.html.twig', array('user' => $user));
    }

    public function addSkillAction(Request $request) {
        $skill = new CompetenceUser();
        $form = $this->createForm(
            CompetenceUserType::class,
            $skill,
            array('tags' => $this->get('ebmkm.tag')->getAllTags())
        );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $skill->setUser($this->getUser());
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute("ebmkm_my_skills");
        }

        return $this->render('@EBMKM/Skills/newSkill.html.twig', array('form' => $form->createView()));
    }

    public function removeSkillAction($id, Request $request) {
        $skill = $this->getDoctrine()->getRepository('EBMKMBundle:CompetenceUser')->find($id);

        if(NULL === $skill || $skill->getUser() !== $this->getUser())
            throw new HttpException(403, 'Non autorisé');

        // Formulaire vide avec juste un bouton de suppression
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skill);
            $em->flush();

            return $this->redirectToRoute('ebmkm_my_skills');

        }

        return $this->render('@EBMKM/Skills/deleteSkill.html.twig', ['skill' => $skill, 'form' => $form->createView()]);



    }
}
