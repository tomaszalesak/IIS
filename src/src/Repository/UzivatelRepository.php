<?php

namespace App\Repository;

use App\Entity\Uzivatel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Uzivatel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uzivatel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uzivatel[]    findAll()
 * @method Uzivatel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UzivatelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uzivatel::class);
    }

    // /**
    //  * @return Uzivatel[] Returns an array of Uzivatel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Uzivatel
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
