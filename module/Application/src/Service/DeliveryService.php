<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 11.05.2022
 * Time: 11:29
 */

namespace Application\Service;


use Application\Entity\DistanceForSending;
use Application\Entity\PackageWeight;
use Application\Entity\TransportCompany;
use Application\Entity\Warehouses;
use Doctrine\ORM\EntityManager;

class DeliveryService
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getDelivery(array $data, $param= 'fast')
    {
        $distance = $this->getDistanceBetweenWarehouse($data);
        if (isset($distance['error'])) {
            if ($param == 'fast') {
                $distance["price"] = '';
                $distance["period"] = '';
            } else {
                $distance['coefficient'] = '';
                $distance['date'] = '';
            }
            return $distance;
        }
        $day_delivery = $this->getDayDelivery($data, $param);
        if (isset($day_delivery['error'])) {
            if ($param == 'fast') {
                $day_delivery["price"] = '';
                $day_delivery["period"] = '';
            } else {
                $day_delivery['coefficient'] = '';
                $day_delivery['date'] = '';
            }
            return $day_delivery;
        }

        $all_cost  = $this->getCostByDistanceByWeight($data, $distance, $param);
        if ($param == 'fast') {
            $price = $all_cost[0][0]['price']+$all_cost[1][0]['price'];
            $data_result['price'] = $price;
            $data_result['period'] = $day_delivery['success'];
            $data_result['error'] = '';
        } else {
            $coefficient = 1+$all_cost[0][0]['coefficient']+$all_cost[1][0]['coefficient'];
            $data_result['coefficient'] = $coefficient;
            $date = date("d-m-Y", time()+3600*24*($day_delivery['success']));
            $data_result['date'] = $date;
            $data_result['error'] = '';
        }
        return $data_result;
    }

    public function getCostByDistanceByWeight($data, $distance, $param)
    {
        $weight = $this->em->getRepository(PackageWeight::class)
            ->getWeight($data);
        $distanceCost =  $this->em->getRepository(DistanceForSending::class)
            ->getDistance($distance['success']);
        return [$weight, $distanceCost];
    }
    public function getDayDelivery($data, string $param)
    {
        $company = $this->em->getRepository(TransportCompany::class)
            ->find($data['company']);
        $all_cars = (int)$company->getTotalNumberCars();
        $average_cars = (int)$company->getAverageNumberCar();
        $fast_delivery = (int)$company->getCurrentOrdersFastDelivery();
        $regular_delivery = (int)$company->getCurrentOrderRegularDelivery();
        $dop_faster_order_in_day = (int)$company->getDopNumberFastDeliveryInDay();

        $all_orders = $fast_delivery + $regular_delivery;
        $perfomance_in_day_orders = $all_cars * $average_cars;
        $perfomance_all_orders_day = ceil($all_orders/$perfomance_in_day_orders);

        if ($perfomance_all_orders_day == ($all_orders/$perfomance_in_day_orders) ) {
            $perfomance_all_orders_day++;
        }

        if ($param == 'fast') {
            $perfomance_all_fast_day = ceil($fast_delivery/$dop_faster_order_in_day);
            if ( $perfomance_all_fast_day > $perfomance_all_orders_day ) {
                return ['success' => $perfomance_all_orders_day];
            } else {
                return ['success' => $perfomance_all_fast_day];
            }
        } else {
            $perfomance_all_regular_day = $regular_delivery/
                ($perfomance_in_day_orders-$dop_faster_order_in_day);
            $perfomance_all_regular_day = ceil($perfomance_all_regular_day);
            $rest_orders = $perfomance_all_orders_day*$perfomance_in_day_orders
            - $all_orders;
            if ($rest_orders < $dop_faster_order_in_day) {
                $perfomance_all_orders_day++;
            }
            if ($perfomance_all_regular_day > $perfomance_all_orders_day) {
                return ['success' => $perfomance_all_regular_day];
            } else {
                return ['success'=>$perfomance_all_orders_day];
            }
        }
        return['error'=>'что-то пошло не так'];
    }



    public function getDistanceBetweenWarehouse($data)
    {
        /**
         * @var Warehouses
         */
        $warehouse_1 = $this->em->getRepository(Warehouses::class)
            ->find($data['stock_1']);
        /**
         * @var Warehouses
         */
        $warehouse_2 = $this->em->getRepository(Warehouses::class)
            ->find($data['stock_2']);
        $base_OA = 10;// расстояние между точками О А км
        $base_OB = 10;// расстояние между точками О B км
        $base_simple = 10;
        $distance_O_1 = (float)$warehouse_1->getPositionRelativeO();
        $distance_A_B_1 = ((float)$warehouse_1->getPositionRelativeA() >
            (float)$warehouse_1->getPositionRelativeB()) ? (float)$warehouse_1->getPositionRelativeA():
            (float)$warehouse_1->getPositionRelativeB();
        $distance_O_2 = (float)$warehouse_2->getPositionRelativeO();
        $distance_A_B_2 = ((float)$warehouse_2->getPositionRelativeA() >
            (float)$warehouse_2->getPositionRelativeB()) ? (float)$warehouse_2->getPositionRelativeA():
            (float)$warehouse_2->getPositionRelativeB();
        $quarter_1 = (int) $warehouse_1->getQuarter();
        $quarter_2 = (int) $warehouse_2->getQuarter();
        $alpha_need = 0;
        $alpha_1 = 0;
        $alpha_2 = 0;

        $alpha_1_cos = (pow($distance_O_1,2) +
                pow($base_simple,2) -
                pow($distance_A_B_1,2)
            )/(2*$distance_O_1*$base_simple);

        $alpha_1 = acos($alpha_1_cos)/pi()*180;

        $alpha_2_cos = (pow($distance_O_2,2) +
                pow($base_simple,2) -
                pow($distance_A_B_2,2)
            )/(2*$distance_O_2*$base_simple);
        $alpha_2 = acos($alpha_2_cos)/pi()*180;
        if($alpha_1_cos > 1 || $alpha_2_cos > 1){
            return ['error' => 'неверно заданы параметры для расположения склада'];
        }
        if( $quarter_1 > $quarter_2 ) {
            $quarter = $quarter_2;
            $quarter_2 = $quarter_1;
            $quarter_1 = $quarter;
        }
        if ($quarter_1 == $quarter_2) {
            if ($alpha_1 > $alpha_2) {
                $alpha_need = $alpha_1 - $alpha_2;
            } else {
                $alpha_need = $alpha_2 - $alpha_1;
            }
        } elseif(
            ($quarter_1 == 1 && $quarter_2 == 2) ||
            ($quarter_1 == 3 && $quarter_2 == 4)
        ){
            $alpha_need = 180 - $alpha_1 - $alpha_2;
        }elseif(
            ($quarter_1 == 1 && $quarter_2 == 3) ||
            ($quarter_1 == 2 && $quarter_2 == 4)
        ) {
            $alpha_need = 180 - $alpha_1 + $alpha_2;
        }elseif(
            ($quarter_1 == 1 && $quarter_2 == 4) ||
            ($quarter_1 == 2 && $quarter_2 == 3)
        ) {
            $alpha_need = $alpha_1 + $alpha_2;
        }
        if ($alpha_need > 180) {
            $alpha_need = 360 - $alpha_need;
        }

        $distance_need = pow($distance_O_1,2) + pow($distance_O_2, 2)
            - (2*$distance_O_1*$distance_O_2*cos($alpha_need*pi()/180));
        $distance_need = pow($distance_need,0.5);
        return ['success'=>$distance_need];
    }

}