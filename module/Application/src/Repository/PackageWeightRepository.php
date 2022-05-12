<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 15:40
 */

namespace Application\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\ClassMetadata;
use Application\Entity\PackageWeight;

class PackageWeightRepository extends EntityRepository
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
        $qb->select('w','t')
            ->from(PackageWeight::class,'w')
            ->leftJoin('w.idTransportCompany','t');

        $resultArray = $qb->getQuery()->getArrayResult();
        return $resultArray;
    }

    public function getWeight($data)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('w')
            ->from(PackageWeight::class,'w')

            ->add('where',$qb->expr()->andX(
                $qb->expr()->lte('w.weightFrom',$data['stock_weight']),
                $qb->expr()->gte('w.weightUpto',$data['stock_weight'])
                )
            )
            ->andWhere('w.standartCoefficient =?1')
            ->orderBy('w.price','ASC')
            ->setParameter(1,1)
            ;

        $resultArray = $qb->getQuery()->getArrayResult();
        return $resultArray;

    }
}