<?php

namespace App\Repository;

use App\Entity\EmployeePlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmployeePlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeePlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeePlace[]    findAll()
 * @method EmployeePlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeePlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeePlace::class);
    }

    // /**
    //  * @return EmployeePlace[] Returns an array of EmployeePlace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmployeePlace
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
