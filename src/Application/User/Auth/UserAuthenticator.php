<?php

declare(strict_types=1);

namespace Siroko\Application\User\Auth;


use Siroko\Domain\Exceptions\AuthUserException;
use Siroko\Domain\User\User;
use Siroko\Domain\User\UserEmail;
use Siroko\Domain\User\UserRepository;

final class UserAuthenticator
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws AuthUserException
     */
    public function __invoke(AuthUserDTO $authUserDTO): ?User
    {
        $email = new UserEmail($authUserDTO->email);

        $user = $this->repository->searchByEmail($email);

        if ($user === null) {
            throw new AuthUserException('User not found', 404);
        }

        return $user;
    }
}
