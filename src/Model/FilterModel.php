<?php


namespace App\Model;


use App\Entity\Campus;
use DateTime;

class FilterModel
{
    /** @var boolean */
    private bool $organizedByMe;

    /** @var boolean */
    private bool $mySubscription;

    /** @var boolean */
    private bool $tripPassed;

    /** @var boolean */
    private bool $notSubscribed;

    /** @var Campus|null */
    private ?Campus $campus = null;

    /** @var ?string */
    private ?string $nameSearch = "";

    /** @var DateTime|null */
    private ?DateTime $dateStartedAt;

    /** @var DateTime|null  */
    private ?DateTime $dateEndedAt;

    /**
     * @return bool
     */
    public function isOrganizedByMe(): bool
    {
        return $this->organizedByMe;
    }

    /**
     * @param bool $organizedByMe
     */
    public function setOrganizedByMe(bool $organizedByMe): void
    {
        $this->organizedByMe = $organizedByMe;
    }

    /**
     * @return bool
     */
    public function isMySubscription(): bool
    {
        return $this->mySubscription;
    }

    /**
     * @param bool $mySubscription
     */
    public function setMySubscription(bool $mySubscription): void
    {
        $this->mySubscription = $mySubscription;
    }

    /**
     * @return bool
     */
    public function isTripPassed(): bool
    {
        return $this->tripPassed;
    }

    /**
     * @param bool $tripPassed
     */
    public function setTripPassed(bool $tripPassed): void
    {
        $this->tripPassed = $tripPassed;
    }

    /**
     * @return bool
     */
    public function isNotSubscribed(): bool
    {
        return $this->notSubscribed;
    }

    /**
     * @param bool $notSubscribed
     */
    public function setNotSubscribed(bool $notSubscribed): void
    {
        $this->notSubscribed = $notSubscribed;
    }

    /**
     * @return Campus|null
     */
    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    /**
     * @param Campus|null $campus
     */
    public function setCampus(?Campus $campus): void
    {
        $this->campus = $campus;
    }

    /**
     * @return ?string
     */
    public function getNameSearch(): ?string
    {
        return $this->nameSearch;
    }

    /**
     * @param ?string $nameSearch
     */
    public function setNameSearch(?string $nameSearch): void
    {
        $this->nameSearch = $nameSearch;
    }

    /**
     * @return DateTime|null
     */
    public function getDateStartedAt(): ?DateTime
    {
        return $this->dateStartedAt;
    }

    /**
     * @param DateTime|null $dateStartedAt
     */
    public function setDateStartedAt(?DateTime $dateStartedAt): void
    {
        $this->dateStartedAt = $dateStartedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDateEndedAt(): ?DateTime
    {
        return $this->dateEndedAt;
    }

    /**
     * @param DateTime|null $dateEndedAt
     */
    public function setDateEndedAt(?DateTime $dateEndedAt): void
    {
        $this->dateEndedAt = $dateEndedAt;
    }


}