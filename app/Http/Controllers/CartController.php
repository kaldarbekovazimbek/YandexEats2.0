<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\CartRequest;
use App\Models\Dish;
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

    /**
     * @throws NotFoundException
     */
    public function addToCart(CartRequest $request, int $userId): bool
    {
        $validData = $request->validated();
        $dish = Dish::query()->find($validData['dish_id']);

        if (!$dish) {
            if ($dish === null) {
                throw new NotFoundException(__('messages.object_not_found'), 404);
            }
            return false;
        }

        $price = $dish->price;
        $quantity = $validData['quantity'];
        $total_price = $price * $quantity;
        $validData['total_price'] = $total_price;

        Cache::put('user-cart:' . $userId, $validData, 60 * 5);

        return true;
    }
}
