<?php

declare(strict_types=1);


namespace App\Http\Controllers\API\User\Orders;

use App\Http\Controllers\API\AbstractBaseController;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

final class AddToCartController extends AbstractBaseController
{
    private OrderRepositoryInterface $orderRepository;

    private ProductRepositoryInterface $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    ){
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'productId' => ['required', 'string'],
                'orderId' => ['required', 'string'],
            ]);
        } catch (Throwable $throwable) {
            return $this->sendError( $throwable->getMessage(), [
                $throwable,
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = $this->orderRepository->findById($validatedData['orderId']);

        if ($order === null) {
            return $this->sendError('Order not found', [], Response::HTTP_BAD_REQUEST);
        }

        $productId = $validatedData['productId'];

        $product = $this->productRepository->findById($productId);

        if ($product === null) {
            return $this->sendError('Product not found', [], Response::HTTP_BAD_REQUEST);
        }

        $order->products()->attach($product->getId());
        $order->save();

        return  $this->sendResponse($order->load('products'), [], Response::HTTP_BAD_REQUEST);
    }
}
