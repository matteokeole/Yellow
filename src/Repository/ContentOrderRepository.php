<?php

namespace App\Repository;

use App\Entity\ContentOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContentOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContentOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContentOrder[]    findAll()
 * @method ContentOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContentOrder::class);
    }

    // /**
    //  * @return ContentOrder[] Returns an array of ContentOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContentOrder
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
