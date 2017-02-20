<?php

namespace Core\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Table(name="core_user")
 * @ORM\Entity(repositoryClass="Core\UserBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /* 
     * Attributs de l'utilisateur déjà compris avec FOSUserBundle
     * username
     * email
     * enabled (si inscription valide)
     * password
     * lastLogin
     * locked
     * expired
     */
    
    /**
    * @ORM\Column(name="fullname", type="string", length=55)
    * @Assert\Length(min=2, minMessage="Le nom complet doit au moins comprendre 2 caractères",max=30, maxMessage="Le nom complet ne peut excéder 50 caractères.")
    */
    private $fullname="";


    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=100)
     */
    private $timezone="Europe/Paris";

    /**
     * @ORM\ManyToMany(targetEntity="EBM\KMBundle\Entity\Post", inversedBy= "identifiedUsers", cascade= {"persist"})
     */
    private $postIdentified;

    /**
     * @ORM\OneToMany(targetEntity="EBM\KMBundle\Entity\Post", mappedBy= "writtenBy", cascade= {"persist"})
     */
    private $authorOf;

    /**
     * @ORM\ManyToMany(targetEntity="EBM\KMBundle\Entity\Post", inversedBy= "userVoter", cascade= {"persist"})
     */
    private $postVoted;



    
    
    /* qui des attributs locked & co hérités du FosUserBundle ?
     
    Enabled = true
    User is verified, that means user is email owner for sure. This can be verified by resseting password or clicking on confirmation email after registration.
    This flag should not be touched by admin or other user.
    If enabled = false DisabledException is thrown
    
    Locked = true
    User is forbbiden to manipulate his accout, because it is locked down. That means no password reset, login etc.
    This flag allows admin to ban user or don't let him register with his email again.
    LockedException is thrown.
    
    Expired = true
    User is archived by admin or after some time from last login (CRON service?).~~ When he logs again, revalidation is required.~~
    This flag allows admin to force user to revalidate himself, change his password or use it as an inactive users archive, which can't login.
    AccountExpiredException is thrown.
    
    CredentialsExpired = true
    This is checked after login and if true, user should be forced to change his password and revalidate himself.
    CredentialsExpiredException is thrown.

    Flags are checked in this order:
    1. Locked
    2. Enabled
    3. Expired
    4. CredentialsExpired
     */
    
    public function getHighestRole()
    {
        $rolesSortedByImportance = ['ROLE_ADMIN', 'ROLE_STUDENT'];
        foreach ($rolesSortedByImportance as $role)
        {
            if (in_array($role, $this->roles))
                return $role;
        }
        return "ROLE_USER";
    }
    

    public function __construct()
    {
        parent::__construct();
        // your own logic

        $this->postIdentified = new ArrayCollection();
        $this->authorOf = new ArrayCollection();
        $this->postVoted = new ArrayCollection();
    }
    
    public function hasRole($role) {
        if(in_array($role, $this->getRoles())) return true;
        return false;
    }

    public function getName()
    {
        return $this->getFullname() != null && strlen($this->getFullname()) > 0 ? $this->getFullname() : $this->getUsername();
    }

    /**
     * @param string $username
     * @return string
     */
    public function setUsername($username)
    {
        $this->username = utf8_encode($username);

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return utf8_decode($this->username);
    }
    
    /**
    * @param string $fullname
    */
    public function setFullname($fullname)
    {
        $this->fullname = utf8_encode($fullname);
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return utf8_decode($this->fullname);
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return User
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    function get_timezone_offset($remote_tz, $origin_tz = null) {
        if($origin_tz === null) {
            if(!is_string($origin_tz = date_default_timezone_get())) {
                return false; // A UTC timestamp was returned -- bail out!
            }
        }
        $origin_dtz = new \DateTimeZone($origin_tz);
        $remote_dtz = new \DateTimeZone($remote_tz);
        $origin_dt = new \DateTime("now", $origin_dtz);
        $remote_dt = new \DateTime("now", $remote_dtz);
        $offset = $remote_dtz->getOffset($remote_dt)-$origin_dtz->getOffset($origin_dt);
        // Exemple : pour paris, on obtiendra + 3600
        return floatval($offset);
    }

    public function getUserGMTSeconds()
    {
        return $this->getTimezone() != null && !empty($this->getTimezone()) ? $offset = $this->get_timezone_offset($this->getTimezone()) : 0;
    }

    public function getUserGMTHours()
    {
        return $this->getUserGMTSeconds()/3600;
    }

    /**
     * @return mixed
     */
    public function getPostIdentified()
    {
        return $this->postIdentified;
    }

    /**
     * @param mixed $postIdentified
     */
    public function setPostIdentified($postIdentified)
    {
        $this->postIdentified = $postIdentified;
    }

    /**
     * @return mixed
     */
    public function getAuthorOf()
    {
        return $this->authorOf;
    }

    /**
     * @param mixed $authorOf
     */
    public function setAuthorOf($authorOf)
    {
        $this->authorOf = $authorOf;
    }

    public function addauthorOf($authorOf)
    {
        $this->authorOf->add($authorOf);
    }

    public function removeauthorOf($authorOf)
    {
        $this->authorOf->removeElement($authorOf);
    }

    public function addpostVoted($postVoted)
    {
        $this->postVoted->add($postVoted);
    }

    public function removepostVoted($postVoted)
    {
        $this->postVoted->removeElement($postVoted);
    }
    /**
     * @return mixed
     */
    public function getPostVoted()
    {
        return $this->postVoted;
    }

    /**
     * @param mixed $postVoted
     */
    public function setPostVoted($postVoted)
    {
        $this->postVoted = $postVoted;
    }


}
