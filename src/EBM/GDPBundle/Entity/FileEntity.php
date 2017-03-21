<?php

namespace EBM\GDPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * File
 *
 * @ORM\Table(name="dev_gdp_fileentity")
 * @ORM\Entity(repositoryClass="EBM\GDPBundle\Repository\FileRepository")
 *
 * @Vich\Uploadable
 */
class FileEntity
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="gdp", fileNameProperty="fileName")
     *
     * @var File
     */
    private $File;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="fileName", type="string", length=255)
     */
    private $fileName;

    /**
     * @ORM\ManyToMany(targetEntity="EBM\GDPBundle\Entity\DocumentProject", inversedBy="fileEntities")
     * @ORM\JoinColumn(nullable=true)
     */
    private $documentProjects;

    /**
     * @return mixed
     */
    public function getDocumentProjects()
    {
        return $this->documentProjects;
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
     * @return File
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
    public function removeFile(\EBM\GDPBundle\Entity\DocumentProject $documentProject)
    {
        $this->documentProjects->removeElement($documentProject);
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return File
     */
    public function setFile(File $file = null)
    {
        $this->File = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->File;
    }

    /**
     * @param string $imageName
     *
     * @return File
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileName()
    {
        return $this->fileName;
    }
}

