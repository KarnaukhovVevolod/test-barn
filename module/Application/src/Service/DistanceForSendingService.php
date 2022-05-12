<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 12:07
 */

namespace Application\Service;

use Application\Entity\DistanceForSending;
use Application\Entity\TransportCompany;
use Doctrine\ORM\EntityManager;

class DistanceForSendingService
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
        $distance = new DistanceForSending();
        $data['distance_from'] = (float) $data['distance_from'];
        $data['distance_up_to'] = (float) $data['distance_up_to'];
        $data['distance_coefficient'] = (float) $data['distance_coefficient'];
        $data['distance_select'] = (int) $data['distance_select'];
        $distance->setDistanceFrom($data['distance_from'])
            ->setDistanceUpTo($data['distance_up_to'])
            ->setCoefficient($data['distance_coefficient'])
            ->setDopParam($data['distance_dop_param']);
        $distance->setPrice($data['distance_price']);
        if ($data['distance_select'] ===  0) {
            $distance->setStandartCoefficient(1);
        }
        else {
            $transport =$this->em->getRepository(TransportCompany::class)
                ->find($data['distance_select']);
            $distance->setStandartCoefficient(0)
                ->addTransportCompany($transport);
        }
        $this->em->persist($distance);
        $this->em->flush();
    }


    public function updateData(array $data)
    {
        $distance = $this->em
            ->getRepository(DistanceForSending::class)
            ->find($data['id']);
        if ($distance == null) {
            return null;
        }

        $data['distance_from'] = (float) $data['distance_from'];
        $data['distance_up_to'] = (float) $data['distance_up_to'];
        $data['distance_coefficient'] = (float) $data['distance_coefficient'];
        $data['distance_select'] = (int) $data['distance_select'];
        $distance->setDistanceFrom($data['distance_from'])
            ->setDistanceUpTo($data['distance_up_to'])
            ->setCoefficient($data['distance_coefficient'])
            ->setDopParam($data['distance_dop_param']);
        $distance->setPrice($data['distance_price']);
        if ($data['distance_select'] ===  0) {
            $distance->setStandartCoefficient(1);
        }
        else {
            $transport =$this->em->getRepository(TransportCompany::class)
                ->find($data['distance_select']);
            $distance->setStandartCoefficient(0)
                ->addTransportCompany($transport);
        }
        $this->em->persist($distance);
        $this->em->flush();
    }
}