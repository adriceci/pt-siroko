<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Product\Searcher;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\Product\Search\ProductListSearcher;

final class ProductListController
{
    public function __construct(
        private readonly ProductListSearcher $productListSearcher
    )
    {

    }

    /**
     * @OA\Get(
     *     path="/products/",
     *     summary="Finds all products in database",
     *     description="Returns a list of products",
     *     operationId="searchAllProducts",
     *     tags={"Product"},
     *     @OA\Response(
     *         response=200,
     *         description="Product list successfully returned",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No products found"
     *     ),
     * )
     */
    public function __invoke(Request $request): JsonResponse
    {

        $products = $this->productListSearcher->__invoke();

        if (empty($products)) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products, 200);
    }
}
