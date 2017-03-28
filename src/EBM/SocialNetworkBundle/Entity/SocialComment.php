<?php

namespace EBM\SocialNetworkBundle\Entity;

use Core\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use EBM\SocialNetworkBundle\Entity\Publication;

/**
 * SocialComment
 *
 * @ORM\Table(name="sn_comment")
 * @ORM\Entity(repositoryClass="EBM\SocialNetworkBundle\Repository\SocialCommentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class SocialComment
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
     * @ORM\ManyToOne(targetEntity="EBM\SocialNetworkBundle\Entity\Publication")
     * @ORM\JoinColumn(nullable=true)
     */
    private $publication;

    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="SocialComments",cascade={"persist"})
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $userComment;

    public function __construct()
    {
        $this->date = new \Datetime();
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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
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
     * @return Comment
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
     * Set publication
     *
     * @param Publication $publication
     *
     * @return Comment
     */
    public function setPublication(Publication $publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * @ORM\PrePersist
    */
    public function increase()
    {
        $this->getPublication()->increaseComment();
    }

    /**
     * @ORM\PreRemove
     */
    public function decrease()
    {
        $this->getPublication()->decreaseComment();
    }


    /**
     * Set userComment
     *
     * @param User $userComment
     *
     * @return Comment
     */
    public function setUserComment(User $userComment = null)
    {
        $this->userComment = $userComment;

        return $this;
    }

    /**
     * Get userComment
     *
     * @return User
     */
    public function getUserComment()
    {
        return $this->userComment;
    }
}
