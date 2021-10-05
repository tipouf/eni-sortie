<?php

namespace App\DataFixtures;

use App\Entity\Contributor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $contributor = new Contributor();
        $contributor->setFirstname("kevin");
        $contributor->setLastname("huet");
        $contributor->setEmail("kevin.huet2020@campus-eni.fr");
        $contributor->setPhone("0707070707");
        $contributor->setPassword($this->hasher->hashPassword($contributor, "test"));
        $contributor->setRoles(['ROLE_ADMIN']);
        $contributor->setEnable(true);
        $manager->persist($contributor);
        $manager->flush();
    }
}
