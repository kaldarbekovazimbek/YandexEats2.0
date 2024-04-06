<?php

namespace App\Repositories;

use App\Http\Requests\CartRequest;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CartRepository
{
    public function showCart()
    {
        $usersId = Auth::user()->id;
        return Cache::get('user-cart:' . $usersId);
    }


}
