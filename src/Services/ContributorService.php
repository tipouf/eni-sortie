<?php


namespace App\Services;


use App\Entity\Campus;
use App\Entity\Contributor;
use App\Repository\ContributorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ContributorService
{
    private ContributorRepository $contributorRepository;
    private EntityManagerInterface $em;
    private SluggerInterface $slugger;

    public function __construct(EntityManagerInterface $em, ContributorRepository $contributorRepository,
                                SluggerInterface $slugger) {
        $this->contributorRepository = $contributorRepository;
        $this->em = $em;
        $this->slugger = $slugger;
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

    public function uploadFile(UploadedFile $file, Contributor $user, $uploadPath)
    {
        if ($file) {
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($fileName);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            try {
                $file->move(
                    $uploadPath.'/'.$user->getEmail(),
                    $newFilename
                );
                $user->setProfilePictureName($newFilename);
                $this->em->persist($user);
                $this->em->flush();
            } catch (FileException $e) {
                dd($e->getMessage());
            }
        }
    }
}