<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 15:01
 */

namespace Application\Service;
use Application\Entity\PackageWeight;
use Doctrine\ORM\EntityManager;
use Application\Entity\TransportCompany;

class PackageWeightService
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
        $class = new PackageWeight();
        $data['weight_from'] = (float) $data['weight_from'];
        $data['weight_up_to'] = (float) $data['weight_up_to'];
        $data['weight_coefficient'] = (float) $data['weight_coefficient'];
        $data['weight_select'] = (int) $data['weight_select'];
        $class->setWeightFrom($data['weight_from'])
            ->setWeightUpTo($data['weight_up_to'])
            ->setCoefficient($data['weight_coefficient'])
            ->setDopParam($data['weight_dop_param']);
        $class->setPrice($data['weight_price']);
        if ($data['weight_select'] ===  0) {
            $class->setStandartCoefficient(1);
        }
        else {
            $transport = $this->em->getRepository(TransportCompany::class)
                ->find($data['weight_select']);
            $class->setStandartCoefficient(0)
                ->addTransportCompany($transport);
        }
        $this->em->persist($class);
        $this->em->flush();
    }


    public function updateData(array $data)
    {
        $class = $this->em
            ->getRepository(PackageWeight::class)
            ->find($data['id']);
        if ($class == null) {
            return null;
        }

        $data['weight_from'] = (float) $data['weight_from'];
        $data['weight_up_to'] = (float) $data['weight_up_to'];
        $data['weight_coefficient'] = (float) $data['weight_coefficient'];
        $data['weight_select'] = (int) $data['weight_select'];
        $class->setWeightFrom($data['weight_from'])
            ->setWeightUpTo($data['weight_up_to'])
            ->setCoefficient($data['weight_coefficient'])
            ->setDopParam($data['weight_dop_param']);
        $class->setPrice($data['weight_price']);
        if ($data['weight_select'] ===  0) {
            $class->setStandartCoefficient(1);
        }
        else {
            $transport = $this->em->getRepository(TransportCompany::class)
                ->find($data['weight_select']);
            $class->setStandartCoefficient(0)
                ->addTransportCompany($transport);
        }
        $this->em->persist($class);
        $this->em->flush();
    }
}