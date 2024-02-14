<?php

declare(strict_types=1);

namespace Siroko\Application\Cart\Checkout;

use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\Cart\CartUuid;
use Siroko\Domain\Exceptions\InvalidUuidException;
use Siroko\Domain\Order\Order;
use Siroko\Domain\Order\OrderRepository;
use Siroko\Domain\Order\OrderStatusRepository;
use Siroko\Domain\Product\ProductRepository;
use Siroko\Domain\Product\ProductUuid;
use Siroko\Shared\Enums\OrderStatusEnum;
use Siroko\Shared\Uuid;

final class CartCheckout
{
    public function __construct(
        private readonly CartRepository        $cartRepository,
        private readonly ProductRepository     $productRepository,
        private readonly OrderRepository       $orderRepository,
        private readonly OrderStatusRepository $orderStatusRepository
    )
    {

    }

    /**
     * @throws InvalidUuidException
     */
    public function __invoke(Cart $cart): ?array
    {

        $cartUuid = new CartUuid($cart->getCartUuid());
        $checkout = $this->cartRepository->checkout($cartUuid);

        if (!$checkout) {
            return null;
        }

        $status = $this->orderStatusRepository->searchByName(OrderStatusEnum::PENDING);

        // Create order with the cart data
        $order = new Order();
        $order->setOrderUuid(Uuid::random());
        $order->setCartId($cart->getCartId());
        $order->setStatusId($status->getStatusId());
        $this->orderRepository->save($order);


        $products = [];
        foreach (json_decode($cart->getProducts()) as $product) {

            $quantity = $product->quantity;

            $products[] = [
                'product_uuid' => $product->product_uuid,
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
            ];


            $dbProduct = $this->productRepository->search(new ProductUuid($product->product_uuid));

            if (null === $dbProduct) {
                return null;
            }

            $dbProduct->setStock($dbProduct->getStock() - $quantity);
            $this->productRepository->save($dbProduct);
        }


        return [
            'order_id' => $order->getOrderUuid(),
            'cart_id' => $cart->getCartUuid(),
            'products' => json_encode($products),
            'amount' => $cart->getAmount(),
            'status' => OrderStatusEnum::PENDING,
        ];
    }
}
