<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart;

use Illuminate\Support\Facades\DB;
use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\Cart\CartUuid;
use Siroko\Domain\User\UserId;

final class MySQLCartRepository implements CartRepository
{

    public function save(): bool
    {
        // TODO: Implement save() method.
    }

    public function search(CartUuid $cartUuid): ?array
    {
        $cart = DB::table('carts')
            ->select(
                'carts.cart_uuid as cart_id',
                DB::raw('JSON_OBJECT(
                    "user_uuid", users.user_uuid,
                    "name", users.name,
                    "email", users.email
                ) as user'),
                'carts.products',
                'carts.amount',
                'carts.ordered',
            )
            ->join('users', 'carts.user_id', '=', 'users.user_id')
            ->where('carts.cart_uuid', $cartUuid->value())
            ->first();

        if (null === $cart) {
            return null;
        }

        return (array)$cart;
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

