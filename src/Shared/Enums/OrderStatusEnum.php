<?php

namespace Siroko\Shared\Enums;

class OrderStatusEnum
{
    public const PENDING = 'PENDING';
    public const CONFIRMED = 'CONFIRMED';
    public const CANCELLED = 'CANCELLED';
    public const DELIVERED = 'DELIVERED';
    public const RETURNED = 'RETURNED';
    public const REFUNDED = 'REFUNDED';
    public const FAILED = 'FAILED';
}
