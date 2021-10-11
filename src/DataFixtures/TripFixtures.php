<?php

namespace App\DataFixtures;

use App\Entity\Contributor;
use App\Entity\Trip;
use App\Repository\CampusRepository;
use App\Repository\ContributorRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TripFixtures extends Fixture
{
    public function __construct(CampusRepository $campusRepository, ContributorRepository  $contributorRepository)
    {
        $this->campusRepository=$campusRepository;
        $this->contributorRepository=$contributorRepository;
    }

    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        //new DateTime("%")
        $this->createTrip(50,"1ere Sortie",new DateTime('2021-01-01'),10,new DateTime('2021-01-02'),$manager);
        $this->createTrip(60,"2eme Sortie",new DateTime('2021-01-03'),10,new DateTime('2021-01-04'),$manager);
        $this->createTrip(50,"Accrobranche",new DateTime('2021-04-05'),10,new DateTime('2021-04-05'),$manager);
        $this->createTrip(50,"Piscine",new DateTime('2021-06-07'),10,new DateTime('2021-06-08'),$manager);
        $manager->flush();

    }

    public function createTrip($duration,$name,$registrationLimit,$registrationNumber,$startedAt,ObjectManager $manager){

        $trip = new Trip();
        $trip->setDuration($duration);
        $trip->setName($name);
        $trip->setRegistrationLimit($registrationLimit);
        $trip->setRegistrationNumber($registrationNumber);
        $trip->setStartedAt($startedAt);
        $trip->setPromoter($this->campusRepository->findOneBy([]));
        $trip->setPromoterContributor($this->contributorRepository->findOneBy([]));
        $manager->persist($trip);
        return $trip;
    }
}