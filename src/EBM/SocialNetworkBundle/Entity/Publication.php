<?php

namespace EBM\SocialNetworkBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EBM\KMBundle\Entity\Tag;

/**
 * Publication
 *
 * @ORM\Table(name="SocialNetworkPublication")
 * @ORM\Entity(repositoryClass="EBM\SocialNetworkBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="publications",cascade={"persist"})
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $userPublication;

    /**
     * @var int
     *
     * @ORM\Column(name="compteurLike", type="integer")
     */
    private $compteurLike = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="compteurComment", type="integer")
     */
    private $compteurComment = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="EBM\KMBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->date = new \Datetime();
        $this->themes = new ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Publication
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
     * Set content
     *
     * @param string $content
     *
     * @return Publication
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
     * Set compteurLike
     *
     * @param integer $compteurLike
     *
     * @return Publication
     */
    public function setCompteurLike($compteurLike)
    {
        $this->compteurLike = $compteurLike;

        return $this;
    }

    /**
     * Get compteurLike
     *
     * @return integer
     */
    public function getCompteurLike()
    {
        return $this->compteurLike;
    }

    /**
     * Set compteurComment
     *
     * @param integer $compteurComment
     *
     * @return Publication
     */
    public function setCompteurComment($compteurComment)
    {
        $this->compteurComment = $compteurComment;

        return $this;
    }

    /**
     * Get compteurComment
     *
     * @return integer
     */
    public function getCompteurComment()
    {
        return $this->compteurComment;
    }



    public function increaseComment()
    {
        $this->compteurComment++;
    }

    public function decreaseComment()
    {
        $this->compteurComment--;
    }

    public function increaseLike()
    {
        $this->compteurLike++;
    }

    public function decreaseLike()
    {
        $this->compteurLike--;
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
     * Add tag
     *
     * @param Tag $tag
     *
     * @return Publication
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Set userPublication
     *
     * @param \Core\UserBundle\Entity\User $userPubli
     *
     * @return Publication
     */
    public function setUserPublication(\Core\UserBundle\Entity\User $userPublication)
    {
        $this->userPublication = $userPublication;

        return $this;
    }

    /**
     * Get userPublication
     *
     * @return \Core\UserBundle\Entity\User
     */
    public function getUserPublication()
    {
        return $this->userPublication;
    }
}
