<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Trip;
use App\Form\CancelTripType;
use App\Form\CreateTripType;
use App\Form\FilterType;
use App\Model\FilterModel;
use App\Model\TripModel;
use App\Services\TripService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trips")
 */
class TripController extends AbstractController
{
    private TripService $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
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
        $model = new Trip();
        $form = $this->createForm(CreateTripType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //
            $newLocation = $form->get('locationType')->getData();
            $city = $form->get('city')->getData();
            $this->tripService->createTrip($model, $city, $newLocation);
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
    public function cancelTrip(Trip $trip, Request $request)
    {
        $form = $this->createForm(CancelTripType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->tripService->changeStatus($trip,Status::CANCELED);
        }
        return $this->render('trip/cancel_trip.html.twig', [
            'form' => $form->createView(),
            'trip' => $trip
        ]);

    }

    /**
     * @Route("/{trip}/edit", name="app_editTrip")
     */
    public function editTrip(Trip $trip, Request $request)
    {
        $form = $this->createForm(CreateTripType::class, $trip);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //
            $newLocation = $form->get('locationType')->getData();
            $city = $form->get('city')->getData();
            $this->tripService->createTrip($trip, $city, $newLocation);
        }
        return $this->render('trip/edit_trip.html.twig', [
            'form' => $form->createView(),
            'trip' => $trip
        ]);
    }

  /**
   * @Route("/{trip}/subscribe", name="app_subscribeTrip")
   */
  public function subscribeTrip(Trip $trip): Response
  {
    $contributor = $this->getUser();
    $this->tripService->subscribeTrip($trip, $contributor);
    $this->addFlash("success", "Vous êtes à présent inscrit!");
    return $this->redirectToRoute('app_showTrips');
  }

  /**
   * @Route("/{trip}/unsubscribe", name="app_unsubscribeTrip")
   */
  public function unsubscribeTrip(Trip $trip): Response
  {
    $contributor = $this->getUser();
    $this->tripService->unsubscribeTrip($trip, $contributor);
    $this->addFlash("success", "Vous êtes à présent désinscrit!");
    return $this->redirectToRoute('app_showTrips');
  }
}