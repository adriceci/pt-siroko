<?php

namespace Siroko\Domain\Cart;

use Database\Factories\CartFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Siroko\Domain\User\UserId;
use Siroko\Shared\Uuid;

final class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = ['cart_uuid', 'user_id', 'products', 'amount', 'ordered', 'created_at', 'updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'carts';
    }

    protected static function newFactory(): CartFactory
    {
        return CartFactory::new();
    }

    // Setters

    public function setUserId(UserId $userId): void
    {
        $this->user_id = $userId->value;
    }

    public function setUuid(): void
    {
        $this->cart_uuid = Uuid::random()->value();
    }

    public function setProducts(array $products): void
    {
        $this->products = json_encode($products);
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function setOrdered(bool $ordered): void
    {
        $this->ordered = $ordered;
    }

    // Getters
    public function getCartId(): int
    {
        return $this->cart_id;
    }

    public function getCartUuid(): string
    {
        return $this->cart_uuid;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getProducts(): string
    {
        return $this->products;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function isOrdered(): bool
    {
        return $this->ordered ?? false;
    }

}
