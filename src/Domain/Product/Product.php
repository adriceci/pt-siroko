<?php

namespace Siroko\Domain\Product;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = ['product_uuid', 'name', 'description', 'price', 'stock', 'status', 'image', 'image_alt'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'products';
    }

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
