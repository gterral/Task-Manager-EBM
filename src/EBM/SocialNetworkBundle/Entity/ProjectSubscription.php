<?php

namespace EBM\SocialNetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectSubscription
 *
 * @ORM\Table(name="SocialNetworkProjectSubscription")
 * @ORM\Entity(repositoryClass="EBM\SocialNetworkBundle\Repository\ProjectSubscriptionRepository")
 */
class ProjectSubscription
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
     * @ORM\ManyToOne(targetEntity="EBM\CoreUserBundle\Entity\User", inversedBy="projectSubscriptions",cascade={"persist"})
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private $userProject;


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
     * @return ProjectSubscription
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
}

