<?php

namespace App\Repository;

use App\Entity\PlaceQueue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaceQueue|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceQueue|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceQueue[]    findAll()
 * @method PlaceQueue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceQueueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceQueue::class);
    }

    // /**
    //  * @return PlaceQueue[] Returns an array of PlaceQueue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlaceQueue
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
