<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User\Products;

use App\Http\Controllers\API\AbstractBaseController;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

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

        $paginator = new LengthAwarePaginator($result, $result->count(), 15);

        return $this->sendResponse($paginator, 'List of Products');
    }
}
