<?php

namespace EBM\GDPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * DocumentProject
 *
 * @ORM\Table(name="document_project")
 * @ORM\Entity(repositoryClass="EBM\GDPBundle\Repository\DocumentProjectRepository")
 */
class DocumentProject
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

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
     * @var \DateTime
     * @Gedmo\Timestampable(on="change", field={"status"})
     * @ORM\Column(name="statusChangeDate", type="datetime")
     */
    private $statusChangeDate;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\GDPBundle\Entity\DocumentTypeProject", inversedBy="documentProjects")
     *
     * @ORM\JoinColumn(nullable=false)
     */

    private $documentTypeProject;

    /**
     * @ORM\OneToOne(targetEntity="EBM\GDPBundle\Entity\Conversation", cascade={"persist","remove"})
     *
     */

    private $conversation;


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
     * @return DocumentProject
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
     * Set type
     *
     * @param string $type
     *
     * @return DocumentProject
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
     * Set status
     *
     * @param string $status
     *
     * @return DocumentProject
     */
    public function setStatus($status)
    {
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
     * Set modificationDate
     *
     * @param \DateTime $modificationDate
     *
     * @return DocumentProject
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

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return DocumentProject
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
     * Set documentTypeProject
     *
     * @param \EBM\GDPBundle\Entity\DocumentTypeProject $documentTypeProject
     *
     * @return DocumentProject
     */
    public function setDocumentTypeProject(\EBM\GDPBundle\Entity\DocumentTypeProject $documentTypeProject)
    {
        $this->documentTypeProject = $documentTypeProject;

        $documentTypeProject->addDocumentProject($this);

        return $this;
    }

    /**
     * Get documentTypeProject
     *
     * @return \EBM\GDPBundle\Entity\DocumentTypeProject
     */
    public function getDocumentTypeProject()
    {
        return $this->documentTypeProject;
    }

    /**
     * Set conversation
     *
     * @param \EBM\GDPBundle\Entity\Conversation $conversation
     *
     * @return DocumentProject
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
     * Set statusChangeDate
     *
     * @param \DateTime $statusChangeDate
     *
     * @return DocumentProject
     */
    public function setStatusChangeDate($statusChangeDate)
    {
        $this->statusChangeDate = $statusChangeDate;

        return $this;
    }

    /**
     * Get statusChangeDate
     *
     * @return \DateTime
     */
    public function getStatusChangeDate()
    {
        return $this->statusChangeDate;
    }
}
