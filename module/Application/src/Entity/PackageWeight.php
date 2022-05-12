<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Application\Repository\PackageWeightRepository;
/**
 * PackageWeight
 *
 * @ORM\Table(name="package_weight", indexes={@ORM\Index(name="id_transport_company", columns={"id_transport_company"})})
 * @ORM\Entity(repositoryClass="\Application\Repository\PackageWeightRepository")
 */
class PackageWeight
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
     * @var float
     *
     * @ORM\Column(name="weight_from", type="float", precision=10, scale=0, nullable=false)
     */
    private $weightFrom;

    /**
     * @var float
     *
     * @ORM\Column(name="weight_upto", type="float", precision=10, scale=0, nullable=false)
     */
    private $weightUpto;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var float|null
     *
     * @ORM\Column(name="coefficient", type="float", precision=10, scale=0, nullable=true)
     */
    private $coefficient;

    /**
     * @var int|null
     *
     * @ORM\Column(name="standart_coefficient", type="integer", nullable=true)
     */
    private $standartCoefficient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dop_param", type="string", length=250, nullable=true)
     */
    private $dopParam;

    /**
     * @var \Application\Entity\TransportCompany
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TransportCompany")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_transport_company", referencedColumnName="id")
     * })
     */
    private $idTransportCompany;

    public function __construct()
    {
        //$this->idTransportCompany = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getWeightFrom()
    {
        return $this->weightFrom;
    }
    public function setWeightFrom($weightFrom)
    {
        $this->weightFrom = $weightFrom;
        return $this;
    }
    public function getWeightUpto()
    {
        return $this->weightUpto;
    }
    public function setWeightUpto($weightUpto)
    {
        $this->weightUpto = $weightUpto;
        return $this;
    }
    public function getCoefficient()
    {
        return $this->coefficient;
    }
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
        return $this;
    }
    public function getDopParam()
    {
        return $this->dopParam;
    }
    public function setDopParam($dopParam)
    {
        $this->dopParam = $dopParam;
        return $this;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
        return $price;
    }
    public function getStandartCoefficient()
    {
        return $this->standartCoefficient;
    }
    public function setStandartCoefficient($standartCoefficient)
    {
        return $this->standartCoefficient = $standartCoefficient;
    }
    public function getTransportCompany()
    {
        return $this->idTransportCompany;
    }
    public function addTransportCompany($idTransportCompany)
    {
        $this->idTransportCompany = $idTransportCompany;
        return $this;
    }

}
