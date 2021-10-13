<?php

namespace App\DataFixtures;

use App\Entity\Contributor;
use App\Entity\Status;
use App\Entity\Trip;
use App\Repository\CampusRepository;
use App\Repository\ContributorRepository;
use App\Repository\LocationRepository;
use App\Repository\StatusRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TripFixtures extends Fixture
{
    private CampusRepository $campusRepository;
    private ContributorRepository $contributorRepository;
    private StatusRepository $statusRepository;
    private LocationRepository $locationRepository;

    public function __construct(LocationRepository $locationRepository, CampusRepository $campusRepository, ContributorRepository $contributorRepository, StatusRepository $statusRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->campusRepository = $campusRepository;
        $this->contributorRepository = $contributorRepository;
        $this->statusRepository = $statusRepository;
    }

    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        //new DateTime("%")
        $this->createTrip(50, "1ere Sortie", new DateTime('2021-01-01'), 10, new DateTime('2021-01-02'), Status::CREATED, $manager);
        $this->createTrip(60, "2eme Sortie", new DateTime('2021-01-03'), 10, new DateTime('2021-01-04'), Status::OPEN, $manager);
        $this->createTrip(50, "Accrobranche", new DateTime('2021-04-05'), 10, new DateTime('2021-04-05'), Status::CREATED, $manager);
        $this->createTrip(50, "Piscine", new DateTime('2021-06-07'), 10, new DateTime('2021-06-08'), Status::CREATED, $manager);
        $this->createTrip(50, "Randonnée", new DateTime('2021-10-01'), 10, new DateTime('2021-10-02'), Status::CREATED, $manager);
        $this->createTrip(60, "Vélo", new DateTime('2021-10-03'), 10, new DateTime('2021-10-04'), Status::OPEN, $manager);
        $this->createTrip(50, "Plage", new DateTime('2021-09-05'), 10, new DateTime('2021-09-06'), Status::CREATED, $manager);
        $this->createTrip(50, "Escalade", new DateTime('2021-11-07'), 10, new DateTime('2021-11-08'), Status::CREATED, $manager);
        $this->createTrip(50, "Kayak", new DateTime('2021-09-12'), 10, new DateTime('2021-09-13'), Status::CREATED, $manager);
        $this->createTrip(60, "4eme Sortie", new DateTime('2021-09-17'), 10, new DateTime('2021-09-18'), Status::OPEN, $manager);
        $this->createTrip(50, "Accrobranche", new DateTime('2021-09-05'), 10, new DateTime('2021-09-06'), Status::CREATED, $manager);
        $this->createTrip(50, "Piscine", new DateTime('2021-10-10'), 10, new DateTime('2021-10-11'), Status::CREATED, $manager);
        $this->createTrip(60, "5eme Sortie", new DateTime('2021-10-03'), 10, new DateTime('2021-10-04'), Status::OPEN, $manager);
        $this->createTrip(50, "6eme sortie", new DateTime('2021-10-05'), 10, new DateTime('2021-10-06'), Status::CREATED, $manager);
        $this->createTrip(50, "Une sortie incroyable", new DateTime('2021-10-07'), 10, new DateTime('2021-10-08'), Status::CREATED, $manager);
        $manager->flush();

    }

    public function createTrip($duration, $name, $registrationLimit, $registrationNumber, $startedAt, $status, ObjectManager $manager)
    {

        $trip = new Trip();
        $trip->setDuration($duration);
        $trip->setName($name);
        $trip->setRegistrationLimit($registrationLimit);
        $trip->setRegistrationNumber($registrationNumber);
        $trip->setStartedAt($startedAt);
        $trip->setPromoter($this->campusRepository->findOneBy([]));
        $trip->setPromoterContributor($this->contributorRepository->findOneBy([]));
        $trip->setStatus($this->statusRepository->findOneBy(["label" => $status]));
        $trip->setLocation($this->locationRepository->findOneBy([]));
        $manager->persist($trip);
        return $trip;
    }
}