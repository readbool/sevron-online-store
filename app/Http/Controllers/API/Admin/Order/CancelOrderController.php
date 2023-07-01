<?php

declare(strict_types=1);


namespace App\Http\Controllers\API\Admin\Order;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\API\AbstractBaseController;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\OrderStatusUpdaterInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

final class CancelOrderController extends AbstractBaseController
{
    private OrderRepositoryInterface $orderRepository;

    private OrderStatusUpdaterInterface $orderStatusUpdater;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderStatusUpdaterInterface $orderStatusUpdater
    ){
        $this->orderRepository = $orderRepository;
        $this->orderStatusUpdater = $orderStatusUpdater;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'orderId' => ['required', 'string'],
            ]);
        } catch (Throwable $throwable) {
            return $this->sendError( $throwable->getMessage(), [
                $throwable
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = $this->orderRepository->findById($validatedData['orderId']);

        if ($order instanceof Order === false) {
            return $this->sendError('Order not found', [], Response::HTTP_BAD_REQUEST);
        }

        if ($order->getStatus() === OrderStatusEnum::CANCELLED->value ||
            $order->getStatus() === OrderStatusEnum::SHIPPED->value) {
            return $this->sendError(
                \sprintf('Order already %s', $order->getStatus()),
                [],
                Response::HTTP_BAD_REQUEST
            );
        }

        $updatedOrder = $this->orderStatusUpdater->updateStatus($order, OrderStatusEnum::CANCELLED);

        return $this->sendResponse($updatedOrder, 'Order cancelled.');
    }
}
