<?php

namespace EBM\MaterielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeMateriel
 *
 * @ORM\Table(name="fablab_commande_materiel")
 * @ORM\Entity(repositoryClass="EBM\MaterielBundle\Repository\CommandeMaterielRepository")
 */
class CommandeMateriel
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
     * @ORM\Column(name="date_commande", type="datetime")
     */
    private $dateCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer")
     */
    private $statut;

    /**
     * @var float
     *
     * @ORM\Column(name="estimation_prix", type="float", nullable=true)
     */
    private $estimationPrix;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManytoOne(targetEntity="EBM\MaterielBundle\Entity\MaterielType", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiel_type;


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
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return CommandeMateriel
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CommandeMateriel
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
     * Set statut
     *
     * @param integer $statut
     *
     * @return CommandeMateriel
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set estimationPrix
     *
     * @param float $estimationPrix
     *
     * @return CommandeMateriel
     */
    public function setEstimationPrix($estimationPrix)
    {
        $this->estimationPrix = $estimationPrix;

        return $this;
    }

    /**
     * Get estimationPrix
     *
     * @return float
     */
    public function getEstimationPrix()
    {
        return $this->estimationPrix;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CommandeMateriel
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set materielType
     *
     * @param \EBM\MaterielBundle\Entity\MaterielType $materielType
     *
     * @return CommandeMateriel
     */
    public function setMaterielType(\EBM\MaterielBundle\Entity\MaterielType $materielType)
    {
        $this->materiel_type = $materielType;

        return $this;
    }

    /**
     * Get materielType
     *
     * @return \EBM\MaterielBundle\Entity\MaterielType
     */
    public function getMaterielType()
    {
        return $this->materiel_type;
    }
}
