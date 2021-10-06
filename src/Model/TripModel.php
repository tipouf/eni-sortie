<?php


namespace App\Model;


use App\Entity\Campus;
use App\Entity\Location;
use DateTime;

class TripModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var DateTime
     */
    private $startedAt;

    /**
     * @var int
     */
    private $startedAtTime;

    /**
     * @var DateTime
     */
    private $registrationLimit;

    /**
     * @var int
     */
    private $registrationLimitTime;

    /**
     * @var integer
     */
    private $duration;

    /**
     * @var integer
     */
    private $registrationNumber;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Campus
     */
    private $promoter;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var boolean
     */
    private $newLocation;

    /**
     * @var LocationModel
     */
    private $locationType;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getStartedAt(): ?DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param string $startedAt
     */
    public function setStartedAt(string $startedAt): void
    {
        $this->startedAt = DateTime::createFromFormat("J-M-Y", $startedAt);
    }

    /**
     * @return int
     */
    public function getStartedAtTime(): int
    {
        return $this->startedAtTime;
    }

    /**
     * @param int $startedAtTime
     */
    public function setStartedAtTime(string $startedAtTime): void
    {
        $this->startedAtTime = strtotime($startedAtTime);
    }

    /**
     * @return DateTime
     */
    public function getRegistrationLimit(): ?DateTime
    {
        return $this->registrationLimit;
    }

    /**
     * @param string $registrationLimit
     */
    public function setRegistrationLimit(string $registrationLimit): void
    {
        $this->registrationLimit = DateTime::createFromFormat("J-M-Y", $registrationLimit);
    }

    /**
     * @return int
     */
    public function getRegistrationLimitTime(): int
    {
        return $this->registrationLimitTime;
    }

    /**
     * @param int $registrationLimitTime
     */
    public function setRegistrationLimitTime(string $registrationLimitTime): void
    {
        $this->registrationLimitTime = strtotime($registrationLimitTime);
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getRegistrationNumber(): int
    {
        return $this->registrationNumber;
    }

    /**
     * @param int $registrationNumber
     */
    public function setRegistrationNumber(int $registrationNumber): void
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Campus
     */
    public function getPromoter(): ?Campus
    {
        return $this->promoter;
    }

    /**
     * @param Campus $promoter
     */
    public function setPromoter(Campus $promoter): void
    {
        $this->promoter = $promoter;
    }

    /**
     * @return Location
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function isNewLocation(): bool
    {
        return $this->newLocation;
    }

    /**
     * @param bool $newLocation
     */
    public function setNewLocation(bool $newLocation): void
    {
        $this->newLocation = $newLocation;
    }

    /**
     * @return LocationModel
     */
    public function getLocationType(): ?LocationModel
    {
        return $this->locationType;
    }

    /**
     * @param LocationModel $locationType
     */
    public function setLocationType(LocationModel $locationType): void
    {
        $this->locationType = $locationType;
    }


}