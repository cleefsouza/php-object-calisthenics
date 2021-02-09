<?php

declare(strict_types=1);

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Video\Video;
use DateTimeInterface;
use Ds\Map;
use Exception;

/**
 * Class Student
 * @package Alura\Calisthenics\Domain\Student
 */
class Student
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $bd;

    /**
     * @var Map
     */
    private Map $watchedVideos;

    /**
     * @var string
     */
    private string $fName;

    /**
     * @var string
     */
    private string $lName;

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
     * Student constructor.
     * @param string $email
     * @param DateTimeInterface $bd
     * @param string $fName
     * @param string $lName
     * @param string $street
     * @param string $number
     * @param string $province
     * @param string $city
     * @param string $state
     * @param string $country
     */
    public function __construct(
        string $email,
        DateTimeInterface $bd,
        string $fName,
        string $lName,
        string $street,
        string $number,
        string $province,
        string $city,
        string $state,
        string $country
    ) {
        $this->watchedVideos = new Map();
        $this->setEmail($email);
        $this->bd = $bd;
        $this->fName = $fName;
        $this->lName = $lName;
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
    public function getFullName(): string
    {
        return "{$this->fName} {$this->lName}";
    }

    /**
     * @param string $email
     */
    private function setEmail(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            $this->email = $email;
        } else {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return DateTimeInterface
     */
    public function getBd(): DateTimeInterface
    {
        return $this->bd;
    }

    /**
     * @param Video $video
     * @param DateTimeInterface $date
     */
    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->put($video, $date);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() > 0) {
            return $this->lessThan90Days();
        }

        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function lessThan90Days(): bool
    {
        $this->watchedVideos->sort(fn(DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);
        /** @var DateTimeInterface $firstDate */
        $firstDate = $this->watchedVideos->first()->value;
        $today = new \DateTimeImmutable();

        return !$firstDate->diff($today)->days >= 90;
    }
}
