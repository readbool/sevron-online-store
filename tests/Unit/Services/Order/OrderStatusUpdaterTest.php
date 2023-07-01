<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Order;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Services\Order\OrderStatusUpdater;
use Tests\TestCase;

/**
 * @covers \App\Services\Order\OrderStatusUpdater
 */
final class OrderStatusUpdaterTest extends TestCase
{
    public function testUpdateStatus(): void
    {
        $order = new Order([
            'number' => fake()->uuid(),
            'total' => fake()->numberBetween(1, 100),
            'quantity' => fake()->numberBetween(1, 10),
            'status' => fake()->randomElement([
                OrderStatusEnum::CANCELLED->value,
                OrderStatusEnum::DRAFT->value,
                OrderStatusEnum::SHIPPED->value,
            ]),
            'user_id' => 1,
        ]);

        $updater = new OrderStatusUpdater();
        $updater->updateStatus($order,OrderStatusEnum::PAID);
        $order->refresh();

        self::assertEquals(OrderStatusEnum::PAID->value, $order->getStatus());
    }
}
