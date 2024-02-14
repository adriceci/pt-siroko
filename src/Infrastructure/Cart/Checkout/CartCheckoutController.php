<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart\Checkout;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\Cart\Checkout\CartCheckout;
use Siroko\Application\Cart\Checkout\CartCheckoutDTO;
use Siroko\Shared\Utils;

final class CartCheckoutController
{
    public function __construct(
        private readonly CartCheckout $cartCheckout,
    )
    {

    }

    /**
     * @OA\Post(
     *    path="/cart/{cart_id}/checkout",
     *     summary="Checkout a Cart",
     *     description="Returns the new order",
     *     operationId="checkoutCart",
     *     tags={"Cart"},
     *     @OA\Response(
     *          response=200,
     *          description="Order created",
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Order not created",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="User not found",
     *     ),
     */
    public function __invoke(Request $request, string $cartUuid): JsonResponse
    {

        Utils::authUser();

        $order = $this->cartCheckout->__invoke($cartUuid);

        if (null === $order) {
            return response()->json(['error' => 'Cart not created'], 400);
        }

        $order['products'] = json_decode($order['products'], true);

        return response()->json($order, 200);
    }
}
