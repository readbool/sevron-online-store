<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Admin\Product;

use App\Http\Controllers\API\AbstractBaseController;
use App\Services\Product\Interfaces\ProductFactoryInterface;
use App\Services\Product\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

final class UpdateProductController extends AbstractBaseController
{
    private ProductFactoryInterface $productFactory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function __invoke(Request $request, string $productId): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'detail' => ['required' , 'string', 'max:255'],
            'sku' => ['required' , 'string', 'max:255'],
            'price'=> ['required' , 'string', 'max:255'],
        ]);

        $resource = new ProductResource();
        $resource->setId($productId);
        $resource->setName($validatedData['name']);
        $resource->setDetail($validatedData['detail']);
        $resource->setSku($validatedData['sku']);
        $resource->setPrice($validatedData['price']);

        try {
            $result = $this->productFactory->updateProduct($resource);
        } catch (Throwable $throwable) {
            return $this->sendResponse([], $throwable->getMessage());
        }

        return $this->sendResponse($result, 'Updated');
    }
}

