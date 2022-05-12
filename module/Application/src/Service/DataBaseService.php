<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 12:47
 */

namespace Application\Service;


use Application\Entity\DistanceForSending;
use Application\Entity\PackageWeight;
use Application\Entity\TransportCompany;
use Application\Entity\Warehouses;
use Application\Repository\DistanceForSendingRepository;
use Doctrine\ORM\EntityManager;

class DataBaseService
{
    /**
     * @var EntityManager
     */
    protected  $em;
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function addData(array $data, string $param)
    {
        $data_result = null;
        $class = null;
        switch ($param) {
            case 'distance':
                $class = new DistanceForSendingService($this->em);
                //$data_result = $class->addData($data);
                break;
            case 'package':
                $class = new PackageWeightService($this->em);
                break;
            case 'transport':
                $class = new TransportCompanyService($this->em);
                break;
            case 'warehouse':
                $class = new WarehousesService($this->em);
                break;
        }
        $data_result = $class->addData($data);
        return $data_result;
    }

    public function updateData(array $data, string $param)
    {
        $data_result = null;
        $class = null;
        switch ($param) {
            case 'distance':
                $class = new DistanceForSendingService($this->em);
                break;
            case 'package':
                $class = new PackageWeightService($this->em);
                break;
            case 'transport':
                $class = new TransportCompanyService($this->em);
                break;
            case 'warehouse':
                $class = new WarehousesService($this->em);
                break;
        }
        $data_result = $class->updateData($data);
        return $data_result;
    }


    public function getData(string $param)
    {

        $data_result = null;
        $class = '';
        switch ($param) {
            case 'distance':
                $class = $this->em->getRepository(DistanceForSending::class);
                break;
            case 'package':
                $class = $this->em->getRepository(PackageWeight::class);
                break;
            case 'transport':
                $class = $this->em->getRepository(TransportCompany::class);
                break;
            case 'warehouse':
                $class = $this->em->getRepository(Warehouses::class);
                break;
        }
        $data_result = $class->findAllArray();
        return $data_result;
    }
}