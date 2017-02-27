<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use EBM\UserInterfaceBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaskController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function indexAction(Project $project)
    {
        // On return la vue avec la liste des tâches
        return $this->render('EBMGDPBundle:Task:index.html.twig',
            array('listTasks' => $project->getTasks(),
                'project' => $project
            )
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"id":"id"}})
     */
    public function viewAction(Task $task)
    {
        return $this->render('EBMGDPBundle:Task:view.html.twig',
            array('task'=> $task)
        );
    }

    public function taskCrudAction(Request $request)
    {
        // On cr�e un objet Task
        $task = new Task();

        // On cr�e le FormBuilder gr�ce au service form factory
        $form = $this->createForm(TaskType::class, $task);

        // Si la requ�te est en POST
        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {

            // On enregistre notre objet $task dans la base de donn�es, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'T�che bien enregistr�e.');

            // On redirige vers la page de visualisation de la t�che nouvellement cr��e
            return $this->redirectToRoute('ebmgdp_task', array('id' => $form->getId()));
        }

        // � ce stade, le formulaire n'est pas valide car :
        // - Soit la requ�te est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requ�te est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('EBMGDPBundle:Task:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
