<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Product;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Siroko\Application\Product\Search\ProductListSearcher;
use Siroko\Domain\Product\ProductRepository;

final class ProductTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_it_should_call_product_search_all(): void
    {
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->expects($this->once())->method('searchAllAvailableProducts');
        $productListSearcher = new ProductListSearcher($productRepository);
        $productListSearcher->__invoke();
    }

    /**
     * @throws Exception
     */
    public function test_it_should_return_product_list(): void
    {
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->method('searchAllAvailableProducts')->willReturn(['product1', 'product2']);
        $productListSearcher = new ProductListSearcher($productRepository);
        $products = $productListSearcher->__invoke();
        $this->assertEquals(['product1', 'product2'], $products);
    }

    /**
     * @throws Exception
     */
    public function test_it_should_return_empty_product_list(): void
    {
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->method('searchAllAvailableProducts')->willReturn([]);
        $productListSearcher = new ProductListSearcher($productRepository);
        $products = $productListSearcher->__invoke();
        $this->assertEquals([], $products);
    }
}
