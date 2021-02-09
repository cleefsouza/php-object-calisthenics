<?php

declare(strict_types=1);

namespace Alura\Calisthenics\Domain\Video;

use Countable;
use DateTimeInterface;
use Ds\Map;

/**
 * Class WathcedVideos
 * @package Alura\Calisthenics\Domain\Video
 */
class WacthedVideos implements Countable
{
    /**
     * @var Map
     */
    private Map $videos;

    /**
     * WacthedVideos constructor.
     */
    public function __construct()
    {
        $this->videos = new Map();
    }

    /**
     * @param Video $video
     * @param DateTimeInterface $dateTime
     */
    public function add(Video $video, DateTimeInterface $dateTime): void
    {
        $this->videos->put($video, $dateTime);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->videos->count();
    }

    /**
     * @return DateTimeInterface
     */
    public function dateOfFirstVideo(): DateTimeInterface
    {
        $this->videos->sort(fn(DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);

        return $this->videos->first()->value;
    }
}
