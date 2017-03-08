<?php

namespace EBM\GDPBundle\Controller;

use EBM\GDPBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CalendarController extends Controller
{
    public function viewCalendarAction()
    {
        return $this->render('EBMGDPBundle:Default:index.html.twig');
    }
}
