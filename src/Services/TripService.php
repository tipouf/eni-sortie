<?php


namespace App\Services;


use App\Entity\Trip;
use App\Repository\StatusRepository;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;

class TripService
{
    private TripRepository $tripRepository;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, TripRepository $tripRepository, StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
        $this->tripRepository = $tripRepository;
        $this->em = $em;
    }

    public function changeStatus(Trip $trip, string $status)
    {
        $status = $this->statusRepository->findOneBy(["label" => $status]);
        if (!$status)
            return;
        $trip->setStatus($status);
        $this->em->persist($trip);
        $this->em->flush();
    }
}