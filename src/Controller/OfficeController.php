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
use App\Repository\OfficeRepository;
use App\Repository\PlaceRepository;
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

#[Route(path: '/desk-park/office')]
class OfficeController extends AbstractController
{
    public const TECH_OFFICE_ID = 2;

    public function __construct(
        private CommandRequestHandler $commandRequestHandler,
        private OfficeRepository      $officeRepository,
        private OfficeProcessor $officeProcessor,
        private PlaceRepository $placeRepository,
        private StsEmployeeRepository $employeeRepository
    ) {
    }

    #[Route(path: '/map', methods: [Request::METHOD_GET])]
    public function map(Request $request): Response
    {
        $office = $this->officeRepository->find(self::TECH_OFFICE_ID) ?? throw new \Exception('invalid id');
        $user = $this->employeeRepository->find(1) ?? throw new \Exception('invalid id');
        return new JsonResponse($this->officeProcessor->process($office, $user));
    }

    #[Route(path: '/new', methods: [Request::METHOD_GET])]
    public function new(EntityManagerInterface $em): Response
    {
        $office = $this->officeRepository->find(self::TECH_OFFICE_ID);
//        $office = (new Office())->setName('TEch');
//        $em->persist($office);
//        $em->flush();
        $grid = [
            3, 4, 9, 3, 4, 9, 3, 4,
            3, 4, 9, 3, 4, 9, 3, 4,
            3, 4, 9, 3, 4, 9, 3, 4,
            9, 9, 9, 9, 9, 9, 9, 9,
            3, 4, 9, 3, 4, 9, 3, 4,
            3, 4, 9, 3, 4, 9, 3, 4,
            3, 4, 9, 3, 4, 9, 3, 4,
        ];
        $zone = (new Zone())->setName('Parter')->setOffice($office)->setColumnsCount(8)->setRowsCount(7)->setGrid($grid);
//        $em->persist($zone);
//        $em->flush();

        return new Response('ok');
    }

    #[Route(path: '/places', methods: [Request::METHOD_GET])]
    public function places(EntityManagerInterface $em, ZoneRepository $zoneRepository): Response
    {
        $zone = $zoneRepository->find(1) ?? throw new \Exception('xd');

        $grid = $zone->getGrid();

        foreach ($grid as $key => $gridSpot) {
            if (in_array($gridSpot, GridTileDictionary::getDesks())) {
                $place = (new Place())->setZone($zone)->setXCoordinate($key)->setYCoordinate(0);
                $em->persist($place);
            }
        }
        $em->flush();

        return new Response('ok');
    }

    #[Route(path: '/employee', methods: [Request::METHOD_GET])]
    public function employee(EntityManagerInterface $em): Response
    {
        $em->persist((new StsEmployee())->setEmail('michal.bialas-drzewiecki@sts.pl'));
        $em->flush();

        return new Response('ok');
    }

    #[Route(path: '/employee-place', methods: [Request::METHOD_GET])]
    public function employeePlace(EntityManagerInterface $em): Response
    {
        $place = $this->placeRepository->find(13);
        $employee = $this->employeeRepository->find(1);
        $em->persist((new EmployeePlace())->setPlace($place)->setEmployee($employee));
        $em->flush();

        return new Response('ok');
    }

    #[Route(path: '/employee-place-reservation', methods: [Request::METHOD_GET])]
    public function employeePlaceReservation(EntityManagerInterface $em): Response
    {
        $place = $this->placeRepository->find(13);
        $employee = $this->employeeRepository->find(1);
        $em->persist((new PlaceReservation())->setPlace($place)->setEmployee(null)->setDate((new \DateTime())->modify('+3 day')));
        $em->flush();

        return new Response('ok');
    }
}
