<?php

declare(strict_types=1);

namespace Siroko\Application\Cart\Search;

use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\Cart\CartUuid;
use Siroko\Domain\Exceptions\InvalidUuidException;

final class CartDataSearcher
{
    public function __construct(
        private readonly CartRepository $repository,
    )
    {

    }

    /**
     * @throws InvalidUuidException
     */
    public function __invoke(string $cartId): ?Cart
    {
        $cartUuid = new CartUuid($cartId);
        return $this->repository->searchCartData($cartUuid);
    }
}
