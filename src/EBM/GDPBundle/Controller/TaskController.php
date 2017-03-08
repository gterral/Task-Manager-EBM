<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use EBM\UserInterfaceBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use EBM\GDPBundle\Form\TaskType;
use EBM\GDPBundle\Entity\Conversation;


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
     * @ParamConverter("task",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function viewAction(Task $task,Request $request,Project $project)
    {
        return $this->render('EBMGDPBundle:Task:view.html.twig',
            array('task'=> $task,
                'project'=>$project)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function addTaskAction(Project $project,Request $request)
    {
        // On cr�e un objet Task
        $task = new Task();
        $conversation1 = new Conversation();
        $task->setConversation($conversation1);
        $project->addTask($task);

        // On cr�e le FormBuilder gr�ce au service form factory
        $form = $this->createForm(TaskType::class, $task);

        // Si la requ�te est en POST
        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {

            // On enregistre notre objet $task dans la base de donn�es, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->persist($task);
            $em->flush();

            $request
                ->getSession()
                ->getFlashBag()
                ->add('notice', 'Tâche bien enregistrée.');

            // On redirige vers la page de visualisation de la tâche nouvellement cr��e
            return $this
                ->redirectToRoute('ebmgdp_task', array('id' => $task->getId(),'code'=>$project->getCode()));
        }

        // � ce stade, le formulaire n'est pas valide car :
        // - Soit la requ�te est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requ�te est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('EBMGDPBundle:Task:add.html.twig', array(
            'form' => $form->createView(),
            'project' => $project
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("task",options={"mapping": {"id":"id"}})
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function editTaskAction(Task $task,Project $project,Request $request)
    {

        if (!$task) {
            throw $this->createNotFoundException('Tâche non trouvée.');
        }

        // On crée le FormBuilder grâce au service form factory
        $form = $this->createForm(TaskType::class, $task);

        // Si la requ�te est en POST
        if ($request->isMethod('POST')  && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            // On enregistre notre objet $task dans la base de données, par exemple
            $em->persist($task);
            $em->flush();

            $request
                ->getSession()
                ->getFlashBag()->add('notice', 'Tâche bien modifiée.');

            // On redirige vers la page de visualisation de la tâche nouvellement créee
            return $this->redirectToRoute('ebmgdp_task', array('id' => $task->getId(), 'code' => $project->getCode()));
        }

        // � ce stade, le formulaire n'est pas valide car :
        // - Soit la requ�te est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requ�te est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('EBMGDPBundle:Task:edit.html.twig', array(
            'form' => $form->createView(),
            'project' => $project,
            'task' => $task
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     * @ParamConverter("task",options={"mapping": {"id":"id"}})
     */
    public function archivedTaskAction(Task $task,Project $project, Request $request)
    {
        if (!$task) {
            throw $this->createNotFoundException('Tâche non trouvée.');
        }

            $task->setStatus('ARCHIVED');
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Tâche bien modifiée.');

        return $this->redirectToRoute('ebmgdp_projecttasks', array('code' => $project->getCode()));
    }


    public function editTaskStatusAction(Request $request)
    {
        $new_status = $request->request->get("status");
        $task_id = $request->request->get("task_id");

        if(!empty($new_status) and !empty($task_id)){

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository("EBMGDPBundle:Task");
            $task = $repository->find($task_id);

            if($task != null)
            {
                $task->setStatus($new_status);
                $this->getDoctrine()->getManager()->flush();
                return new JsonResponse(array('success' => true));
            }
            return new JsonResponse(array('success' => false,'error' => "Wrong Task Id"));

        }
        return new JsonResponse(array('success' => false,'error' => "New status is empty"));
    }

}
