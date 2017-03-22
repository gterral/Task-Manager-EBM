<?php

namespace EBM\GDPBundle\Controller;

use EBM\UserInterfaceBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class CalendarController extends Controller
{

    //Cf MachineController
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("project",options={"mapping": {"code":"code"}})
     */
    public function viewCalendarAction(Project $project)
    {
        // Check whether the user has access to project or not. If not, this method will throw a 404 exception.
        $this->get("ebmgdp.utilities.permissions")->isGrantedAccessForProject($project,$this->getUser());

        $machineId = '1';
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("EBMMaterielBundle:Machine");
        $machine = $repository->find($machineId);

        $reservations = $this->getAllReservationsByMachineId($machineId);

        $jsonEvents = '[';

        foreach($reservations as $reservation)
        {
            $json = json_encode(array(
                'id' => $reservation->getId(),
                'title' => $reservation->getUser()->getUsername(),
                'start' => str_replace(' ', 'T', $reservation->getDebut()->format('Y-m-d H:i:s')),
                'end' => str_replace(' ', 'T', $reservation->getFin()->format('Y-m-d H:i:s')),
                'backgroundColor' => '#e53935'
            ));

            $jsonEvents = $jsonEvents.$json;

            if($reservation !== end($reservations))
                $jsonEvents = $jsonEvents.',';
        }

        $jsonEvents = $jsonEvents.']';


        return $this
            ->render('EBMGDPBundle:Project:planning.html.twig',
                array(
                    'machine' => $this->getMachine($machineId),
                    'events' => $reservations,
                    'jsonEvents' => $jsonEvents,
                    'machines' => $this->getAllMachines(),
                    'project'=> $project
                )
            );
    }

    public function getAllReservationsByMachineId($machineId)
    {
        $repositoryReservation = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:ReservationMachine');

        return $repositoryReservation->findBy(array('machine' => $this->getMachine($machineId)));
    }

    public function getMachine($machineId)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:Machine');

        return $repository->find($machineId);
    }

    public function getAllMachines()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:Machine');

        return $repository->findAll();
    }
}
