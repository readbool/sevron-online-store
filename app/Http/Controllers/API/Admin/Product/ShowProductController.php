<?php

declare(strict_types=1);


namespace App\Http\Controllers\API\Admin\Product;

use App\Http\Controllers\API\AbstractBaseController;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class ShowProductController extends AbstractBaseController
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(string $id): JsonResponse
    {
        $result = $this->productRepository->findById($id);

        if ($result === null) {
            return $this->sendError('NOT FOUND', [], Response::HTTP_BAD_REQUEST);
        }

        return $this->sendResponse($result, 'Success');
    }
}
