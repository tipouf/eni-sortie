<?php


namespace App\DataFixtures;


use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CampusFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        //$campus = new Campus();
        //$campus->setName("campusTest");
        $this->createCampus("CampusTest",$manager);
        $this->createCampus("CampusRennes",$manager);
        $this->createCampus("CampusNantes",$manager);
        $this->createCampus("CampusQuimper",$manager);
        //$manager->persist($campus);
        $manager->flush();
    }

    public function createCampus($name, ObjectManager $manager){
        $campus = new Campus();
        $campus->setName($name);
        $manager->persist($campus);
    }
}