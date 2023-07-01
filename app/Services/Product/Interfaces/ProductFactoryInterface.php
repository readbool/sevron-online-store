<?php

declare(strict_types=1);

namespace App\Services\Product\Interfaces;

use App\Models\Product;
use App\Services\Product\Resources\ProductResource;

interface ProductFactoryInterface
{
    public function make(ProductResource $resource): Product;

    public function updateProduct(ProductResource $resource): Product;
}
