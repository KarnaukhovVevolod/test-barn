<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 17:38
 */

namespace Application\Service;
use Doctrine\ORM\EntityManager;
use Application\Entity\Warehouses;

class WarehousesService
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
        $class = new Warehouses();

        $class->setNameWrehouse($data['name_wrehouse'])
            ->setQuarter($data['quarter'])
            ->setPositionRelativeO($data['position_relative_o'])
            ->setPositionRelativeA($data['position_relative_a'])
            ->setPositionRelativeB($data['position_relative_b'])
            ->setWarehouseAddress($data['warehouse_address'])
            ->setWarehouseDopinfo($data['warehouse_dopinfo'])
        ;
        $this->em->persist($class);
        $this->em->flush();
    }


    public function updateData(array $data)
    {
        $class = $this->em
            ->getRepository(Warehouses::class)
            ->find($data['id']);
        if ($class == null) {
            return null;
        }

        $class->setNameWrehouse($data['name_wrehouse'])
            ->setQuarter($data['quarter'])
            ->setPositionRelativeO($data['position_relative_o'])
            ->setPositionRelativeA($data['position_relative_a'])
            ->setPositionRelativeB($data['position_relative_b'])
            ->setWarehouseAddress($data['warehouse_address'])
            ->setWarehouseDopinfo($data['warehouse_dopinfo'])
        ;
        $this->em->persist($class);
        $this->em->flush();
    }

}