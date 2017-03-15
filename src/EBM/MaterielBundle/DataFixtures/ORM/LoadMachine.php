<?php

namespace EBM\MaterielBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EBM\MaterielBundle\Entity\Machine;
use EBM\MaterielBundle\Entity\ReservationMachine;

class LoadMachine implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'imprimante 3D',
            'Decoupe laser',
            'Guillotine',
            'Ordinateur',
            'Decoupe bois'
        );

        foreach ($names as $name)
        {

            $machine = new Machine();
            $machine->setNom($name);

            $manager->persist($machine);

/*
            $reservation = new ReservationMachine();

            $date = new \DateTime("now");
            $reservation->setDateCreation($date);

            $reservation->setDebut($date);
            $reservation->setFin($date);
            $reservation->setDescription('test');
            $reservation->setValidation(true);


            $reservation->setMachine($machine);
            $manager->persist($reservation);
*/
        }

        $manager->flush();
    }
}