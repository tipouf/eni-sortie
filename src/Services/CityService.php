<?php


namespace App\Services;


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
}