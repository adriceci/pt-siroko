<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart\Checkout;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\Cart\Checkout\CartCheckout;
use Siroko\Application\Cart\Search\CartDataSearcher;
use Siroko\Shared\Utils;

final class CartCheckoutController
{
    public function __construct(
        private readonly CartCheckout     $cartCheckout,
        private readonly CartDataSearcher $cartDataSearcher
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
     *          description="Order not created or Cart is empty",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Cart not found",
     *     ),
     */
    public function __invoke(Request $request, string $cartUuid): JsonResponse
    {

        Utils::authUser();

        $cart = $this->cartDataSearcher->__invoke($cartUuid);

        if (null === $cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        if (!json_decode($cart->getProducts())) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $order = $this->cartCheckout->__invoke($cart);

        if (null === $order) {
            return response()->json(['error' => 'Order not created'], 400);
        }

        $order['products'] = json_decode($order['products'], true);

        return response()->json($order, 200);
    }
}
