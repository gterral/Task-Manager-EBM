<?php

namespace EBM\KMBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="km_post")
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
     * @Orm\JoinTable(name="km_users_identified_in_post")
     */
    private $identifiedUsers;

    /**
     * @ORM\OneToMany(targetEntity="Vote", mappedBy= "post", cascade= {"persist"})
     */
    private $votes;

    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="authorOf")
     */
    private $author;

    public function __construct()
    {
        $this->identifiedUsers = new ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->userVoter = new ArrayCollection();
        $this->date = new \DateTime();
        $this->status = "default";
    }


    /**
     * @ORM\ManyToOne(targetEntity="EBM\KMBundle\Entity\Topic", inversedBy="posts", cascade={"persist"})
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
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }

    /**
     * @param $vote
     * @return $this
     */
    public function addVote($vote){
        $this->votes->add($vote);
        return $this;
    }

    /**
     * @param $vote
     * @return $this
     */
    public function removeVote($vote)
    {
        $this->votes->removeElement($vote);
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
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getDownVotes()
    {
        $votes = $this->votes ;
        $nDowns = 0;
        foreach ($votes as $vote) {
            if ($vote->getValue() == -1){
                $nDowns++;
            }
        }
    return $nDowns;
    }

    public function getUpVotes()
    {
        $votes = $this->votes ;
        $nUps = 0;
        foreach ($votes as $vote) {
            if ($vote->getValue() == 1){
                $nUps++;
            }
        }
        return $nUps;
    }


}

