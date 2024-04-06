<?php

namespace App\Services;

use App\Http\Requests\CartRequest;
use App\Models\Dish;
use App\Repositories\CartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CartService
{
    public function __construct(protected CartRepository $cartRepository)
    {
    }

    public function showCart()
    {
        $cart = $this->cartRepository->showCart();
        if ($cart === null){
            return response()->json([
                'message'=>__('messages.cart_empty')
            ]);
        }
        return $cart;
    }
    public function addToCart(CartRequest $request): JsonResponse
    {
        $userId = Auth::user()->id;
        $validData = $request->validated();
        $cartData = $this->prepareCartData($validData);

        $cartKey = 'user-cart:' . $userId;
        Cache::put($cartKey, $cartData, 60 * 5);

        return response()->json([
            'added_dishes' => $cartData['added_dishes'],
            'total_price' => $cartData['total_price']
        ]);
    }

    private function prepareCartData(array $validData): JsonResponse|array
    {
        $totalPrice = 0;
        $addedDishes = [];
        $restaurantId = $validData['restaurant_id'];

        foreach ($validData['dishes'] as $item) {
            $dish = Dish::query()->find($item['dish_id']);

            if (!$dish) {
                return response()->json([
                    'error' => 'Dish with ID ' . $item['dish_id'] . ' not found.'
                ], 404);
            }

            $totalPrice += $dish->price * $item['quantity'];

            $addedDishes[] = [
                'dish_id' => $item['dish_id'],
                'quantity' => $item['quantity']
            ];
        }

        return [
            'restaurant_id' => $restaurantId,
            'total_price' => $totalPrice,
            'added_dishes' => $addedDishes
        ];
    }
}
