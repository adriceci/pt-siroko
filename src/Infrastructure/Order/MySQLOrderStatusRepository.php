<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\Order;

use Siroko\Domain\Order\OrderStatus;
use Siroko\Domain\Order\OrderStatusRepository;

final class MySQLOrderStatusRepository implements OrderStatusRepository
{

    public function save(): bool
    {
        // TODO: Implement save() method.
    }

    public function searchByName(string $statusName): ?OrderStatus
    {
        return OrderStatus::where('name', $statusName)->firstOrFail();
    }

}

