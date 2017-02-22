<?php

namespace EBM\MaterielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="EBM\MaterielBundle\Repository\StockRepository")
 */
class Stock
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    /**
     * @ORM\OneToOne(targetEntity="EBM\MaterielBundle\Entity\MaterielType", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiel_type;


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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Stock
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set materielType
     *
     * @param \EBM\MaterielBundle\Entity\MaterielType $materielType
     *
     * @return Stock
     */
    public function setMaterielType(\EBM\MaterielBundle\Entity\MaterielType $materielType)
    {
        $this->materiel_type = $materielType;

        return $this;
    }

    /**
     * Get materielType
     *
     * @return \EBM\MaterielBundle\Entity\MaterielType
     */
    public function getMaterielType()
    {
        return $this->materiel_type;
    }
}
