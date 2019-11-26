<?php

namespace App\Repository;

use App\Entity\Turnaj;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Turnaj|null find($id, $lockMode = null, $lockVersion = null)
 * @method Turnaj|null findOneBy(array $criteria, array $orderBy = null)
 * @method Turnaj[]    findAll()
 * @method Turnaj[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurnajRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Turnaj::class);
    }

    // /**
    //  * @return Turnaj[] Returns an array of Turnaj objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Turnaj
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
