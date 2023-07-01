<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User\Orders;

use App\Http\Controllers\API\AbstractBaseController;
use App\Services\Order\Interfaces\OrderFactoryInterface;
use App\Services\Order\Resources\CreateOrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

final class CreateOrderController extends AbstractBaseController
{
    private OrderFactoryInterface $orderFactory;

    public function __construct(OrderFactoryInterface $orderFactory)
    {
        $this->orderFactory = $orderFactory;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'productIds' => ['required', 'array'],
                'total' => ['required', 'numeric'],
                'quantity' => ['required', 'numeric']
            ]);
        } catch (Throwable $throwable) {
            return $this->sendError( $throwable->getMessage(), [
                $throwable
            ], Response::HTTP_BAD_REQUEST);
        }

        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        $resource = new CreateOrderResource();
        $resource->setUser($currentUser);
        $resource->setQuantity((string) $validatedData['quantity']);
        $resource->setTotal((string) $validatedData['total']);
        $resource->setProductIds($validatedData['productIds']);

        $order = $this->orderFactory->make($resource);

        return  $this->sendResponse($order, 'Order created', Response::HTTP_CREATED);
    }
}
