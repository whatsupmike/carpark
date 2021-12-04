<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dictionary\GridTileDictionary;
use App\Entity\EmployeePlace;
use App\Entity\Office;
use App\Entity\Place;
use App\Entity\PlaceReservation;
use App\Entity\StsEmployee;
use App\Entity\Zone;
use App\Repository\EmployeePlaceRepository;
use App\Repository\OfficeRepository;
use App\Repository\PlaceRepository;
use App\Repository\PlaceReservationRepository;
use App\Repository\StsEmployeeRepository;
use App\Repository\ZoneRepository;
use App\Service\CommandRequestHandler;
use App\Service\DeskPark\OfficeProcessor;
use App\Service\InteractionRequestHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/desk-park/webhook')]
class WebhookController extends AbstractController
{
    public const TECH_OFFICE_ID = 2;

    public function __construct(
        private CommandRequestHandler $commandRequestHandler,
        private OfficeRepository      $officeRepository,
        private OfficeProcessor $officeProcessor,
        private PlaceRepository $placeRepository,
        private StsEmployeeRepository $employeeRepository,
        private EmployeePlaceRepository $employeePlaceRepository,
        private PlaceReservationRepository $placeReservationRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route(path: '/add', methods: [Request::METHOD_POST])]
    public function add(Request $request): Response
    {
        $email = $request->request->get('employee');
        $dateFrom = new \DateTime($request->request->get('date_start'));
        $dateTo = new \DateTime($request->request->get('date_end'));

        $employee = $this->employeeRepository->findBy(['email'=> $email]);
        /**
         * @var $placeAssigned EmployeePlace
         */
        $placeAssigned = $this->employeePlaceRepository->findBy(['employee' => $employee]) ?? throw  new \Exception('elo');
        if ($placeAssigned) {
            $placesOccupied = $this->placeReservationRepository->findReservationForPlaceAndDateRange($placeAssigned->getPlace(), $dateFrom, $dateTo);
            $datesOccupied = array_map(fn(PlaceReservation $place) => array_map(fn($date) => $date->format('Y-m-d'), $place->getDate()), $placesOccupied);

            $date = $dateFrom;
            while ($date <= $dateTo) {
                if (!in_array($date->format('Y-m-d'), $datesOccupied)) {
                    $placeRelease = (new PlaceReservation())->setPlace($placeAssigned->getPlace())->setDate($date);
                    $this->entityManager->persist($placeRelease);
                }
                $date->modify('+1 day');
            }
            $this->entityManager->flush();
        }

        return new Response('ok');
    }
}
