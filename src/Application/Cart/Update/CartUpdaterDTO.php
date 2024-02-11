<?php

declare(strict_types=1);

namespace Siroko\Application\Cart\Update;

final class CartUpdaterDTO
{
    public function __construct(
        public string $cartUuid,
        public string $userUuid,
        public array  $products,
        public bool   $ordered
    )
    {
    }
}
