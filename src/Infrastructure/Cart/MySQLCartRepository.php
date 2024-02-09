<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart;

use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\User\UserId;

final class MySQLCartRepository implements CartRepository
{

    public function save(): bool
    {
        // TODO: Implement save() method.
    }

    public function search(): ?Cart
    {
        // TODO: Implement search() method.
    }

    public function create(UserId $userId): ?Cart
    {

        $cart = $this->searchByUserId($userId);

        if ($cart) {
            return $cart;
        }

        $cart = new Cart();
        $cart->setUuid();
        $cart->setUserId($userId);
        $cart->setProducts([]);
        $cart->setAmount(0);
        $cart->save();

        return $cart;
    }

    // Private methods
    private function searchByUserId(UserId $userId): ?Cart
    {
        return Cart::where('user_id', $userId->value)
            ->where('ordered', false)
            ->first();
    }
}

