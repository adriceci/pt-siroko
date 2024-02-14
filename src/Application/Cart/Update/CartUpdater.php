<?php

declare(strict_types=1);

namespace Siroko\Application\Cart\Update;

use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\Cart\CartUuid;
use Siroko\Domain\Exceptions\InvalidUuidException;
use Siroko\Domain\User\UserId;
use Siroko\Domain\User\UserRepository;
use Siroko\Domain\User\UserUuid;

final class CartUpdater
{
    public function __construct(
        private readonly CartRepository $cartRepository,
        private readonly UserRepository $userRepository
    )
    {

    }

    /**
     * @throws InvalidUuidException
     */
    public function __invoke(CartUpdaterDTO $cartUpdaterDTO): bool
    {
        $cart = $this->cartRepository->searchCartData(new CartUuid($cartUpdaterDTO->cartUuid));

        if (!$cart) {
            return false;
        }

        $user = $this->userRepository->search(new UserUuid($cartUpdaterDTO->userUuid));

        if (!$user) {
            return false;
        }

        $amount = 0;
        foreach ($cartUpdaterDTO->products as $product) {
            if ($product) {
                $amount += $product['price'] * $product['quantity'];
            }
        }

        $cart->setUserId(new UserId($user->getUserId()));
        $cart->setProducts($cartUpdaterDTO->products);
        $cart->setAmount($amount);
        $cart->setOrdered($cartUpdaterDTO->ordered);
        $cart->exists = true;

        return $this->cartRepository->save($cart);
    }
}
