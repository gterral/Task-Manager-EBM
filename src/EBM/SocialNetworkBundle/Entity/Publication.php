<?php

namespace EBM\SocialNetworkBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToMany(targetEntity="EBM\SocialNetworkBundle\Entity\Theme", cascade={"persist"})
     */
    private $themes;

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

    /**
     * Add theme
     *
     * @param \EBM\SocialNetworkBundle\Entity\Theme $theme
     *
     * @return Publication
     */
    public function addTheme(\EBM\SocialNetworkBundle\Entity\Theme $theme)
    {
        $this->themes[] = $theme;

        return $this;
    }

    /**
     * Remove theme
     *
     * @param \EBM\SocialNetworkBundle\Entity\Theme $theme
     */
    public function removeTheme(\EBM\SocialNetworkBundle\Entity\Theme $theme)
    {
        $this->themes->removeElement($theme);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThemes()
    {
        return $this->themes;
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
}
