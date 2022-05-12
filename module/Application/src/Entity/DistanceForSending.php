<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Repository\DistanceForSendingRepository;

/**
 * DistanceForSending
 *
 * @ORM\Table(name="distance_for_sending", indexes={@ORM\Index(name="id_transport_company", columns={"id_transport_company"})})
 * @ORM\Entity(repositoryClass="\Application\Repository\DistanceForSendingRepository")
 */
class DistanceForSending
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
     * @ORM\Column(name="distance_from", type="float", precision=10, scale=0, nullable=false)
     */
    private $distanceFrom;

    /**
     * @var float
     *
     * @ORM\Column(name="distance_up_to", type="float", precision=10, scale=0, nullable=false)
     */
    private $distanceUpTo;

    /**
     * @var float|null
     *
     * @ORM\Column(name="coefficient", type="float", precision=10, scale=0, nullable=true)
     */
    private $coefficient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dop_param", type="string", length=250, nullable=true)
     */
    private $dopParam;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var int|null
     *
     * @ORM\Column(name="standart_coefficient", type="integer", nullable=true)
     */
    private $standartCoefficient;

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
    public function getDistanceFrom()
    {
        return $this->distanceFrom;
    }
    public function setDistanceFrom($distanceFrom)
    {
        $this->distanceFrom = $distanceFrom;
        return $this;
    }

    public function getDistanceUpTo()
    {
        return $this->distanceUpTo;
    }
    public  function setDistanceUpTo($distanceUpTo)
    {
        $this->distanceUpTo = $distanceUpTo;
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
        $this->standartCoefficient = $standartCoefficient;
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
