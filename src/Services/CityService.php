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

    public function getAllCities(): array
    {
        return $this->cityRepository->findAll();
    }

    public function getCityByName(string $name): ?City
    {
        return $this->cityRepository->findOneBy(["name" => $name]);
    }

    public function getCityByNameAndCode(string $name, string $postalCode): ?City
    {
        return $this->cityRepository->findOneBy(["name" => $name, "postalCode" => $postalCode]);
    }

    public function getCitiesByPostalCode (string $postalCode): array
    {
        return $this->cityRepository->findBy(["postalCode" => $postalCode]);
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