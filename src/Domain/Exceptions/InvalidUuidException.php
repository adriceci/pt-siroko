<?php

declare(strict_types=1);

namespace Siroko\Domain\Exceptions;

use Exception;

final class InvalidUuidException extends Exception
{
    public $message;
    public $code;

    public function __construct(string $msg, mixed $code)
    {
        parent::__construct();
        $this->message = $msg;
        $this->code = $code;
    }
}
