<?php


namespace App\Model;


use App\Entity\City;

class LocationModel
{
    /** @var string */
    private $name;

    /** @var string */
    private $street;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /**
     * LocationModel constructor.
     * @param string $name
     * @param string $street
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(string $name = null, string $street = null, float $latitude = null, float $longitude = null)
    {
        $this->name = $name;
        $this->street = $street;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

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
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }


}