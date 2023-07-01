<?php

declare(strict_types=1);

namespace App\Repositories\Resources\Order;

use App\Enums\OrderStatusEnum;
use App\Models\User;

final class CreateOrderResource
{
    private User|null $user = null;

    private ?string $number = null;

    private ?string $total = null;

    private ?string $quantity = null;

    private ?OrderStatusEnum $status = null;

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function getStatus(): ?OrderStatusEnum
    {
        return $this->status;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function setQuantity(?string $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setStatus(?OrderStatusEnum $status): void
    {
        $this->status = $status;
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
