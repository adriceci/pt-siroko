<?php

declare(strict_types=1);

namespace Siroko\Application\User\Auth;


use Siroko\Domain\User\User;
use Siroko\Domain\User\UserEmail;
use Siroko\Domain\User\UserRepository;

final class UserAuthenticator
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AuthUserDTO $authUserDTO): ?User
    {
        $user = new User();
        $user->email = new UserEmail($authUserDTO->email);

        return $this->repository->searchByEmail($user->email);
    }
}
