<?php

declare(strict_types=1);


namespace App\Services\Order;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Resources\Order\CreateOrderResource as RepoCreateOrderResource;
use App\Services\Order\Interfaces\OrderFactoryInterface;
use App\Services\Order\Resources\CreateOrderResource;
use Illuminate\Support\Str;
use RuntimeException;

final class OrderFactory implements OrderFactoryInterface
{
    private OrderRepositoryInterface $orderRepository;

    private ProductRepository $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepository $productRepository
    ){
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function make(CreateOrderResource $resource): Order
    {
        $productIds = $resource->getProductIds();

        $products = $this->getProducts($productIds);

        $createResource = new RepoCreateOrderResource();
        $createResource->setUser($resource->getUser());
        $createResource->setQuantity($resource->getQuantity());
        $createResource->setTotal($resource->getTotal());
        $createResource->setNumber(Str::uuid()->toString());
        $createResource->setStatus(OrderStatusEnum::DRAFT);

        $createdOrder = $this->orderRepository->createOrder($createResource);

        $createdOrder->products()->attach($products);
        $createdOrder->save();

        return $createdOrder->load('products');
    }

    private function getProducts(array $productIds): array
    {
        $foundProducts = $this->productRepository->findByIds($productIds);

        $foundIds = [];

        /** @var \App\Models\Product $product */
        foreach ($foundProducts as $product) {
            $foundIds[] = $product->getId();
        }

        if (\count($productIds) !== \count($foundIds)) {
            throw new RuntimeException('Invalid Product Id/s given.');
        }

        return $foundIds;
    }
}
