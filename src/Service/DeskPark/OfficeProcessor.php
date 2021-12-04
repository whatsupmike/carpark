<?php

declare(strict_types=1);

namespace App\Service\DeskPark;

use App\Dictionary\DaysDictionary;
use App\Dictionary\GridTileDictionary;
use App\Entity\EmployeePlace;
use App\Entity\Office;
use App\Entity\Place;
use App\Entity\StsEmployee;
use App\Entity\Zone;
use App\Repository\EmployeePlaceRepository;
use App\Repository\PlaceRepository;
use App\Repository\PlaceReservationRepository;

class OfficeProcessor
{
    public const DAYS_COUNT = 7;

    public function __construct(
        private EmployeePlaceRepository    $employeePlaceRepository,
        private PlaceReservationRepository $placeReservationRepository,
        private PlaceRepository $placeRepository
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
                'name' => $zone->getName(),
                'columns_count' => $zone->getColumnsCount(),
                'map' => $this->processGrid($zone, $user)
            ];
        }

        return $result;
    }

    private function processGrid(Zone $zone, StsEmployee $user): array
    {
        $grids=[];
        $date = (new \DateTime())->setTime(0, 0, 0);

        for($i = 0;$i < self::DAYS_COUNT; $i++) {
            $dateFormatted = $date->format('Y-m-d');
            $grids[] = [
                'date' => $dateFormatted,
                'day_name' => DaysDictionary::getLocalizedDayName((int) $date->format('w')),
                'map' => $this->getGridForDateAndUser($zone, $user, $date),
            ];

            $date->modify('+1 day');
        }

        return $grids;
    }

    private function getGridForDateAndUser(Zone $zone, StsEmployee $user, \DateTime $date): array
    {
        $freePlaces = $this->getFreePlaces($zone, $date);
        $grid = $zone->getGrid();
        foreach ($freePlaces as $place) {
            $xCoordinate = $place->getXCoordinate();
            $grid[$xCoordinate] = GridTileDictionary::setDeskFree($grid[$xCoordinate]);
        }

        return $grid;
    }

    /**
     * @return Place[]
     */
    private function getFreePlaces(Zone $zone, \DateTime $dateTime): array
    {
        $places = $this->placeRepository->findPlaces($zone);
        $placesOccupied = array_map(fn(EmployeePlace $ep)=> $ep->getPlace(), $this->employeePlaceRepository->findAllForZone($zone));

        foreach ($placesOccupied as $placeOccupied){
            foreach ($places as $key => $place) {
                if ($place->getId() === $placeOccupied->getId()) {
                    unset($places[$key]);
                    break;
                }
            }
        }

        $freePlacesReservation = $this->placeReservationRepository->findFreePlaces($zone, $dateTime);

        foreach ($freePlacesReservation as $freePlace){
            $places[] = $freePlace;
        }

        return array_values($places);
    }
}