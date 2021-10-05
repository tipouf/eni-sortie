<?php


namespace App\Services;


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