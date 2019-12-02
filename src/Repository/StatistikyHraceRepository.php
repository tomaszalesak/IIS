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

    public function soucetStatistik($hrac)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.hrac = :hrac')
            ->setParameter('hrac', $hrac)
            ->select('SUM(s.dva_body) as dva_body, SUM(s.tri_body) as tri_body, SUM(s.fauly) as fauly, SUM(s.body) as body ')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function prumerStatistik($hrac)
    {
    return $this->createQueryBuilder('s')
        ->andWhere('s.hrac = :hrac')
        ->setParameter('hrac', $hrac)
        ->select('AVG(s.dva_body) as dva_body, AVG(s.tri_body) as tri_body, AVG(s.fauly) as fauly, AVG(s.body) as body ')
        ->getQuery()
        ->getOneOrNullResult()
        ;
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
