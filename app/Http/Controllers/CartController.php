<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;

use App\Services\CartService;
use Illuminate\Http\JsonResponse;


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
        return $this->cartService->addToCart($request);
    }
}
