<?php


namespace App\DataFixtures;


use App\Entity\Campus;
use App\Entity\City;
use App\Entity\Location;
use App\Services\CityService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LocationFixtures extends Fixture
{
    private CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function load(ObjectManager $manager)
    {
        $this->createLocation($manager, "ENI Quimper", new City("Quimper", "29000"), 10, 10, "19 rue test");
        $this->createLocation($manager, "Epitech", new City("Rennes", "35000"), 74, 540, "1 rue test");
        $this->createLocation($manager, "ENI Rennes", new City("Rennes", "35000"), 10, 10, "35 rue test");
        $this->createLocation($manager, "ENI Nantes", new City("Nantes", "44000"), 74, 540, "44 rue test");
        $this->createLocation($manager, "ENI Niort", new City("Niort", "79000"), 74, 540, "79 rue test");
        $this->createLocation($manager, "ENI Vannes", new City("Vannes", "56000"), 74, 540, "56 rue test");
        $this->createLocation($manager, "ENI Paris", new City("Paris", "75000"), 74, 540, "75 rue test");
        $manager->flush();
    }

    private function createLocation(ObjectManager $manager, string $name, City $city,
                                    float $latitude, float $longitude, string $street)
    {
        $cityDb = $this->cityService->getCityByNameAndCode($city->getName(), $city->getPostalCode());
        $location = new Location();
        $location->setName($name);
        $location->setCity(($cityDb) ?: $city);
        $location->setLatitude($latitude);
        $location->setLongitude($longitude);
        $location->setStreet($street);
        $manager->persist($location);
        ($cityDb) ? $cityDb->addLocation($location) : $city->addLocation($location);
        $manager->persist(($cityDb) ?: $city);
    }
}