<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startedAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registrationLimit;

    /**
     * @ORM\Column(type="integer")
     */
    private $registrationNumber;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ContributorTrip::class, mappedBy="trips")
     */
    private $contributorTrips;

    /**
     * @ORM\ManyToOne(targetEntity=Campus::class, inversedBy="trips")
     */
    private $promoter;

    /**
     * @ORM\ManyToOne(targetEntity=Contributor::class, inversedBy="trips")
     */
    private $promoterContributor;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="trips")
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="trips")
     */
    private $status;

    public function __construct()
    {
        $this->contributorTrips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getRegistrationLimit(): ?\DateTimeInterface
    {
        return $this->registrationLimit;
    }

    public function setRegistrationLimit(\DateTimeInterface $registrationLimit): self
    {
        $this->registrationLimit = $registrationLimit;

        return $this;
    }

    public function getRegistrationNumber(): ?int
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(int $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ContributorTrip[]
     */
    public function getContributorTrips(): Collection
    {
        return $this->contributorTrips;
    }

    public function addContributorTrip(ContributorTrip $contributorTrip): self
    {
        if (!$this->contributorTrips->contains($contributorTrip)) {
            $this->contributorTrips[] = $contributorTrip;
            $contributorTrip->setTrips($this);
        }

        return $this;
    }

    public function removeContributorTrip(ContributorTrip $contributorTrip): self
    {
        if ($this->contributorTrips->removeElement($contributorTrip)) {
            // set the owning side to null (unless already changed)
            if ($contributorTrip->getTrips() === $this) {
                $contributorTrip->setTrips(null);
            }
        }

        return $this;
    }

    public function getPromoter(): ?Campus
    {
        return $this->promoter;
    }

    public function setPromoter(?Campus $promoter): self
    {
        $this->promoter = $promoter;

        return $this;
    }

    public function getPromoterContributor(): ?Contributor
    {
        return $this->promoterContributor;
    }

    public function setPromoterContributor(?Contributor $promoterContributor): self
    {
        $this->promoterContributor = $promoterContributor;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}
