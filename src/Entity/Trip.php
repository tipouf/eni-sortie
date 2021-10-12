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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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

    /**
     * @ORM\ManyToMany(targetEntity=Contributor::class, inversedBy="trips")
     * @ORM\JoinTable(name="contributor_trip")
     */
    private $contributors;


    /** @var ?City */
    private $city;

    /**
     * @return City|null
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @param City|null $city
     */
    public function setCity(?City $city): void
    {
        $this->city = $city;
    }

    public function __construct()
    {
        $this->contributors = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|Contributor[]
     */
    public function getContributors(): Collection
    {
        return $this->contributors;
    }

    public function addContributor(Contributor $contributor): self
    {
        if (!$this->contributors->contains($contributor)) {
            $this->contributors[] = $contributor;
        }

        return $this;
    }

    public function removeContributor(Contributor $contributor): self
    {
        $this->contributors->removeElement($contributor);

        return $this;
    }
}
