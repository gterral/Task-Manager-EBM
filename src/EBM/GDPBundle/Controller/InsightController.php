<?php

namespace EBM\GDPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class InsightController extends Controller
{

    public function indexAction()
    {
        $repository_project = $this->getDoctrine()->getRepository('EBMUserInterfaceBundle:Project');
        $projects = $repository_project->findAll();
        $repository_task = $this->getDoctrine()->getRepository('EBMGDPBundle:Task');

        $tasks = $repository_task->findAll();
        $nbtasks = count($tasks);

        $task_opened = $repository_task->findBy(array('status' => 'OPENED'));
        $nb_task_opened = count($task_opened)/$nbtasks;

        $task_working = $repository_task->findBy(array('status' => 'IN_PROGRESS'));
        $nb_task_working = count($task_working)/$nbtasks;

        $task_waiting = $repository_task->findBy(array('status' => 'WAITING_FOR_REVIEW'));
        $nb_task_waiting = count($task_waiting)/$nbtasks;

        $task_validated = $repository_task->findBy(array('status' => 'VALIDATED'));
        $nb_task_validated = count($task_validated)/$nbtasks;

        $task_rejected = $repository_task->findBy(array('status' => 'REJECTED'));
        $nb_task_rejected = count($task_rejected)/$nbtasks;

        $task_archived = $repository_task->findBy(array('status' => 'ARCHIVED'));
        $nb_task_archived = count($task_archived)/$nbtasks;

        return $this->render('EBMGDPBundle:Insight:index.html.twig',
            array('listProjects' => $projects,
                    'listTasks' => $tasks,
                    'nbTaskOpened' => $nb_task_opened,
                    'nbTaskWorking' => $nb_task_working,
                    'nbTaskWaiting' => $nb_task_waiting,
                    'nbTaskValidated' => $nb_task_validated,
                    'nbTaskRejected' => $nb_task_rejected,
                    'nbTaskArchived' => $nb_task_archived,
                ));
    }
    /**
     * Lists all documentProject entities.
     *
     */
    public function documentProjectAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentProjects = $em->getRepository('EBMGDPBundle:DocumentProject')->findAll();

        return $this->render('EBMGDPBundle:Insight:documentProject.html.twig', array(
            'listDocumentProjects' => $documentProjects,
        ));
    }

}
