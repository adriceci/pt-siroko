<?php

declare(strict_types=1);

namespace Siroko\Application\Cart\Search;

use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\Cart\CartUuid;
use Siroko\Domain\Exceptions\InvalidUuidException;

final class CartSearcher
{
    public function __construct(
        private readonly CartRepository $repository,
    )
    {

    }

    /**
     * @throws InvalidUuidException
     */
    public function __invoke(string $cartId): ?array
    {
        $cartUuid = new CartUuid($cartId);
        return $this->repository->search($cartUuid);
    }
}
