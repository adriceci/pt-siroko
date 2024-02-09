<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Product;

use Illuminate\Support\Facades\DB;
use Siroko\Domain\Product\Product;
use Siroko\Domain\Product\ProductRepository;

final class MySQLProductRepository implements ProductRepository
{

    public function save(): bool
    {
        // TODO: Implement save() method.
    }

    public function search(): ?Product
    {
        // TODO: Implement search() method.
    }

    public function searchAll(): ?array
    {
        $products = DB::table('products')->get();

        if ($products->isEmpty()) {
            return null;
        }

        return $products->toArray();
    }
}

