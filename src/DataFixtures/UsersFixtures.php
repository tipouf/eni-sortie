<?php

namespace App\DataFixtures;

use App\Entity\Contributor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // $contributor = $this->createContributor();
        $this->createContributor("Kevin","Huet","kevin.huet2020campus-eni.fr","0707070707","ROLE_ADMIN",$manager);
        $this->createContributor("Antoine","Quatrevaux","antoine.quatrevaux2020campus-eni.fr","07607070707","ROLE_ADMIN",$manager);
        $this->createContributor("Nicolas","Cindon","nicolas.cindon2020campus-eni.fr","0706070707","ROLE_ADMIN",$manager);
        $this->createContributor("Jean","Jean","jean.jean2020campus-eni.fr","0707070707","ROLE_ADMIN",$manager);
        $manager->flush();

    }

    private function createContributor($firstName,$lastName,$email,$phone,$role,ObjectManager $manager): Contributor
    {
        $contributor = new Contributor();
        $contributor->setFirstname($firstName);
        $contributor->setLastname($lastName);
        $contributor->setEmail($email);
        $contributor->setPhone($phone);
        $contributor->setPassword($this->hasher->hashPassword($contributor, "test"));
        $contributor->setRoles([$role]);
        $contributor->setEnable(true);
        $manager->persist($contributor);
        return $contributor;
    }
}
