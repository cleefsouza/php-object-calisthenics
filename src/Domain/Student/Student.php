<?php

declare(strict_types=1);

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Address\Address;
use Alura\Calisthenics\Domain\Email\Email;
use Alura\Calisthenics\Domain\Video\{Video, WacthedVideos};
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

/**
 * Class Student
 * @package Alura\Calisthenics\Domain\Student
 */
class Student
{
    /**
     * @var Email
     */
    private Email $email;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $birthDate;

    /**
     * @var WacthedVideos
     */
    private WacthedVideos $watchedVideos;

    /**
     * @var string
     */
    private string $fName;

    /**
     * @var string
     */
    private string $lName;

    /**
     * @var Address
     */
    private Address $address;

    /**
     * Student constructor.
     * @param Email $email
     * @param DateTimeInterface $birthDate
     * @param string $fName
     * @param string $lName
     * @param Address $address
     */
    public function __construct(
        Email $email,
        DateTimeInterface $birthDate,
        string $fName,
        string $lName,
        Address $address
    ) {
        $this->watchedVideos = new WacthedVideos();
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return "{$this->fName} {$this->lName}";
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email->__toString();
    }

    /**
     * @return DateTimeInterface
     */
    public function getBirthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    /**
     * @param Video $video
     * @param DateTimeInterface $date
     */
    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() === 0) {
            return true;
        }

        return $this->lessThan90Days();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function lessThan90Days(): bool
    {
        /** @var DateTimeInterface $firstDate */
        $firstDate = $this->watchedVideos->dateOfFirstVideo();
        $today = new DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function age(): int
    {
        /** @var DateTimeImmutable $today */
        $today = new DateTimeImmutable();
        $dateInterval = $this->birthDate->diff($today);

        return $dateInterval->y;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address->__toString();
    }
}
