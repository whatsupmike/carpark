<?php

namespace App\Repository;

use App\Entity\Place;
use App\Entity\Zone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Place|null find($id, $lockMode = null, $lockVersion = null)
 * @method Place|null findOneBy(array $criteria, array $orderBy = null)
 * @method Place[]    findAll()
 * @method Place[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Place::class);
    }

    public function findFreePlaces(Zone $zone)
    {
        return $this->createQueryBuilder('p')
            ->where('p.zone=:zone')
            ->leftJoin('p.employeePlaces', 'employeePlaces')
            ->setParameter('zone', $zone)
            ->getQuery()
            ->getResult();
    }

    public function findPlaces(Zone $zone)
    {
        return $this->findBy(['zone'=>$zone]);
    }
}
