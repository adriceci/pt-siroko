<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart\Create;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\Cart\Create\CartCreator;

final class CartCreateController
{
    public function __construct(
        private readonly CartCreator $cartCreator,
    )
    {

    }

    /**
     * @OA\Post(
     *    path="/cart/",
     *     summary="Create a new cart",
     *     description="Returns a new cart",
     *     operationId="createCart",
     *     tags={"Cart"},
     *     @OA\Response(
     *          response=200,
     *          description="Cart successfully created",
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Cart not created",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="User not found",
     *     ),
     */
    public function __invoke(Request $request): JsonResponse
    {

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $cart = $this->cartCreator->__invoke($user->getUserId());

        if (!$cart) {
            return response()->json(['message' => 'Cart not created'], 400);
        }

        return response()->json($cart, 200);
    }
}
