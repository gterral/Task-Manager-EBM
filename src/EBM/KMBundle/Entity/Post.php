<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

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
    private $status;

    /**

     * @ORM\ManyToMany(targetEntity="Core\UserBundle\Entity\User", inversedBy= "postIdentified", cascade= {"persist"})
     */
    private $identifiedUsers;


    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy= "authorOf", cascade= {"persist"})
     */
    private $writtenBy;

    /**
     * @ORM\ManyToMany(targetEntity="Core\UserBundle\Entity\User", inversedBy= "$postVoted", cascade= {"persist"})
     */
    private $userVoter;


    public function __construct()
    {
        $this->identifiedUsers = new ArrayCollection();
        $this->userVoter = new ArrayCollection();

    }


    /**
     * @ORM\ManyToOne(targetEntity="EBM\KMBundle\Entity\Topic", cascade={"persist"})
     */
    private $topic;


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
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
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
     * @return Post
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
     * @return mixed
     */

    public function getIdentifiedUsers()
    {
        return $this->identifiedUsers;
    }

    /**
     * @param mixed $identifiedUsers
     */
    public function setIdentifiedUsers($identifiedUsers)
    {
        $this->identifiedUsers = $identifiedUsers;
    }

    public function addIdentifiedUser($identifiedUser)
{
    $this->identifiedUsers->add($identifiedUser);
}

    public function removeIdentifiedUser($identifiedUser)
    {
        $this->identifiedUsers->removeElement($identifiedUser);
    }

    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return mixed
     */
    public function getWrittenBy()
    {
        return $this->writtenBy;
    }

    /**
     * @param mixed $writtenBy
     */
    public function setWrittenBy($writtenBy)
    {
        $this->writtenBy = $writtenBy;
    }

    /**
     * @return mixed
     */
    public function getUserVoter()
    {
        return $this->userVoter;
    }

    /**
     * @param mixed $userVoter
     */
    public function setUserVoter($userVoter)
    {
        $this->userVoter = $userVoter;
    }





}

