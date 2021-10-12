<?php


namespace App\DataFixtures;


use App\Entity\Campus;
use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CitiesFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $this->createCity("Rennes", "35000", $manager);
        $this->createCity("St Brieuc", "22000", $manager);
        $this->createCity("Quimper", "29000", $manager);
        $this->createCity("Brest", "29200", $manager);
        $manager->flush();
    }

    private function createCity($name, $postalCode, ObjectManager $manager){
        $city = new City($name, $postalCode);
        $manager->persist($city);
    }
}