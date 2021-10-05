<?php

namespace App\Controller;

use App\Services\TripService;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trips", name="app_trips")
 */
class TripController
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
    public function addTrip()
    {
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