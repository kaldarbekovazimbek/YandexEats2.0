<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\CartRequest;
use App\Models\Dish;

use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService)
    {
    }

    public function show()
    {
        return $this->cartService->showCart();
    }

    public function addToCart(CartRequest $request): JsonResponse
    {
        $userId = Auth::user()->id;
        $validData = $request->validated();
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

        $cartData = [
            'restaurant_id' => $restaurantId,
            'total_price' => $totalPrice,
            'added_dishes' => $addedDishes
        ];

        $cartKey = 'user-cart:' . $userId;
        Cache::put($cartKey, $cartData, 60 * 5);

        return response()->json([
            'added_dishes' => $addedDishes,
            'total_price' => $totalPrice
        ]);
    }
}
