<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="km_topic")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\TopicRepository")
 */
class Topic
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status = "default";

    /**
     * @var bool
     *
     * @ORM\Column(name="pinned", type="boolean")
     */
    private $pinned = false;

    /**
     * @var int
     *
     * @ORM\Column(name="nbViews", type="integer")
     */
    private $nbViews = 0;

    /**
     * @ORM\OneToMany(targetEntity="EBM\KMBundle\Entity\Post", mappedBy="topic", cascade={"persist"})
     */
    private $posts;

    /**
     * @Orm\ManyToMany(targetEntity="EBM\KMBundle\Entity\Tag", mappedBy="topics", cascade={"persist"})
     */
    private $tags;

    /**
     * @ORM\OneToOne(targetEntity="EBM\KMBundle\Entity\DocumentHistory", mappedBy="commentTopic", cascade={"persist"})
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User")
     */
    private $creator;

    /**
     * @Orm\Column(type="text")
     */
    private $description;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Topic
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
     * Set status
     *
     * @param string $status
     *
     * @return Topic
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set pinned
     *
     * @param boolean $pinned
     *
     * @return Topic
     */
    public function setPinned($pinned)
    {
        $this->pinned = $pinned;

        return $this;
    }

    /**
     * Get pinned
     *
     * @return bool
     */
    public function getPinned()
    {
        return $this->pinned;
    }

    /**
     * Set nbViews
     *
     * @return Topic
     */
    public function increaseNbViews()
    {
        $this->nbViews ++;
        return $this;
    }

    /**
     * Get nbViews
     *
     * @return int
     */
    public function getNbViews()
    {
        return $this->nbViews;
    }

    /**
     * @return ArrayCollection<Post>
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function addPost(Post $post){
        $this->posts->add($post);

        $post->setTopic($this); //Association avec le topic

        return $this;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function removePost(Post $post){
        $this->posts->removeElement($post);
        return $this;
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

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag){
        $this->tags->add($tag);
        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function removeTag(Tag $tag){
        $this->tags->removeElement($tag);
        return $this;
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

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}

