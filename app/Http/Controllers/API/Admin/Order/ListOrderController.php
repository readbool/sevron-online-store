<?php

declare(strict_types=1);


namespace App\Http\Controllers\API\Admin\Order;

use App\Http\Controllers\API\AbstractBaseController;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

final class ListOrderController extends AbstractBaseController
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(): JsonResponse
    {
        $result = $this->orderRepository->getOrders();

        $paginator = new LengthAwarePaginator($result, $result->count(), 15);

        return $this->sendResponse($paginator, 'Ok');
    }
}
