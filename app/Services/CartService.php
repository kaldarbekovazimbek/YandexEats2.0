<?php

namespace App\Services;

use App\Repositories\CartRepository;
use Illuminate\Http\JsonResponse;
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

}
