<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 16:12
 */

namespace Application\Service;
use Doctrine\ORM\EntityManager;
use Application\Entity\TransportCompany;

class TransportCompanyService
{
    /**
     * @var EntityManager
     */
    private $em;
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function addData(array $data)
    {
        $class = new TransportCompany();
        $data['company_total_cars'] = (int) $data['company_total_cars'];
        $data['average_number_car'] = (int) $data['average_number_car'];
        $data['current_orders_fast_delivery'] = (int) $data['current_orders_fast_delivery'];
        $data['current_order_regular_delivery'] = (int) $data['current_order_regular_delivery'];
        $class->setNameCompany($data['name_company'])
            ->setTotalNumberCars($data['company_total_cars'])
            ->setAverageNumberCar($data['average_number_car'])
            ->setCurrentOrdersFastDelivery($data['current_orders_fast_delivery'])
            ->setCurrentOrderRegularDelivery($data['current_order_regular_delivery'])
            ->setDopInfoCompany($data['dop_info_company'])
            ->setDopNumberFastDeliveryInDay($data['dop_number_fast_delivery_in_day'])
        ;
        $this->em->persist($class);
        $this->em->flush();
    }


    public function updateData(array $data)
    {
        $class = $this->em
            ->getRepository(TransportCompany::class)
            ->find($data['id']);
        if ($class == null) {
            return null;
        }

        $data['company_total_cars'] = (int) $data['company_total_cars'];
        $data['average_number_car'] = (int) $data['average_number_car'];
        $data['current_orders_fast_delivery'] = (int) $data['current_orders_fast_delivery'];
        $data['current_order_regular_delivery'] = (int) $data['current_order_regular_delivery'];
        $class->setNameCompany($data['name_company'])
            ->setTotalNumberCars($data['company_total_cars'])
            ->setAverageNumberCar($data['average_number_car'])
            ->setCurrentOrdersFastDelivery($data['current_orders_fast_delivery'])
            ->setCurrentOrderRegularDelivery($data['current_order_regular_delivery'])
            ->setDopInfoCompany($data['dop_info_company'])
            ->setDopNumberFastDeliveryInDay($data['dop_number_fast_delivery_in_day'])
        ;
        $this->em->persist($class);
        $this->em->flush();
    }
}