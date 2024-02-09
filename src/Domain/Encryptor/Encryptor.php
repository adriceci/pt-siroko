<?php

declare(strict_types=1);

namespace Siroko\Domain\Encryptor;


final class Encryptor
{

    private $cost = 10;

    public function encrypt(String $str): string
    {
        return password_hash($str, PASSWORD_BCRYPT, ['cost' => $this->cost]);
    }

    public function verifyEncrypt(String $str, String $hash): bool
    {
        return password_verify($str, $hash);
    }
}
