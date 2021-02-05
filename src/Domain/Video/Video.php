<?php

declare(strict_types=1);

namespace Alura\Calisthenics\Domain\Video;

/**
 * Class Video
 * @package Alura\Calisthenics\Domain\Video
 */
class Video
{
    private bool $visible = false;
    private int $ageLimit;

    public function publish(): void
    {
        $this->visible = true;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->visible;
    }

    /**
     * @return int
     */
    public function getAgeLimit(): int
    {
        return $this->ageLimit;
    }

    /**
     * @param int $ageLimit
     */
    public function setAgeLimit(int $ageLimit): void
    {
        $this->ageLimit = $ageLimit;
    }
}
