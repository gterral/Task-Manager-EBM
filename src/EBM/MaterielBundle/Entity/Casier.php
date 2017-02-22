<?php

namespace EBM\MaterielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Casier
 *
 * @ORM\Table(name="casier")
 * @ORM\Entity(repositoryClass="EBM\MaterielBundle\Repository\CasierRepository")
 */
class Casier
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

