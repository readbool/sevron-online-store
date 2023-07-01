<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Product;

use App\Services\Product\Interfaces\ProductFactoryInterface;
use App\Services\Product\Resources\ProductResource;
use Tests\TestCase;

/**
 * @covers \App\Services\Product\ProductFactory
 */
final class ProductFactoryTest extends TestCase
{
    public function testMake(): void
    {
        /** @var \App\Services\Product\ProductFactory $factory */
        $factory = $this->app->get(ProductFactoryInterface::class);

        $resource = new ProductResource();
        $resource->setName('Product 0001');
        $resource->setDetail('Test product detail');
        $resource->setSku(fake()->uuid());
        $resource->setPrice((string) fake()->numberBetween(10, 100));

        $product = $factory->make($resource);

        $this->assertDatabaseHas('products', ['id' => $product->getId()]);
    }
}
