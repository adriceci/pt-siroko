<?php

declare(strict_types=1);

namespace Siroko\Shared;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Siroko\Domain\Exceptions\InvalidUuidException;

class Uuid
{
    private string $value;

    /**
     * @throws InvalidUuidException
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidUuid($value);
        $this->value = $value;
    }

    /**
     * @throws InvalidUuidException
     */
    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidUuidException
     */
    private function ensureIsValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidUuidException(
                sprintf('<%s> does not allow the value <%s>', Uuid::class, $id),
                400
            );
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
