<?php

namespace App\Repository;

use App\Entity\Place;
use App\Entity\PlaceReservation;
use App\Entity\Zone;
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

    public function findFreePlaces(Zone $zone, \DateTime $dateTime)
    {
        $results = $this->createQueryBuilder('pr')
            ->where('pr.place IN (:places)')
            ->andWhere('pr.employee IS NULL')
            ->setParameter('places', array_map(fn(Place $place) => $place->getId(), $zone->getPlaces()->toArray() ))
            ->getQuery()
            ->getResult();

        /**
         * @var $result PlaceReservation
         */
        foreach ($results as $key => $result) {
            if ($result->getDate()->format('Y-m-d') !== $dateTime->format('Y-m-d')){
                unset($results[$key]);
            }
        }

        return array_values(array_map(fn(PlaceReservation $reservation) => $reservation->getPlace(), $results));
    }
}
