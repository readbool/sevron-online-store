<?php

declare(strict_types=1);


namespace Tests\Unit\Services\Order;

use App\Models\User;
use App\Services\Order\Interfaces\OrderFactoryInterface;
use App\Services\Order\Resources\CreateOrderResource;
use Tests\TestCase;

/**
 * @covers \App\Services\Order\OrderFactory
 */
final class OrderFactoryTest extends TestCase
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function testMake(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        /** @var \App\Services\Order\OrderFactory $factory */
        $factory = $this->app->get(OrderFactoryInterface::class);

        $resource = new CreateOrderResource();
        $resource->setTotal('10');
        $resource->setQuantity('10');
        $resource->setUser($user);

        $order = $factory->make($resource);

        self::assertEquals($user->getId(), $order->getUser()->getId());
    }
}
