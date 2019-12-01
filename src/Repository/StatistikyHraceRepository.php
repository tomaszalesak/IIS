<?php

namespace App\Repository;

use App\Entity\StatistikyHrace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StatistikyHrace|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatistikyHrace|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatistikyHrace[]    findAll()
 * @method StatistikyHrace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatistikyHraceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatistikyHrace::class);
    }

    // /**
    //  * @return StatistikyHrace[] Returns an array of StatistikyHrace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatistikyHrace
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
