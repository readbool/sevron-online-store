<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Resources\Products\CreateProductResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function create(CreateProductResource $resource): Product
    {
        $newProduct = new Product();
        $newProduct->setAttribute('name', $resource->getName());
        $newProduct->setAttribute('detail', $resource->getDetail());
        $newProduct->setAttribute('sku', $resource->getSku());
        $newProduct->setAttribute('price', $resource->getPrice());
        $newProduct->save();

        return $newProduct;
    }

    public function findById(string $id): ?Product
    {
        /** @var \App\Models\Product|null $result */
        $result = $this->getQuery()->where('id', '=', $id)->first();

        return $result;
    }

    public function findByIds(array $productIDs): Collection
    {
        return $this->getQuery()->whereIn('id', $productIDs)->get();
    }

    public function getAllProducts(): LengthAwarePaginator
    {
        $products = $this->getQuery()->select('*')->get();

        return new LengthAwarePaginator($products, $products->count(), 15);
    }
}
