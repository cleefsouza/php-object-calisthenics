<?php

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;

/**
 * Interface VideoRepository
 * @package Alura\Calisthenics\Domain\Video
 */
interface VideoRepository
{
    /**
     * @param Video $video
     */
    public function add(Video $video): void;

    /**
     * @param Student $student
     * @return array
     */
    public function videosFor(Student $student): array;
}
