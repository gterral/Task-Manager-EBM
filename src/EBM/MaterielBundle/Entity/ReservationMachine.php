<?php

namespace EBM\MaterielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\UserBundle\Entity\User;

/**
 * ReservationMachine
 *
 * @ORM\Table(name="fablab_reservation_machine")
 * @ORM\Entity(repositoryClass="EBM\MaterielBundle\Repository\ReservationMachineRepository")
 */
class ReservationMachine
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime")
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="validation", type="boolean")
     */
    private $validation;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\MaterielBundle\Entity\Machine", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $machine;

    /**
 * @var User $myUser
 * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", cascade={"persist"})
 * @ORM\JoinColumn(nullable=false)
 */
    private $user;


    public function __construct()
    {
        $this->dateCreation = new \DateTime('now');
        $this->validation = false;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return ReservationMachine
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return ReservationMachine
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return ReservationMachine
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ReservationMachine
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set validation
     *
     * @param boolean $validation
     *
     * @return ReservationMachine
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return bool
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set machine
     *
     * @param \EBM\MaterielBundle\Entity\Machine $machine
     *
     * @return ReservationMachine
     */
    public function setMachine(\EBM\MaterielBundle\Entity\Machine $machine)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return \EBM\MaterielBundle\Entity\Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }


    /**
     * Set user
     *
     * @param \Core\UserBundle\Entity\User $user
     *
     * @return ReservationMachine
     */
    public function setUser(\Core\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Core\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
