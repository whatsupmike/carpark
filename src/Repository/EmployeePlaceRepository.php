<?php

namespace App\Repository;

use App\Entity\EmployeePlace;
use App\Entity\Zone;
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

    public function findAllForZone(Zone $zone)
    {
        return $this->createQueryBuilder('ep')
            ->join('ep.place', 'place')
            ->where('place.zone=:zone')
            ->setParameter('zone', $zone)
            ->getQuery()
            ->getResult();
    }
}
