<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * DocumentHistory
 *
 * @ORM\Table(name="km_document_history")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\DocumentHistoryRepository")
 */
class DocumentHistory
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
     * @ORM\OneToMany(targetEntity="EBM\KMBundle\Entity\Document", mappedBy="history")
     */
    private $documents;


    public function __construct()
    {
        $this->documents = new ArrayCollection();
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
    }

    public function removeDocument(Document $document)
    {
        $this->documents->removeElement($document);
    }

}

