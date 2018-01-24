<?php

namespace EBM\KMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EBM\KMBundle\Entity\Enums\TagTypeEnum;

/**
 * Tag
 *
 * @ORM\Table(name="km_tag")
 * @ORM\Entity(repositoryClass="EBM\KMBundle\Repository\TagRepository")
 */
class Tag
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="EBM\KMBundle\Entity\Topic", inversedBy="tags", cascade={"persist"})
     * @ORM\JoinTable("topic_tags");
     */
    private $topics;

    /**
     * @Orm\ManyToMany(targetEntity="EBM\KMBundle\Entity\Document", mappedBy="tags", cascade={"persist"})
     */
    private $documents;

    /**
     * @Orm\OneToMany(targetEntity="CompetenceUser", mappedBy="tag" ,cascade={"persist"})
     */
    private $skills;

    /**
     * @Orm\ManyToMany(targetEntity="Core\UserBundle\Entity\User", inversedBy="managedTags", cascade={"persist"})
     */
    private $referents;

    public function __construct(){
        $this->topics = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->referents = new ArrayCollection();
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
     * @return Tag
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
     * Set description
     *
     * @param string $description
     *
     * @return Tag
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
     * Set type
     *
     * @param string $type
     *
     * @return Tag
     */
    public function setType($type)
    {
        if(!in_array($type, TagTypeEnum::getAvailableTypes())){
            throw new \InvalidArgumentException("Type invalide");
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @param mixed $topics
     */
    public function setTopics($topics)
    {
        $this->topics = $topics;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param mixed $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @return mixed
     */
    public function getReferents()
    {
        return $this->referents;
    }

    /**
     * @param mixed $referents
     */
    public function setReferents($referents)
    {
        $this->referents = $referents;
    }

    public function addReferent($referent){
        $this->addReferent($referent);
        return $this;
    }

    public function removeReferent($referent){
        $this->removeReferent($referent);
        return $this;
    }


}

