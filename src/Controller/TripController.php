<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Trip;
use App\Form\CancelTripType;
use App\Form\CreateTripType;

use App\Model\TripModel;
use App\Services\TripService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/trips")
 */
class TripController extends AbstractController
{
    private TripService $tripService;
    private EntityManagerInterface $manager;
    private TripRepository $tripRepository;

    public function __construct(TripService $tripService, EntityManagerInterface $manager, TripRepository $tripRepository)
    {
        $this->tripService = $tripService;
        $this->manager = $manager;
        $this->tripRepository = $tripRepository;
    }

    /**
     * @Route("/", name="app_showTrips")
     */
    public function showTrips(Request $request)
    {
        $model = new FilterModel();
        $trips = $this->tripService->getAllTrips();
        $form = $this->createForm(FilterType::class, $model);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trips = $this->tripService->getByFilters($model);
        }

        return $this->render('trip/trips_list.html.twig', [
            'trips' => $trips,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/add", name="app_addTrip")
     */
    public function addTrip(Request $request)
    {
        $model = new TripModel();
        $form = $this->createForm(CreateTripType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->tripService->createTrip($model);

            return $this->redirectToRoute('app_home');
        }
        return $this->render('trip/new_trip.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/search", name="app_searchTrip")
     */
    public function searchTrip()
    {
    }



    /**
     * @Route("/{trip}", name="app_showTrip", methods={"GET"})
     */
    public function showTrip(Trip $trip): Response
    {
        return $this->render('trip/show_trip.html.twig', [
            'trip' => $trip,
        ]);
    }

    /**
     * @Route("/{trip}/cancel", name="app_cancelTrip")
     */
    public function cancelTrip(Request $request, Trip $trip): Response
    {
        $form = $this->createForm(CancelTripType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $motif = $form->get("motif")->getData();
            $this->tripService->changeStatus($trip, Status::CANCELED);
        }

        return $this->render('trip/cancel_trip.html.twig', [
            'trip' => $trip,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{trip}/edit", name="app_editTrip")
     */
    public function editTrip(Trip $trip, Request $request)
    {
        $model = new TripModel();
        $form = $this->createForm(CreateTripType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->tripService->createTrip($model, $trip);
        }
        return $this->render('trip/edit_trip.html.twig', [
            'form' => $form->createView(),
            'trip' => $trip
        ]);
    }
}