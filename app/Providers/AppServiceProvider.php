<?php

namespace App\Providers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Interfaces\IOrderRepository;
use App\Interfaces\IRestaurantRepository;
use App\Interfaces\IUserRepository;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IRestaurantRepository::class, RestaurantRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UserResource::withoutWrapping();
        UserCollection::withoutWrapping();
    }
}
