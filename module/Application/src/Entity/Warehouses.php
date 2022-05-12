<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Repository\WarehousesRepository;

/**
 * Warehouses
 *
 * @ORM\Table(name="warehouses")
 * @ORM\Entity(repositoryClass="\Application\Repository\WarehousesRepository")
 */
class Warehouses
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name_wrehouse", type="string", length=250, nullable=false)
     */
    private $nameWrehouse;

    /**
     * @var int
     *
     * @ORM\Column(name="quarter", type="integer", nullable=false)
     */
    private $quarter;

    /**
     * @var float
     *
     * @ORM\Column(name="position_relative_o", type="float", precision=10, scale=0, nullable=false)
     */
    private $positionRelativeO;

    /**
     * @var float|null
     *
     * @ORM\Column(name="position_relative_a", type="float", precision=10, scale=0, nullable=true)
     */
    private $positionRelativeA;

    /**
     * @var float|null
     *
     * @ORM\Column(name="position_relative_b", type="float", precision=10, scale=0, nullable=true)
     */
    private $positionRelativeB;

    /**
     * @var string|null
     *
     * @ORM\Column(name="warehouse_address", type="string", length=250, nullable=true)
     */
    private $warehouseAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="warehouse_dopinfo", type="string", length=250, nullable=true)
     */
    private $warehouseDopinfo;

    public function getId()
    {
        return $this->id;
    }
    public function getNameWrehouse()
    {
        return $this->nameWrehouse;
    }
    public function setNameWrehouse($nameWrehouse)
    {
        $this->nameWrehouse = $nameWrehouse;
        return $this;
    }
    public function getQuarter()
    {
        return $this->quarter;
    }
    public function setQuarter($quarter)
    {
        $this->quarter = $quarter;
        return $this;
    }
    public function getPositionRelativeO()
    {
        return $this->positionRelativeO;
    }
    public function setPositionRelativeO($positionRelativeO)
    {
        $this->positionRelativeO = $positionRelativeO;
        return $this;
    }

    public function getPositionRelativeA()
    {
        return $this->positionRelativeA;
    }
    public function setPositionRelativeA($positionRelativeA)
    {
        $this->positionRelativeA = $positionRelativeA;
        return $this;
    }
    public function getPositionRelativeB()
    {
        return $this->positionRelativeB;
    }
    public function setPositionRelativeB($positionRelativeB)
    {
        $this->positionRelativeB = $positionRelativeB;
        return $this;
    }
    public function getWarehouseAddress()
    {
        return $this->warehouseAddress;
    }
    public function setWarehouseAddress($warehouseAddress)
    {
        $this->warehouseAddress = $warehouseAddress;
        return $this;
    }
    public function getWarehouseDopinfo()
    {
        return $this->warehouseDopinfo;
    }
    public function setWarehouseDopinfo($warehouseDopinfo)
    {
        $this->warehouseDopinfo = $warehouseDopinfo;
        return $this;
    }



}
