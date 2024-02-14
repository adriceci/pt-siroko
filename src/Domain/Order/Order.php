<?php

namespace Siroko\Domain\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Siroko\Shared\Uuid;

final class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = ['order_uuid', 'cart_id', 'status_id', 'created_at', 'updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'orders';
    }

    // Getters

    public function getOrderUuid(): string
    {
        return $this->order_uuid;
    }

    public function getCartId(): string
    {
        return $this->cart_id;
    }

    public function getStatusId(): int
    {
        return $this->status_id;
    }

    // Setters

    public function setOrderUuid(Uuid $orderUuid): void
    {
        $this->order_uuid = $orderUuid;
    }

    public function setCartId(int $cartId): void
    {
        $this->cart_id = $cartId;
    }

    public function setStatusId(int $statusId): void
    {
        $this->status_id = $statusId;
    }

}
