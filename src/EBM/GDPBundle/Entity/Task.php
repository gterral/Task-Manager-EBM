<?php

namespace EBM\GDPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EBM\UserInterfaceBundle\Entity\Project;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Task
 *
 * @ORM\Table(name="gdp_task")
 * @ORM\Entity(repositoryClass="EBM\GDPBundle\Repository\TaskRepository")
 */
class Task
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime", nullable=true)
     */
    private $deadline;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status = "OPENED";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="realisationDate", type="datetime", nullable=true)
     */
    private $realisationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="EBM\GDPBundle\Entity\Conversation", cascade={"persist","remove"})
     *
     */

    private $conversation;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modificationDate", type="datetime")
     */
    private $modificationDate;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\UserInterfaceBundle\Entity\Project", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function setProject(Project $project)
    {
        $this->project = $project;

        return $this;
    }

    public function getProject()
    {
        return $this->project;
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
     * Set name
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     *
     * @return Task
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Task
     */
    public function setStatus($status)
    {
        $states = ["OPENED","IN_PROGRESS","WAITING_FOR_REVIEW","VALIDATED","REJECTED","ARCHIVED"];

        if (!in_array($status,$states)) {
            throw new \Exception("Value not allowed : you must use one of these status : ".json_encode($states));
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set realisationDate
     *
     * @param \DateTime $realisationDate
     *
     * @return Task
     */
    public function setRealisationDate($realisationDate)
    {
        $this->realisationDate = $realisationDate;

        return $this;
    }

    /**
     * Get realisationDate
     *
     * @return \DateTime
     */
    public function getRealisationDate()
    {
        return $this->realisationDate;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Task
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Task
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set conversation
     *
     * @param \EBM\GDPBundle\Entity\Conversation $conversation
     *
     * @return Task
     */
    public function setConversation(\EBM\GDPBundle\Entity\Conversation $conversation = null)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return \EBM\GDPBundle\Entity\Conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set modificationDate
     *
     * @param \DateTime $modificationDate
     *
     * @return Task
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    /**
     * Get modificationDate
     *
     * @return \DateTime
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }
}
