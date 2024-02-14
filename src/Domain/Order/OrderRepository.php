<?php

declare(strict_types=1);

namespace Siroko\Domain\Order;

interface OrderRepository
{
    public function save(Order $order): bool;

    public function search(): ?Order;
}
