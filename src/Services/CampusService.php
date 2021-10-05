<?php


namespace App\Services;


use App\Repository\CampusRepository;
use Doctrine\ORM\EntityManagerInterface;

class CampusService
{
    private CampusRepository $campusRepository;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, CampusRepository $campusRepository)
    {
        $this->campusRepository = $campusRepository;
        $this->em = $em;
    }
}