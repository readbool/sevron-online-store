<?php

declare(strict_types=1);

namespace App\Services\Order;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Services\Order\Interfaces\OrderStatusUpdaterInterface;

final class OrderStatusUpdater implements OrderStatusUpdaterInterface
{
    public function updateStatus(Order $order, OrderStatusEnum $orderStatusEnum): Order
    {
        $order->setStatus($orderStatusEnum->value);
        $order->save();

        return $order;
    }
}
