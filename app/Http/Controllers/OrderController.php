<?php

namespace App\Http\Controllers;

use App\DTO\Order\UpdateOrderDTO;
use App\Exceptions\CartException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\OrderCangeStatusRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
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
    public function store(): JsonResponse
    {
        $userId = Auth::user()->id;
        $cartKey = 'user-cart:' . $userId;
        $cartData = Cache::get($cartKey);

        if (!$cartData) {
            throw new CartException(__('messages.cart_is_empty'), 404);
        }

        $restaurantId = $cartData['restaurant_id'];

        $order = new Order();
        $order->total_price = $cartData['total_price'];
        $order->user_id = $userId;
        $order->restaurant_id = $restaurantId;
        $order->save();

        foreach ($cartData['added_dishes'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->dish_id = $item['dish_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->save();
        }

        Cache::forget($cartKey);
        sleep(5);
        return response()->json([
            'message' => __('messages.order_placed'),
            'order_id' => $order->id
        ]);
    }

    /**
     * @throws NotFoundException
     */
    public function update(int $orderId, OrderCangeStatusRequest $request): OrdersResource
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
