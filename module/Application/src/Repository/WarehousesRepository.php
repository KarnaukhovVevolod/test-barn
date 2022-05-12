<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 17:32
 */

namespace Application\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\ClassMetadata;
use Application\Entity\Warehouses;


class WarehousesRepository extends EntityRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->em = $this->getEntityManager();
    }

    public function findAllArray()
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('w')
            ->from(Warehouses::class, 'w')
        ;

        $resultArray = $qb->getQuery()->getArrayResult();
        return $resultArray;
    }


}