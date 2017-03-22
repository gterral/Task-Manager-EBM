<?php

namespace EBM\KMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluationDocument
 *
 * @ORM\Table(name="km_evaluation_document")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\EvaluationDocumentRepository")
 */
class EvaluationDocument
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
     * @var int
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="documentEvaluations", cascade= {"persist"})
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\KMBundle\Entity\DocumentHistory", inversedBy= "evaluations", cascade= {"persist"})
     */
    private $document;

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
     * Set value
     *
     * @param integer $value
     *
     * @return EvaluationDocument
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param mixed $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
    }


}

