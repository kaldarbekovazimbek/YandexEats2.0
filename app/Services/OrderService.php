<?php

namespace App\Services;

use App\DTO\Order\UpdateOrderDTO;
use App\Exceptions\CartException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\DeliveryDetailsRequest;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\DeliveryDetail;
use App\Notifications\OrderDeliveredNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrderService
{
    private IOrderRepository $orderRepository;

    /**
     * @param IOrderRepository $orderRepository
     */
    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getUserOrders()
    {
        return $this->orderRepository->getUserOrders();
    }

    /**
     * @throws CartException
     */
    public function placeOrder(DeliveryDetailsRequest $request): Order
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
        $deliveryDetail = new DeliveryDetail();
        $deliveryDetail->order_id = $order->id;
        $deliveryDetail->delivery_address = $request['delivery_address'];
        $deliveryDetail->save();

        Cache::forget($cartKey);
        sleep(5);
        return $order;
    }

    /**
     * @throws NotFoundException
     */
    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order
    {
        $order = $this->orderRepository->getOrderById($orderId);
        if ($order === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        $order = $this->orderRepository->update($orderId, $updateOrderDTO);
        if ($order->status === 'delivered') {

            $deliveryDetail = $order->deliveryDetail;

            if ($deliveryDetail) {

                $deliveryDetail->delivered_at = Carbon::now();
                $deliveryDetail->save();
            }
            if ($order->status === 'delivered') {

                $order->user->notify(new OrderDeliveredNotification($order));

            }
        }
        return $order;
    }

    /**
     * @throws NotFoundException
     */
    public function getById(int $orderId): Order
    {
        $order = $this->orderRepository->getOrderById($orderId);

        if ($order === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $order;
    }

    public function getRestaurantOrders()
    {
        return $this->orderRepository->getRestaurantOrders();
    }


}
