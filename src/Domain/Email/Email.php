<?php

declare(strict_types=1);

namespace Alura\Calisthenics\Domain\Email;

/**
 * Class Email
 * @package Alura\Calisthenics\Domain\Email
 */
class Email
{
    /**
     * @var string
     */
    private string $email;

    /**
     * Email constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }
}
