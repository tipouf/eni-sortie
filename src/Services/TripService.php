<?php


namespace App\Services;


use App\Entity\Status;
use App\Entity\Trip;
use App\Repository\StatusRepository;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;

class TripService
{
    private TripRepository $tripRepository;
    private EntityManagerInterface $em;
    private StatusRepository $statusRepository;

    public function __construct(EntityManagerInterface $em, TripRepository $tripRepository, StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
        $this->tripRepository = $tripRepository;
        $this->em = $em;
    }

    public function createTrip($data)
    {
        if (is_string($data["status"]))
            $data["status"] = $this->statusRepository->findOneBy(["label" => $data["status"]]);
        $trip = new Trip();
        $trip->setName($data["name"]);
        $trip->setStatus($data["status"]);
        $trip->setPromoter($data["campus"]);
        $trip->setLocation($data["location"]);
        $trip->setDuration($data["duration"]);
        $trip->setDescription($data["description"]);
        $trip->setStartedAt($data["startedAt"]);
        $trip->setRegistrationLimit($data["registrationLimit"]);
        $trip->setRegistrationNumber(0);

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

    public function getTripsByStatus(Status $status): array
    {
        return $this->tripRepository->findBy(["status" => $status]);
    }

    public function getTripsByStatusName(string $status)
    {
        return $this->tripRepository->findByStatusName($status);
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