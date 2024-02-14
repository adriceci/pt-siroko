<?php

namespace Siroko\Domain\Order;

use Database\Factories\OrderStatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';
    protected $primaryKey = 'status_id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = ['name', 'description', 'created_at', 'updated_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'order_statuses';
    }

    protected static function newFactory(): OrderStatusFactory
    {
        return OrderStatusFactory::new();
    }

    // Getters

    public function getStatusId(): int
    {
        return $this->status_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    // Setters

    public function setStatusId(int $statusId): void
    {
        $this->status_id = $statusId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
