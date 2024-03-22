<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\CartRequest;
use App\Models\Dish;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    /**
     * @throws NotFoundException
     */
    public function show(int $userId)
    {
        $userCart = Cache::get('user-cart:' . $userId);
        if ($userCart === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $userCart;

    }

    public function addToCart(CartRequest $request, int $userId): JsonResponse
    {
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

            // Вычисляем стоимость для текущего блюда и добавляем её к общей цене
            $totalPrice += $dish->price * $item['quantity'];

            // Сохраняем информацию о добавленном блюде в массив
            $addedDishes[] = [
                'dish_id' => $item['dish_id'],
                'quantity' => $item['quantity']
            ];
        }

        // Создаем массив с общей ценой, информацией о добавленных блюдах и restaurant_id
        $cartData = [
            'restaurant_id' => $restaurantId,
            'total_price' => $totalPrice,
            'added_dishes' => $addedDishes
        ];

        // Добавляем общую цену, информацию о добавленных блюдах и restaurant_id в кеш
        $cartKey = 'user-cart:' . $userId;
        Cache::put($cartKey, $cartData, 60 * 5);

        return response()->json([
            'added_dishes' => $addedDishes,
            'total_price' => $totalPrice
        ]);
    }
}
