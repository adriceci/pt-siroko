<?php

declare(strict_types=1);

namespace Siroko\Domain\Product;

interface ProductRepository
{
    public function save(): bool;

    public function search(): ?Product;

    public function searchAllAvailableProducts(): ?array;
}
