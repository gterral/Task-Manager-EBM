<?php

namespace EBM\GDPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentTypeProject
 *
 * @ORM\Table(name="document_type_project")
 * @ORM\Entity(repositoryClass="EBM\GDPBundle\Repository\DocumentTypeProjectRepository")
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
}
