<?php

declare(strict_types=1);

namespace Alura\Calisthenics\Domain\Address;

/**
 * Class Address
 * @package Alura\Calisthenics\Domain\Address
 */
class Address
{
    /**
     * @var string
     */
    public string $street;

    /**
     * @var string
     */
    public string $number;

    /**
     * @var string
     */
    public string $province;

    /**
     * @var string
     */
    public string $city;

    /**
     * @var string
     */
    public string $state;

    /**
     * @var string
     */
    public string $country;

    /**
     * Address constructor.
     * @param string $street
     * @param string $number
     * @param string $province
     * @param string $city
     * @param string $state
     * @param string $country
     */
    public function __construct(
        string $street,
        string $number,
        string $province,
        string $city,
        string $state,
        string $country
    ) {
        $this->street = $street;
        $this->number = $number;
        $this->province = $province;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "{$this->street}, n. {$this->number} - {$this->city}/{$this->state}, {$this->country}";
    }
}
