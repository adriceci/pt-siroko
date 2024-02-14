<?php

namespace Siroko\Shared;

use Siroko\Application\User\Auth\UserAuthenticator;
use Siroko\Domain\Encryptor\Encryptor;
use Siroko\Domain\Exceptions\AuthUserException;

class Utils
{
    public function __construct(
        public readonly Encryptor $encryptor
    )
    {
    }

    static function authUser(): \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Auth\Authenticatable
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
    }

    /**
     * @throws AuthUserException
     */
    static function ensureNotEmpty($var): void
    {
        if (empty($var)) {
            throw new AuthUserException(
                sprintf('<%s> does not allow empty variable', UserAuthenticator::class),
                400
            );
        }
    }

    /**
     * @throws AuthUserException
     */
    static function ensureEmailIsValid(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new AuthUserException(
                sprintf('<%s> does not allow invalid format email', UserAuthenticator::class),
                406
            );
        }
    }

    /**
     * @throws AuthUserException
     */
    static function ensurePasswordIsCorrect($plainPassword, $encryptedPassword): void
    {
        $encryptor = new Encryptor();
        if (!$encryptor->verifyEncrypt($plainPassword, $encryptedPassword)) {
            throw new AuthUserException(
                sprintf('<%s> does not allow invalid password', UserAuthenticator::class),
                401
            );
        }
    }
}
