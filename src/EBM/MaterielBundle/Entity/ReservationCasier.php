<?php

namespace EBM\MaterielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationCasier
 *
 * @ORM\Table(name="fablab_reservation_casier")
 * @ORM\Entity(repositoryClass="EBM\MaterielBundle\Repository\ReservationCasierRepository")
 */
class ReservationCasier
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
     * @ORM\Column(name="date_debut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\MaterielBundle\Entity\Casier", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $casier;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return ReservationCasier
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return ReservationCasier
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set casier
     *
     * @param \EBM\MaterielBundle\Entity\Casier $casier
     *
     * @return ReservationCasier
     */
    public function setCasier(\EBM\MaterielBundle\Entity\Casier $casier)
    {
        $this->casier = $casier;

        return $this;
    }

    /**
     * Get casier
     *
     * @return \EBM\MaterielBundle\Entity\Casier
     */
    public function getCasier()
    {
        return $this->casier;
    }
}
