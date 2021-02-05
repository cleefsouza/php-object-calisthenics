<?php

declare(strict_types=1);

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;
use Exception;

/**
 * Class InMemoryVideoRepository
 * @package Alura\Calisthenics\Domain\Video
 */
class InMemoryVideoRepository implements VideoRepository
{
    /**
     * @var array
     */
    private array $videos;

    /**
     * @param Video $video
     */
    public function add(Video $video): void
    {
        $this->videos[] = $video;
    }

    /**
     * @param Student $student
     * @return array
     * @throws Exception
     */
    public function videosFor(Student $student): array
    {
        $today = new \DateTimeImmutable();
        return array_filter($this->videos, fn (Video $video) => $video->getAgeLimit() <= $student->getBd()->diff($today)->y);
    }
}
