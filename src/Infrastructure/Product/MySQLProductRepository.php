<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Product;

use Illuminate\Support\Facades\DB;
use Siroko\Domain\Product\Product;
use Siroko\Domain\Product\ProductRepository;
use Siroko\Domain\Product\ProductUuid;

final class MySQLProductRepository implements ProductRepository
{

    public function save(Product $product): bool
    {
        return $product->save();
    }

    public function search(ProductUuid $productUuid): ?Product
    {
        return Product::where('product_uuid', $productUuid->value())->firstOrFail();
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

