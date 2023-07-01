<?php

declare(strict_types=1);

namespace App\Services\Order\Interfaces;

use App\Models\Order;
use App\Services\Order\Resources\CreateOrderResource;

interface OrderFactoryInterface
{
    public function make(CreateOrderResource $resource): Order;
}
