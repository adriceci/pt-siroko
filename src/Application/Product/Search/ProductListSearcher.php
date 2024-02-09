<?php

declare(strict_types=1);

namespace Siroko\Application\Product\Search;

use Siroko\Domain\Product\ProductRepository;

final class ProductListSearcher
{
    public function __construct(
        private readonly ProductRepository $repository
    )
    {

    }

    public function __invoke(): ?array
    {
        return $this->repository->searchAll();
    }
}
