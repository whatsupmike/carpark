<?php

namespace App\Repository;

use App\Entity\PlaceReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaceReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceReservation[]    findAll()
 * @method PlaceReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceReservation::class);
    }

    // /**
    //  * @return PlaceReservation[] Returns an array of PlaceReservation objects
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
    public function findOneBySomeField($value): ?PlaceReservation
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
