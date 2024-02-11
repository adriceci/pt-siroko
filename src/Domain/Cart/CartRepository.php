<?php

declare(strict_types=1);

namespace Siroko\Domain\Cart;

use Siroko\Domain\User\UserId;

interface CartRepository
{
    public function save(Cart $cart): bool;

    public function search(CartUuid $cartUuid): ?array;

    public function searchCart(CartUuid $cartUuid): ?Cart;

    public function create(UserId $userId): ?Cart;
}
