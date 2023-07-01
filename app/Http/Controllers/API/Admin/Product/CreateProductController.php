<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Admin\Product;

use App\Http\Controllers\API\AbstractBaseController;
use App\Services\Product\Interfaces\ProductFactoryInterface;
use App\Services\Product\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CreateProductController extends AbstractBaseController
{
    private ProductFactoryInterface $productFactory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'detail' => ['required' , 'string', 'max:255'],
            'sku' => ['required' , 'string', 'max:255'],
            'price'=> ['required' , 'string', 'max:255'],
        ]);

        $resource = new ProductResource();
        $resource->setName($validatedData['name']);
        $resource->setDetail($validatedData['detail']);
        $resource->setSku($validatedData['sku']);
        $resource->setPrice($validatedData['price']);

        $result = $this->productFactory->make($resource);

        return $this->sendResponse($result, 'Product Created');
    }
}
