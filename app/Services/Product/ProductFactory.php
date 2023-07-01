<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Resources\Products\CreateProductResource;
use App\Services\Product\Interfaces\ProductFactoryInterface;
use App\Services\Product\Resources\ProductResource;
use Exception;

final class ProductFactory implements ProductFactoryInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function make(ProductResource $resource): Product
    {
        $createResource = new CreateProductResource();
        $createResource->setName($resource->getName());
        $createResource->setDetail($resource->getDetail());
        $createResource->setPrice($resource->getPrice());
        $createResource->setSku($resource->getSku());

        return $this->productRepository->create($createResource);
    }

    /**
     * @throws \Exception
     */
    public function updateProduct(ProductResource $resource): Product
    {
        $product = $this->productRepository->findById($resource->getId());

        if ($product instanceof Product === false) {
            throw new Exception('Product not found.');
        }

        $product->setPrice($resource->getPrice());
        $product->setName($resource->getName());
        $product->setDetail($resource->getDetail());
        $product->setSKU($resource->getSku());

        $product->save();

        return $product->refresh();
    }
}
