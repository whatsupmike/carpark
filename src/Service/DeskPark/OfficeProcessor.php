<?php

declare(strict_types=1);

namespace App\Service\DeskPark;

use App\Entity\Office;
use App\Entity\StsEmployee;
use App\Entity\Zone;
use App\Repository\EmployeePlaceRepository;
use App\Repository\PlaceReservationRepository;

class OfficeProcessor
{
    public const DAYS_COUNT = 7;

    public function __construct(
        private EmployeePlaceRepository    $employeePlaceRepository,
        private PlaceReservationRepository $placeReservationRepository
    ) {
    }

    public function process(Office $office, StsEmployee $user): array
    {
        $result = [
            'officeName' => $office->getName(),
            'zones' => [],
        ];

        foreach ($office->getZones() as $zone) {
            $result['zones'][] = [
                'id' => $zone->getId(),
                'columns_count' => $zone->getColumnsCount(),
                'map' => $zone->getGrid()
            ];
        }

        return $result;
    }

    private function processGrid(Zone $zone, StsEmployee $user): array
    {
        $grids=[];
        $date = (new \DateTime())->setTime(0, 0, 0);

        for($i = 0;$i < self::DAYS_COUNT; $i++) {
            $grids[$date->format('Y-m-d')] = $this->getGridForDateAndUser($zone, $user, $date);
            $date->modify('+1 day');
        }

        return $grids;
    }

    private function getGridForDateAndUser(Zone $zone, StsEmployee $user, \DateTime $date): array
    {
        $freePlaces =
        $grid = [];
        foreach ($zone->getPlaces() as $place) {
//            $place->
        }

        return $grid;
    }

    private function getFreePlaces(): array
    {

    }
}