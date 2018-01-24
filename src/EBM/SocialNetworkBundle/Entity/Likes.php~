<?php

namespace EBM\SocialNetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="sn_likes")
 * @ORM\Entity(repositoryClass="EBM\SocialNetworkBundle\Repository\LikesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Likes
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
     * @ORM\ManyToOne(targetEntity="EBM\SocialNetworkBundle\Entity\Publication")
     * @ORM\JoinColumn(nullable=true)
     */
    private $publication;

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
     * Set publication
     *
     * @param \EBM\SocialNetworkBundle\Entity\Publication $publication
     *
     * @return Likes
     */
    public function setPublication(\EBM\SocialNetworkBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \EBM\SocialNetworkBundle\Entity\Publication
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
        $this->getPublication()->increaseLike();
    }

    /**
     * @ORM\PreRemove
     */
    public function decrease()
    {
        $this->getPublication()->decreaseLike();
    }
}
