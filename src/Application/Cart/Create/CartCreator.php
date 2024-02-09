<?php

declare(strict_types=1);

namespace Siroko\Application\Cart\Create;

use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\User\UserId;

final class CartCreator
{
    public function __construct(
        private readonly CartRepository $repository
    )
    {

    }

    public function __invoke(int $id): ?Cart
    {

        $userId = new UserId($id);
        return $this->repository->create($userId);
    }
}
