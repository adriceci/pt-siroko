<?php

declare(strict_types=1);

namespace Siroko\Application\User\Auth;

final class AuthUserDTO
{
    public string $email;
    public string $password;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

}
