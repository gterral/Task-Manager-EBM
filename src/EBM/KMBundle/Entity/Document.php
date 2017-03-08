<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table(name="km_document")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\DocumentRepository")
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
     * @Assert\NotBlank(message="Formats de fichiers supportés : pdf, doc, docx, odt, txt, xls, xlsx, ods, jpg, jpeg,
     *                           png, gif, zip, rar, epub, avi, mov, mp4, mpg, mpeg, wmv")
     * @Assert\File(mimeTypes={"application/pdf",
     *                         "application/vnd.oasis.opendocument.text",
     *                         "application/msword",
     *                         "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
     *                         "text/plain",
     *                         "application/vnd.ms-excel",
     *                         "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *                         "application/vnd.oasis.opendocument.spreadsheet",
     *                         "image/jpeg",
     *                         "image/png",
     *                         "image/gif",
     *                         "application/epub+zip",
     *                         "application/x-rar-compressed",
     *                         "application/zip",
     *                         "video/mp4",
     *                         "video/quicktime",
     *                         "video/x-msvideo",
     *                         "video/x-ms-wmv",
     *                         "video/x-flv",
     *                         "video/webm",
     *                         "video/mpeg"})
     */
    private $file;

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
     * @param $file
     *
     * @return Document
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
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


}

