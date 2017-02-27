<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaskController2 extends Controller
{
    public function indexAction()
    {
        return $this->render('EBMGDPBundle:Task:index.html.twig');
    }

    public function addAction(Request $request)
    {
        // On crée un objet Advert
        $task = new Task();

        // On crée le FormBuilder grâce au service form factory
        $form = $this->createForm(TaskType::class, $task);

        // Si la requête est en POST
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                // On enregistre notre objet $task dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($form);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Tâche bien enregistrée.');

                // On redirige vers la page de visualisation de la tâche nouvellement créée
                return $this->redirectToRoute('ebmgdp_task', array('id' => $form->getId()));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('EBMGDPBundle:Task:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
