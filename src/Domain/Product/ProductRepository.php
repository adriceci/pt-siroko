<?php

declare(strict_types=1);

namespace Siroko\Domain\Product;

interface ProductRepository
{
    public function save(Product $product): bool;

    public function search(ProductUuid $productUuid): ?Product;

    public function searchAll(): ?array;
}
