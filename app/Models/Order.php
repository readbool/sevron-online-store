<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

final class Order extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'number',
        'total',
        'quantity',
        'status',
        'user_id'
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getNumber(): string
    {
        return $this->getAttribute('number');
    }

    public function getProducts(): Collection
    {
        return $this->getAttribute('products');
    }

    public function getQuantity(): string
    {
        return $this->getAttribute('quantity');
    }

    public function getStatus(): string
    {
        return $this->getAttribute('status');
    }

    public function getTotal(): string
    {
        return $this->getAttribute('total');
    }

    public function getUser(): User
    {
        return $this->getAttribute('user');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function setNumber(string $number): self
    {
        $this->setAttribute('number', $number);

        return $this;
    }

    public function setQuantity(string $quantity): self
    {
        $this->setAttribute('quantity', $quantity);

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->setAttribute('status', $status);

        return $this;
    }

    public function setTotal(string $total): self
    {
        $this->setAttribute('total', $total);

        return $this;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
