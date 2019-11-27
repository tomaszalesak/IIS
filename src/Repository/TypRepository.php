<?php

namespace App\Repository;

use App\Entity\Typ;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Typ|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typ|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typ[]    findAll()
 * @method Typ[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typ::class);
    }

    // /**
    //  * @return Typ[] Returns an array of Typ objects
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
    public function findOneBySomeField($value): ?Typ
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
