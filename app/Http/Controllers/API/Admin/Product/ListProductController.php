<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Admin\Product;

use App\Http\Controllers\API\AbstractBaseController;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

final class ListProductController extends AbstractBaseController
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(): JsonResponse
    {
        $result = $this->productRepository->getAllProducts();

        return $this->sendResponse($result, 'List of Products');
    }
}
