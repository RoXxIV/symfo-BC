<?php

namespace App\Repository;

use App\Entity\Skateshop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Skateshop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skateshop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skateshop[]    findAll()
 * @method Skateshop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkateshopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skateshop::class);
    }

    // /**
    //  * @return Skateshop[] Returns an array of Skateshop objects
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
    public function findOneBySomeField($value): ?Skateshop
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
