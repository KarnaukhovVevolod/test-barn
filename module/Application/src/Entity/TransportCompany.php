<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Repository\TransportCompanyRepository;
/**
 * TransportCompany
 *
 * @ORM\Table(name="transport_company")
 * @ORM\Entity(repositoryClass="\Application\Repository\TransportCompanyRepository")
 */
class TransportCompany
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
     * @ORM\Column(name="name_company", type="string", length=250, nullable=false)
     */
    private $nameCompany;

    /**
     * @var int
     *
     * @ORM\Column(name="total_number_cars", type="integer", nullable=false)
     */
    private $totalNumberCars;

    /**
     * @var int
     *
     * @ORM\Column(name="average_number_car", type="integer", nullable=false)
     */
    private $averageNumberCar;

    /**
     * @var int
     *
     * @ORM\Column(name="current_orders_fast_delivery", type="integer", nullable=false)
     */
    private $currentOrdersFastDelivery;

    /**
     * @var int
     *
     * @ORM\Column(name="current_order_regular_delivery", type="integer", nullable=false)
     */
    private $currentOrderRegularDelivery;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dop_info_company", type="string", length=250, nullable=true)
     */
    private $dopInfoCompany;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dop_number_fast_delivery_in_day", type="integer", nullable=true)
     */
    private $dopNumberFastDeliveryInDay;

    public function getId()
    {
        return $this->id;
    }
    public function getNameCompany()
    {
        return $this->nameCompany;
    }
    public function setNameCompany($nameCompany)
    {
        $this->nameCompany = $nameCompany;
        return $this;
    }
    public function getTotalNumberCars()
    {
        return $this->totalNumberCars;
    }
    public function setTotalNumberCars($totalNumberCars)
    {
        $this->totalNumberCars = $totalNumberCars;
        return $this;
    }
    public function getAverageNumberCar()
    {
        return $this->averageNumberCar;
    }
    public function setAverageNumberCar($averageNumberCar)
    {
        $this->averageNumberCar = $averageNumberCar;
        return $this;
    }
    public function getCurrentOrdersFastDelivery()
    {
        return $this->currentOrdersFastDelivery;
    }
    public function setCurrentOrdersFastDelivery($currentOrdersFastDelivery)
    {
        $this->currentOrdersFastDelivery = $currentOrdersFastDelivery;
        return $this;
    }
    public function getCurrentOrderRegularDelivery()
    {
        return $this->currentOrderRegularDelivery;
    }
    public function setCurrentOrderRegularDelivery($currentOrderRegularDelivery)
    {
        $this->currentOrderRegularDelivery = $currentOrderRegularDelivery;
        return $this;
    }
    public function getDopInfoCompany()
    {
        return $this->dopInfoCompany;
    }
    public function setDopInfoCompany($dopInfoCompany)
    {
        $this->dopInfoCompany = $dopInfoCompany;
        return $this;
    }

    public function getDopNumberFastDeliveryInDay()
    {
        return $this->dopNumberFastDeliveryInDay;
    }

    public function setDopNumberFastDeliveryInDay($dopNumberFastDeliveryInDay)
    {
        $this->dopNumberFastDeliveryInDay = $dopNumberFastDeliveryInDay;
        return $this;
    }


}
