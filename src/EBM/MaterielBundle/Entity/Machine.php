<?php

namespace EBM\MaterielBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EBM\KMBundle\Entity\CompetenceUser;

/**
 * Machine
 *
 * @ORM\Table(name="fablab_machine")
 * @ORM\Entity(repositoryClass="EBM\MaterielBundle\Repository\MachineRepository")
 */
class Machine
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
     * @ORM\Column(name="date_achat", type="datetime", nullable=true)
     */
    private $dateAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    /**
     * @ORM\ManyToOne(targetEntity="EBM\KMBundle\Entity\Tag", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="fablab_machine_competence")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\MaterielBundle\Entity\MachineType", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="fablab_machine_machine_type")
     */

    private $type;

    public function __construct()
    {
        $this->dateAchat = new \DateTime();
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
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     *
     * @return Machine
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    /**
     * Get dateAchat
     *
     * @return \DateTime
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Machine
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set competences
     *
     * @param \EBM\KMBundle\Entity\CompetenceUser $competences
     *
     * @return Machine
     */
    public function setCompetences(\EBM\KMBundle\Entity\CompetenceUser $competences = null)
    {
        $this->competences = $competences;

        return $this;
    }

    /**
     * Get competences
     *
     * @return \EBM\KMBundle\Entity\CompetenceUser
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Set tags
     *
     * @param \EBM\KMBundle\Entity\Tag $tags
     *
     * @return Machine
     */
    public function setTags(\EBM\KMBundle\Entity\Tag $tags = null)
    {
        $this->tags = $tags;
    }

    /**
     *
     * Set type
     *
     * @param \EBM\MaterielBundle\Entity\MachineType $type
     *
     * @return Machine
     */
    public function setType(\EBM\MaterielBundle\Entity\MachineType $type = null
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get tags
     *
     * @return \EBM\KMBundle\Entity\Tag
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get type
     *
     * @return \EBM\MaterielBundle\Entity\MachineType
     */
    public function getType()
    {
        return $this->type;
    }
}
