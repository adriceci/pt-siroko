<?php

declare(strict_types=1);

namespace Siroko\Application\Cart\Create;

use Siroko\Domain\User\User;

final class CartCreatorDTO
{
    public function __construct(
        public User $user
    )
    {
    }
}
