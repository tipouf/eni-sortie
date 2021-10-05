<?php


namespace App\Services;


use App\Entity\City;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;

class CityService
{
    private CityRepository $cityRepository;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->em = $em;
    }

    public function createCity(string $name, string $postalCode)
    {
        $city = new City();
        $city->setName($name);
        $city->setPostalCode($postalCode);
        $this->em->persist($city);
        $this->em->flush();
    }

    public function addCity(City $city)
    {
        $this->em->persist($city);
        $this->em->flush();
    }

    public function removeCity(City $city)
    {
        $this->em->remove($city);
        $this->em->flush();
    }
}