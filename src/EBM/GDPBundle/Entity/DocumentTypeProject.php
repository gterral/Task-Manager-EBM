<?php

namespace EBM\GDPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * DocumentTypeProject
 *
 * @ORM\Table(name="gdp_document_type_project")
 * @ORM\Entity(repositoryClass="EBM\GDPBundle\Repository\DocumentTypeProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class DocumentTypeProject
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
     * @ORM\OneToMany(targetEntity="EBM\GDPBundle\Entity\DocumentProject", mappedBy="documentTypeProject")
     *
     */

    private $documentProjects;


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
     * @return DocumentTypeProject
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
     * Constructor
     */
    public function __construct()
    {
        $this->documentProjects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add documentProject
     *
     * @param \EBM\GDPBundle\Entity\DocumentProject $documentProject
     *
     * @return DocumentTypeProject
     */
    public function addDocumentProject(\EBM\GDPBundle\Entity\DocumentProject $documentProject)
    {
        $this->documentProjects[] = $documentProject;

        return $this;
    }

    /**
     * Remove documentProject
     *
     * @param \EBM\GDPBundle\Entity\DocumentProject $documentProject
     */
    public function removeDocumentProject(\EBM\GDPBundle\Entity\DocumentProject $documentProject)
    {
        $this->documentProjects->removeElement($documentProject);
    }

    /**
     * Get documentProjects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocumentProjects()
    {
        return $this->documentProjects;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return DocumentTypeProject
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
     * Set modificationDate
     *
     * @param \DateTime $modificationDate
     *
     * @return DocumentTypeProject
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
