<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Cart\Update;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\Cart\Update\CartUpdater;
use Siroko\Application\Cart\Update\CartUpdaterDTO;
use Siroko\Shared\Utils;

final class CartUpdateController
{
    public function __construct(
        private readonly CartUpdater $cartUpdater,
    )
    {

    }

    /**
     * @OA\Put(
     *    path="/cart/",
     *     summary="Update a existing cart",
     *     description="Returns a updated cart",
     *     operationId="updateCart",
     *     tags={"Cart"},
     *     @OA\Response(
     *          response=200,
     *          description="Cart successfully updated",
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Cart not updated",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Cart not found",
     *     ),
     * @throws InvalidUuidException
     */
    public function __invoke(Request $request): JsonResponse
    {
        Utils::authUser();

        $payload = $request->all();

        $cartUpdaterDTO = new CartUpdaterDTO(
            cartUuid: $payload['cart_id'],
            userUuid: $payload['user_id'],
            products: json_decode($payload['products'], true),
            ordered: (bool)$payload['ordered']
        );

        $output = $this->cartUpdater->__invoke($cartUpdaterDTO);

        if (!$output) {
            return response()->json(['message' => 'Cart cannot be updated'], 400);
        }

        $output = ['message' => 'Cart ' . $cartUpdaterDTO->cartUuid . ' successfully updated'];

        return response()->json($output, 200);
    }
}
