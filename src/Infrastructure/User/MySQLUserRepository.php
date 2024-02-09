<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\User;

use Illuminate\Support\Facades\DB;
use Siroko\Domain\User\User;
use Siroko\Domain\User\UserEmail;
use Siroko\Domain\User\UserRepository;

final class MySQLUserRepository implements UserRepository
{
    public function searchByEmail(UserEmail $email): ?User
    {
        $query = DB::table('users')
            ->where('email', $email->value())
            ->first();

        if (null === $query) {
            return null;
        }

        return new User(
            [
                'name' => $query->name,
                'email' => $query->email,
                'password' => $query->password,
            ]
        );
    }
}
