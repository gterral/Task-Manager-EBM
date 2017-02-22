<?php

namespace EBM\KMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluationDocument
 *
 * @ORM\Table(name="evaluation_document")
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
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", cascade= {"persist"})
     */
    private $madeBy;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\KMBundle\Entity\Document", inversedBy= "linkedToEvaluation", cascade= {"persist"})
     */
    private $linkedToDocument;

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
    public function getMadeBy()
    {
        return $this->madeBy;
    }

    /**
     * @param mixed $madeBy
     */
    public function setMadeBy($madeBy)
    {
        $this->madeBy = $madeBy;
    }

    /**
     * @return mixed
     */
    public function getLinkedToDocument()
    {
        return $this->linkedToDocument;
    }

    /**
     * @param mixed $linkedToDocument
     */
    public function setLinkedToDocument($linkedToDocument)
    {
        $this->linkedToDocument = $linkedToDocument;
    }


}

