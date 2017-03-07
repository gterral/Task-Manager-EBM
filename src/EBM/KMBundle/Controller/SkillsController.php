<?php

namespace EBM\KMBundle\Controller;

use Core\UserBundle\Entity\User;
use EBM\KMBundle\Entity\CompetenceUser;
use EBM\KMBundle\Form\CompetenceUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SkillsController extends Controller
{
    public function renderUserSkillsAction() {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('EBMKMBundle:Skills:usersSkill.html.twig', array('user' => $user));
    }

    public function seeSkillAction($id) {
        /** @var User $user */
        if(!$user = $this->getDoctrine()->getRepository('CoreUserBundle:User')->find($id))
            throw new HttpException(404, 'Utilisateur non trouvé');

        return $this->render('EBMKMBundle:Skills:usersSkill.html.twig', array('user' => $user));
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
            if($this->userAlreadyDeclaredThisSkill($skill, $this->getUser()->getSkills()))
                throw new HttpException(403, 'Déjà déclaré'); // Todo: faire un truc plus chouette en cas d'erreur

            $em = $this->getDoctrine()->getManager();

            $skill->setUser($this->getUser());
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute("ebmkm_my_skills");
        }

        return $this->render('@EBMKM/Skills/newSkill.html.twig', array('form' => $form->createView()));
    }

    public function recommendSkillAction($user_id, $skill_id) {

        if(!$skill = $this->checkRecommendationIsValid($user_id, $skill_id))
            throw new HttpException(500, 'Invalid'); //Todo : faire un truc plus joli ici

        if($skill->getRecommendations()->contains($this->getUser()))
            throw new HttpException(500, 'Déjà recommandé'); // Todo: faire un truc plus joli ici.

        // Ajout de la recommandation et sauvegarde.
        $skill->addRecommendation($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($skill);
        $em->flush();

        return $this->redirectToRoute('ebmkm_other_skills', ['id' => $user_id]);
    }

    public function unRecommendSkillAction($user_id, $skill_id) {
        if(!$skill = $this->checkRecommendationIsValid($user_id, $skill_id))
            throw new HttpException(500, 'Invalid'); //Todo : faire un truc plus joli ici

        if(!$skill->getRecommendations()->contains($this->getUser()))
            throw new HttpException(500, 'Non recommandé'); // Todo: faire un truc plus joli ici.

        // Suppression de la recommandation et sauvegarde.
        $skill->removeRecommendation($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($skill);
        $em->flush();

        return $this->redirectToRoute('ebmkm_other_skills', ['id' => $user_id]);
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

    public function userAlreadyDeclaredThisSkill(CompetenceUser $skill, $usersSkills) {

        $tag = $skill->getTag();

        /** @var CompetenceUser $value */
        foreach($usersSkills as $value) {
            if($value->getTag() == $tag)
                return true;
        }
        return false;
    }

    private function checkRecommendationIsValid($user_id, $skill_id)
    {
        if(!$user = $this->getDoctrine()->getRepository('CoreUserBundle:User')->find($user_id))
            return false;
        if(!$skill = $this->getDoctrine()->getRepository('EBMKMBundle:CompetenceUser')->find($skill_id))
            return false;
        if($skill->getUser() !== $user)
            return false;

        return $skill;
    }
}
