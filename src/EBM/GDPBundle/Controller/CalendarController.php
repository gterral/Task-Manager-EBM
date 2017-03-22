<?php

namespace EBM\GDPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CalendarController extends Controller
{
    public function viewCalendarAction()
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        // $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        return $this->render('EBMGDPBundle:Default:index.html.twig');
    }
}
