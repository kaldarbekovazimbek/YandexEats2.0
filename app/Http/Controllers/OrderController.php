<?php

namespace App\Http\Controllers;

use App\DTO\Order\UpdateOrderDTO;
use App\Exceptions\CartException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\DeliveryDetailsRequest;
use App\Http\Requests\OrderCangeStatusRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function getUserOrders(): AnonymousResourceCollection
    {
        $orders = $this->orderService->getUserOrders();
        return OrdersResource::collection($orders);
    }

    /**
     * @throws CartException
     */
    public function store(DeliveryDetailsRequest $request): JsonResponse
    {
        $order = $this->orderService->placeOrder($request);

        return response()->json([
            'message' => __('messages.order_placed'),
            'order_id' => $order->id
        ]);
    }

    /**
     * @throws NotFoundException
     */
    public function changeStatus(int $orderId, OrderCangeStatusRequest $request): OrdersResource
    {
        $validData = $request->validated();
        $order = $this->orderService->update($orderId, UpdateOrderDTO::fromArray($validData));

        return new OrdersResource($order);
    }

    /**
     * @throws NotFoundException
     */
    public function show(int $orderId): OrderResource
    {
        $order = $this->orderService->getById($orderId);

        return new OrderResource($order);
    }

    public function getRestaurantOrders(): OrderCollection
    {
        $orders = $this->orderService->getRestaurantOrders();

        return new OrderCollection($orders);
    }

}
