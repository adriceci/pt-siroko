<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Order;

use Siroko\Domain\Order\Order;
use Siroko\Domain\Order\OrderRepository;

final class MySQLOrderRepository implements OrderRepository
{

    public function save(Order $order): bool
    {
        return $order->save();
    }

    public function search(): ?Order
    {
        // TODO: Implement search() method.
    }

}

