<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart\Searcher;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\Cart\Search\CartSearcher;

final class CartSearcherController
{
    public function __construct(
        private readonly CartSearcher $cartSearcher,
    )
    {

    }

    /**
     * @OA\Get(
     *    path="/cart/items",
     *     summary="Search for a cart all items",
     *     description="Returns a list of items in the cart",
     *     operationId="searchCartItems",
     *     tags={"Cart"},
     *     @OA\Response(
     *          response=200,
     *          description="Cart items found",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Cart not found or user not found",
     *     ),
     */
    public function __invoke(Request $request, string $cartId): JsonResponse
    {

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $cart = $this->cartSearcher->__invoke($cartId);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $data = [
            'cart_id' => $cart['cart_id'],
            'user' => json_decode($cart['user']),
            'products' => json_decode($cart['products']),
            'amount' => $cart['amount'],
            'ordered' => $cart['ordered'],
        ];

        return response()->json($data, 200);
    }
}
