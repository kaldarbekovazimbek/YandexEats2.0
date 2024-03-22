<?php

namespace App\Http\Controllers;

use App\Exceptions\CartException;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    /**
     * @throws CartException
     */
    public function checkout(int $userId): JsonResponse
    {
        $cartKey = 'user-cart:' . $userId;
        $cartData = Cache::get($cartKey);

        if (!$cartData) {
            throw new CartException(__( 'messages.cart_is_empty'), 404);
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

        return response()->json([
            'message'=>__('messages.order_placed'),
            'order_id' => $order->id
        ]);
    }


}
