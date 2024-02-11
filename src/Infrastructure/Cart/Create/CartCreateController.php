<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart\Create;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\Cart\Create\CartCreator;
use Siroko\Shared\Utils;

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

        $user = Utils::authUser();

        $cart = $this->cartCreator->__invoke($user->getUserId());

        return response()->json($cart, 200);
    }
}
