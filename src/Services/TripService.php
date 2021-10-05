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

    public function createTrip()
    {
        $trip = new Trip();
        $trip->setName();
        $trip->setStatus();
        $trip->setPromoter();
        $trip->setLocation();
        $trip->setDuration();
        $trip->setDescription();
        $trip->setStartedAt();
        $trip->setPromoterContributor();
        $trip->setRegistrationLimit();
        $trip->setRegistrationNumber();

        $this->em->persist($trip);
        $this->em->flush();
    }

    public function addTrip(Trip $trip)
    {
        $this->em->persist($trip);
        $this->em->flush();
    }

    public function getTripsByDate(\DateTime $dateTime): array
    {
        return $this->tripRepository->findBy(["startedAt" => $dateTime]);
    }

    public function getAllTrips(): array
    {
        return $this->tripRepository->findAll();
    }

    public function getTripsByStatus()
    {

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