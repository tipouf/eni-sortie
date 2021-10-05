<?php


namespace App\Services;


use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;

class TripService
{
    private TripRepository $tripRepository;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
        $this->em = $em;
    }
}