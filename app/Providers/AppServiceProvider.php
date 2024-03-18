<?php

namespace App\Providers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Interfaces\IUserRepository;
use App\Models\User;
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
