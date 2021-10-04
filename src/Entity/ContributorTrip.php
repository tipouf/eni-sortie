<?php

namespace App\Entity;

use App\Repository\ContributorTripRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContributorTripRepository::class)
 */
class ContributorTrip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Contributor::class, inversedBy="contributorTrips")
     */
    private $contributors;

    /**
     * @ORM\ManyToOne(targetEntity=Trip::class, inversedBy="contributorTrips")
     */
    private $trips;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContributors(): ?Contributor
    {
        return $this->contributors;
    }

    public function setContributors(?Contributor $contributors): self
    {
        $this->contributors = $contributors;

        return $this;
    }

    public function getTrips(): ?Trip
    {
        return $this->trips;
    }

    public function setTrips(?Trip $trips): self
    {
        $this->trips = $trips;

        return $this;
    }
}
