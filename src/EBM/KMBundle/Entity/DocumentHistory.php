<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * DocumentHistory
 *
 * @ORM\Table(name="document_history")
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

    /**
     * @Orm\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @Orm\Column(type="datetime")
     */
    private $lastModifiedDate;


    /**
     * @ORM\OneToMany(targetEntity="EBM\KMBundle\Entity\EvaluationDocument", mappedBy= "document", cascade= {"persist"})
     */
    private $evaluations;

    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy= "createDocument", cascade= {"persist"})
     */
    private $author;

    /**
     * @Orm\OneToOne(targetEntity="EBM\KMBundle\Entity\Topic", inversedBy="document", cascade={"persist"})
     */
    private $commentTopic;

    /**
     * @Orm\ManyToMany(targetEntity="EBM\KMBundle\Entity\Tag", inversedBy="documents", cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->creationDate = new \DateTime();
        $this->lastModifiedDate = new DateTime();
        $this->tags = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
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



    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     *
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCommentTopic()
    {
        return $this->commentTopic;
    }

    /**
     * @param mixed $commentTopic
     */
    public function setCommentTopic($commentTopic)
    {
        $this->commentTopic = $commentTopic;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function addTag($tag){
        $this->tags->add($tag);
        return $this;
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag){
        $this->tags->removeElement($this);
    }

    /**
     * @return mixed
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * @param mixed $evaluations
     */
    public function setEvaluations($evaluations)
    {
        $this->evaluations = $evaluations;
    }

    /**
     * @param EvaluationDocument $evaluation
     * @return $this
     */
    public function addEvaluation(EvaluationDocument $evaluation){
        $this->evaluations->add($evaluation);
        return $this;
    }

    /**
     * @param EvaluationDocument $evaluation
     * @return $this
     */
    public function removeEvaluation(EvaluationDocument $evaluation){
        $this->evaluations->removeElement($evaluation);
        return $this;
    }

}

