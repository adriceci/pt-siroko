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

    // Getters

    public function getProductId(): int
    {
        return $this->getAttribute('product_id');
    }

    public function getProductUuid(): string
    {
        return $this->getAttribute('product_uuid');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }

    public function getPrice(): float
    {
        return $this->getAttribute('price') . ' €';
    }

    public function getStock(): int
    {
        return $this->getAttribute('stock');
    }

    public function getStatus(): string
    {
        return $this->getAttribute('status');
    }

    public function getImage(): string
    {
        return $this->getAttribute('image');
    }

    public function getImageAlt(): string
    {
        return $this->getAttribute('image_alt');
    }

    // Setters

    public function setProductUuid(string $productUuid): void
    {
        $this->setAttribute('product_uuid', $productUuid);
    }

    public function setName(string $name): void
    {
        $this->setAttribute('name', $name);
    }

    public function setDescription(string $description): void
    {
        $this->setAttribute('description', $description);
    }

    public function setPrice(float $price): void
    {
        $this->setAttribute('price', $price);
    }

    public function setStock(int $stock): void
    {
        $this->setAttribute('stock', $stock);
    }

    public function setStatus(string $status): void
    {
        $this->setAttribute('status', $status);
    }

    public function setImage(string $image): void
    {
        $this->setAttribute('image', $image);
    }

    public function setImageAlt(string $imageAlt): void
    {
        $this->setAttribute('image_alt', $imageAlt);
    }
}
