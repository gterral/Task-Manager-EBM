<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompetenceUser
 *
 * @ORM\Table(name="km_competence_user")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\CompetenceUserRepository")
 */
class CompetenceUser
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
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

    /**
     * @Orm\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="skills", cascade={"persist"})
     */
    private $user;

    /**
     * @Orm\ManyToOne(targetEntity="Tag", inversedBy="skills", cascade={"persist"})
     */
    private $tag;

    /**
     * @Orm\ManyToMany(targetEntity="Core\UserBundle\Entity\User", inversedBy="recommendSkill", cascade={"persist"})
     */
    private $recommendations;

    public function __construct()
    {
        $this->recommendations = new ArrayCollection();
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
     * Set validated
     *
     * @param boolean $validated
     *
     * @return CompetenceUser
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return bool
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * Set level
     *
     * @param string $level
     *
     * @return CompetenceUser
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return mixed
     */
    public function getRecommendations()
    {
        return $this->recommendations;
    }

    /**
     * @param mixed $recommendations
     */
    public function setRecommendations($recommendations)
    {
        $this->recommendations = $recommendations;
    }

    public function addRecommendation($user){
        $this->recommendations->add($user);
        return $this;
    }

    public function removeRecommendation($user){
        $this->recommendations->removeElement($user);
        return $this;
    }

}

