<?php

namespace EBM\MaterielBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EBM\MaterielBundle\Entity\ReservationMachine;

class LoadReservationMachine implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /*
            $reservation = new ReservationMachine();

            $date = new \DateTime("now");
            $reservation->setDateCreation($date);

            $reservation->setDebut($date);
            $reservation->setFin($date);
            $reservation->setDescription('test');
            $reservation->setValidation(true);

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EBMMaterielBundle:Machine');


            $reservation->setMachine($repository->find());
            $manager->persist($reservation);


            $manager->flush();*/
    }
}