<?php

declare(strict_types=1);

namespace Siroko\Domain\User;

use InvalidArgumentException;

final class UserId
{
    public int $value;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(int $id)
    {
        $this->ensureIdIsValid($id);
        $this->value = $id;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function ensureIdIsValid(int $id): void
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>', self::class, $id)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
