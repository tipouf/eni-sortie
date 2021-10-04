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
        $contributor->setFirstname();
        $contributor->setLastname();
        $contributor->setEmail();
        $contributor->setPhone();
        $contributor->setPhone();
        $contributor->setPassword();
        $contributor->setPassword($this->hasher->hashPassword($contributor, "test"));
        $contributor->setRoles();

        $manager->flush();
    }
}
