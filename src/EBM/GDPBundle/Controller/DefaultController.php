<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $task = new Task();
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);



        $em->flush();

        return $this->render('EBMGDPBundle:Default:index.html.twig');
    }
}
