<?php

namespace Siroko\Domain\Cart;

use Database\Factories\CartFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = ['cart_uuid', 'user_id', 'product_id', 'quantity', 'amount', 'created_at', 'updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'carts';
    }

    protected static function newFactory(): CartFactory
    {
        return CartFactory::new();
    }
}
