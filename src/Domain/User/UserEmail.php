<?php

declare(strict_types=1);

namespace Siroko\Domain\User;

use InvalidArgumentException;

final class UserEmail
{
    public string $value;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(string $email)
    {
        $this->ensureEmailIsValid($email);
        $this->value = $email;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function ensureEmailIsValid(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>', self::class, $email)
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
