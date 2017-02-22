<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 22/02/2017
 * Time: 09:44
 */

namespace EBM\UserInterfaceBundle\Entity;


class Role
{

    /**
     * @var string
     */
    private $type;


    /**
     * @var string
     */
    private $role_type;

    /**
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var \DateTime
     */
    private $last_update;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getRoleType()
    {
        return $this->role_type;
    }

    /**
     * @param string $role_type
     */
    public function setRoleType($role_type)
    {
        $this->role_type = $role_type;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param \DateTime $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * @param \DateTime $last_update
     */
    public function setLastUpdate($last_update)
    {
        $this->last_update = $last_update;
    }



}