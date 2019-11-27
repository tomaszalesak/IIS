<?php

namespace App\Repository;

use App\Entity\Utkani;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Utkani|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utkani|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utkani[]    findAll()
 * @method Utkani[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtkaniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utkani::class);
    }

    // /**
    //  * @return Utkani[] Returns an array of Utkani objects
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
    public function findOneBySomeField($value): ?Utkani
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
