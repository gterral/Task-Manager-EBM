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


    public function __construct()
    {
        $this->dateAchat = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
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
     * Set tags
     *
     * @param \EBM\KMBundle\Entity\Tag $tags
     *
     * @return Machine
     */
    public function setTags(\EBM\KMBundle\Entity\Tag $tags = null)
    {
        return $this->tags = $tags;
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

}
