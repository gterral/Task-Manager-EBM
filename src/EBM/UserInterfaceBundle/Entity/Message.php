<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 22/02/2017
 * Time: 09:48
 */

namespace EBM\UserInterfaceBundle\Entity;


class Message
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $contenu;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}