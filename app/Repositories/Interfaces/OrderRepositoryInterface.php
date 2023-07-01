<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Order;
use App\Repositories\Resources\Order\CreateOrderResource;
use App\Repositories\Resources\Order\UpdateOrderResource;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function createOrder(CreateOrderResource $resource): Order;

    public function deleteOrder(Order $order): void;

    public function findById(string $id): ?Order;

    public function getOrders(): Collection;

    public function updateOrder(UpdateOrderResource $resource): Order;
}
