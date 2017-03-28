<?php

namespace EBM\UserInterfaceBundle\Controller;

use EBM\UserInterfaceBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ProjectsController extends Controller
{
    public function addProjectAction(Request $request)
    {
        $project = new Project();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $project);

        $formBuilder
            ->add('name', TextType::class)
            ->add('projectType', TextType::class)
            ->add('code', TextType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class)
        ;

        $form = $formBuilder->getForm();

        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);

            if ($form->isValid())
            {
                /* On rajoute les attributs manquants */


                $project->setIsActive(true);
                $project->setCreationDate(/*la date de maintenant*/);
                $project->setLastUpdate(/*la date de maintenant*/);


                /* [ON UTILISERA CETTE MÉTHODE QUAND J'ARRIVERAI À FAIRE MARCHER DJANGO] */
                /* On utilise l'API Django */


                return $this->redirectToRoute('ebm_user_project_creation');
            }
        }

        return $this->render('EBMUserInterfaceBundle:Projects:createProject.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function viewProjectAction($id)
    {

    }
}