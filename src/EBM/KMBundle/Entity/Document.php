<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Document
 *
 * @ORM\Table(name="km_document")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\DocumentRepository")
 *
 * @Vich\Uploadable
 */
class Document
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
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Vich\UploadableField(mapping="km", fileNameProperty="fileName")
     *
     * @var File
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedDate;

    /**
     * @Orm\OneToOne(targetEntity="EBM\KMBundle\Entity\Topic", inversedBy="document", cascade={"persist"})
     */
    private $commentTopic;

    /**
     * @Orm\ManyToMany(targetEntity="EBM\KMBundle\Entity\Tag", inversedBy="documents", cascade={"persist"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="EBM\KMBundle\Entity\EvaluationDocument", mappedBy= "document", cascade= {"persist"})
     */
    private $evaluations;

    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy= "createDocument", cascade= {"persist"})
     */
    private $author;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
        $this->date = new \DateTime();
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
     * @return Document
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
     * Set file
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Document
     */
    public function setFile($file)
    {
        $this->file = $file;

        if($file){
            $this->updatedDate = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * Get File|null
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Document
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Document
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Document
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param \DateTime $updatedDate
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }



}

