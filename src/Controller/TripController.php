<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trips", name="app_trips")
 */
class TripController
{
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