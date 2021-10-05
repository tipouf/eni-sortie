<?php

namespace App\Controller;

use App\Form\CreateTripType;
use App\Services\TripService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trips", name="app_trips")
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
    public function showTrips()
    {
    }

    /**
     * @Route("/add", name="app_addTrip")
     */
    public function addTrip(Request $request)
    {
        $form = $this->createForm(CreateTripType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
        $this->render('trip/new_trip.html.twig');
    }

    /**
     * @Route("/search", name="app_searchTrip")
     */
    public function searchTrip()
    {
    }

    /**
     * @Route("/show", name="app_showTrip")
     */
    public function showTrip()
    {
    }

    /**
     * @Route("/cancel", name="app_cancelTrip")
     */
    public function cancelTrip()
    {
    }

    /**
     * @Route("/edit", name="app_editTrip")
     */
    public function editTrip()
    {
    }

}