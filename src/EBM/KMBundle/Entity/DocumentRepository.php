<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * DocumentRepository
 *
 * @ORM\Table(name="document_repository")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\DocumentRepositoryRepository")
 */
class DocumentRepository
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
     * @ORM\OneToMany(targetEntity="EBM\KMBundle\Entity\Document", mappedBy="repository")
     */
    private $documents;

    /**
     * @Orm\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @Orm\Column(type="datetime")
     */
    private $lastModifiedDate;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->creationDate = new \DateTime();
        $this->lastModifiedDate = new DateTime();
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
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param mixed $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }

    public function addDocument(Document $document){
        $this->documents->add($document);
        $this->lastModifiedDate = new DateTime();
    }

    public function removeDocument(Document $document)
    {
        $this->documents->removeElement($document);
        $this->lastModifiedDate = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getLastModifiedDate()
    {
        return $this->lastModifiedDate;
    }

    /**
     * @param mixed $lastModifiedDate
     */
    public function setLastModifiedDate($lastModifiedDate)
    {
        $this->lastModifiedDate = $lastModifiedDate;
    }

}

