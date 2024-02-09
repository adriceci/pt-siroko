<?php

declare(strict_types=1);

namespace Siroko\Application\User\Auth;

use Siroko\Domain\Exceptions\InvalidUuidException;
use Siroko\Domain\User\UserRepository;
use Siroko\Domain\User\UserUuid;

final class CreateUserToken
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws InvalidUuidException
     */
    public function __invoke(string $uuid): string
    {

        $userUuid = new UserUuid($uuid);

        return $this->repository->createAuthToken($userUuid);
    }
}
