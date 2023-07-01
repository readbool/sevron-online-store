<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Resources\Order\CreateOrderResource;
use App\Repositories\Resources\Order\UpdateOrderResource;
use Illuminate\Support\Collection;

final class OrderRepository extends AbstractRepository implements OrderRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Order());
    }

    public function createOrder(CreateOrderResource $resource): Order
    {
        $order = new Order();
        $order->setStatus($resource->getStatus()->value);
        $order->setQuantity($resource->getQuantity());
        $order->setNumber($resource->getNumber());
        $order->user()->associate($resource->getUser());
        $order->setTotal($resource->getTotal());

        $order->save();

        return $order;
    }

    public function deleteOrder(Order $order): void
    {
        // TODO: Implement deleteOrder() method.
    }

    public function findById(string $id): ?Order
    {
        /** @var \App\Models\Order $order */
        $order = $this->getQuery()->where('id', '=', $id)->first();

        return $order;
    }

    public function getOrders(): Collection
    {
        return $this->getQuery()->get();
    }

    public function updateOrder(UpdateOrderResource $resource): Order
    {
        // TODO: Implement updateOrder() method.
    }
}
