<?php

declare(strict_types=1);

namespace Siroko\Domain\User;

interface UserRepository
{
    public function searchByEmail(UserEmail $email): ?User;
}
