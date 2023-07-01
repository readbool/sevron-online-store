<?php

declare(strict_types=1);

namespace App\Services\Order\Resources;

use App\Models\User;

final class CreateOrderResource
{
    private array $productIds = [];
    private User|null $user = null;
    private ?string $total = null;
    private ?string $quantity = null;

    public function getProductIds(): array
    {
        return $this->productIds;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setProductIds(array $productIds): void
    {
        $this->productIds = $productIds;
    }

    public function setQuantity(?string $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setTotal(?string $total): void
    {
        $this->total = $total;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }
}
