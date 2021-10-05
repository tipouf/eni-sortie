<?php


namespace App\Services;


use App\Entity\Campus;
use App\Entity\Contributor;
use App\Repository\ContributorRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContributorService
{
    private ContributorRepository $contributorRepository;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, ContributorRepository $contributorRepository) {
        $this->contributorRepository = $contributorRepository;
        $this->em = $em;
    }

    public function getAllContributors(): array
    {
        return $this->contributorRepository->findAll();
    }

    public function getContributorByEmail(string $email): ?Contributor
    {
        return $this->contributorRepository->findOneBy(["email" => $email]);
    }

    public function getContributorByFirstname(string $firstname): ?Contributor
    {
        return $this->contributorRepository->findOneBy(["email" => $firstname]);
    }

    public function getContributorByLastname(string $lastname): ?Contributor
    {
        return $this->contributorRepository->findOneBy(["email" => $lastname]);
    }

    public function addContributor(Contributor $contributor)
    {
        $this->em->persist($contributor);
        $this->em->flush();
    }

    public function removeContributor(Contributor $contributor)
    {
        $this->em->remove($contributor);
        $this->em->flush();
    }
}