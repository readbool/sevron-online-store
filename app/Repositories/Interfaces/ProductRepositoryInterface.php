<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Product;
use App\Repositories\Resources\Products\CreateProductResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function create(CreateProductResource $resource): Product;

    public function findById(string $id): ?Product;

    public function findByIds(array $productIDs): Collection;

    public function getAllProducts(): LengthAwarePaginator;
}
