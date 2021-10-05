<?php


namespace App\Services;


use App\Entity\Campus;
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

    public function getCampusByName(string $name): ?Campus
    {
        return $this->campusRepository->findOneBy(["name" => $name]);
    }

    public function getAllCampus(): array
    {
        return $this->campusRepository->findAll();
    }

    public function createCampus(string $name)
    {
        if ($this->campusRepository->findOneBy(["name" => $name]))
            return;
        $campus = new Campus();
        $campus->setName($name);
        $this->em->persist($campus);
        $this->em->flush();
    }

    public function addCampus(Campus $campus)
    {
        if ($this->campusRepository->findOneBy(["name" => $campus->getName()]))
            return;
        $this->em->persist($campus);
        $this->em->flush();
    }

    public function removeCampus(Campus $campus)
    {
        $this->em->remove($campus);
        $this->em->flush();
    }
}