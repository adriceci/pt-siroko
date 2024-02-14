<?php

declare(strict_types=1);

namespace Siroko\Domain\Order;

interface OrderStatusRepository
{
    public function save(): bool;

    public function searchByName(string $statusName): ?OrderStatus;
}
