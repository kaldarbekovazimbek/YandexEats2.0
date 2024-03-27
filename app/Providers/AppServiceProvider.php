<?php

namespace App\Providers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Interfaces\IDishRepository;
use App\Interfaces\IOrderRepository;
use App\Interfaces\IRestaurantRepository;
use App\Interfaces\IWorkerRepository;
use App\Interfaces\IUserRepository;
use App\Models\RestaurantWorker;
use App\Models\User;
use App\Repositories\DishRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\WorkerRepository;
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
        $this->app->bind(IWorkerRepository::class, WorkerRepository::class);
        $this->app->bind(IDishRepository::class, DishRepository::class);
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
