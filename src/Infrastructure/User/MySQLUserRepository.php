<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\User;

use Illuminate\Support\Facades\DB;
use Siroko\Domain\User\User;
use Siroko\Domain\User\UserEmail;
use Siroko\Domain\User\UserRepository;
use Siroko\Domain\User\UserUuid;

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
                'user_uuid' => $query->user_uuid,
                'name' => $query->name,
                'email' => $query->email,
                'password' => $query->password,
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function createAuthToken(UserUuid $userUuid): string
    {
        $model = User::where('user_uuid', $userUuid->value())->first();

        if (null === $model) {
            throw new \Exception('User not found');
        }

        return $model->createToken($model->user_uuid)->plainTextToken;
    }
}
