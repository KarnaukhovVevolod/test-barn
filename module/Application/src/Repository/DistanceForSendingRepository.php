<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 13:41
 */

namespace Application\Repository;

use Application\Entity\DistanceForSending;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\ClassMetadata;

class DistanceForSendingRepository extends EntityRepository
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
        $qb->select('d','t')
            ->from(DistanceForSending::class,'d')
            ->leftJoin('d.idTransportCompany','t');

        $resultArray = $qb->getQuery()->getArrayResult();
        return $resultArray;
    }

    public function getDistance($data)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('d')
            ->from(DistanceForSending::class,'d')
            ->add('where',$qb->expr()->andX(
                $qb->expr()->lte('d.distanceFrom',$data),
                $qb->expr()->gte('d.distanceUpTo',$data)
                )
            )
            ->andWhere('d.standartCoefficient =?1')
            ->orderBy('d.price','ASC')
            ->setParameter(1,1)
        ;

        $resultArray = $qb->getQuery()->getArrayResult();
        return $resultArray;

    }


}