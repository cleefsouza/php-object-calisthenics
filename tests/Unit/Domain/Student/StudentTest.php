<?php

namespace Alura\Calisthenics\Tests\Unit\Domain\Student;

use Alura\Calisthenics\Domain\Address\Address;
use Alura\Calisthenics\Domain\Email\Email;
use Alura\Calisthenics\Domain\Student\Student;
use Alura\Calisthenics\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private Student $student;

    protected function setUp(): void
    {
        $address = new Address('Rua Jose Milk', '71B', 'Municípios', 'Santa Rita', 'Paraíba', 'Brasil');
        $email = new Email('email@example.com');

        $this->student = new Student(
            $email,
            new \DateTimeImmutable('1997-10-15'),
            'Vinicius',
            'Dias',
            $address
        );
    }

    public function testStudentWithoutWatchedVideosHasAccess()
    {
        self::assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoInLessThan90DaysHasAccess()
    {
        $date = new \DateTimeImmutable('89 days');
        $this->student->watch(new Video(), $date);

        self::assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoInLessThan90DaysButOtherVideosWatchedHasAccess()
    {
        $this->student->watch(new Video(), new \DateTimeImmutable('-89 days'));
        $this->student->watch(new Video(), new \DateTimeImmutable('-60 days'));
        $this->student->watch(new Video(), new \DateTimeImmutable('-30 days'));

        self::assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoIn90DaysDoesntHaveAccess()
    {
        $date = new \DateTimeImmutable('-90 days');
        $this->student->watch(new Video(), $date);

        self::assertFalse($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoIn90DaysButOtherVideosWatchedDoesntHaveAccess()
    {
        $this->student->watch(new Video(), new \DateTimeImmutable('-90 days'));
        $this->student->watch(new Video(), new \DateTimeImmutable('-60 days'));
        $this->student->watch(new Video(), new \DateTimeImmutable('-30 days'));

        self::assertFalse($this->student->hasAccess());
    }
}
