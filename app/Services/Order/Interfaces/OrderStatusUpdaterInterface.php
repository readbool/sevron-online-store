<?php

declare(strict_types=1);

namespace App\Services\Order\Interfaces;

use App\Enums\OrderStatusEnum;
use App\Models\Order;

interface OrderStatusUpdaterInterface
{
    public function updateStatus(Order $order, OrderStatusEnum $orderStatusEnum): Order;
}
