<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DeliveryDetail;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\RestaurantWorker;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory(1000)->create();
//        Restaurant::factory(500)->create();
//        RestaurantWorker::factory(1000)->create();
//        Dish::factory(1000)->create();
        Order::factory(1000)->create();
        OrderItem::factory(1000)->create();
        DeliveryDetail::factory(1000)->create();
    }
}
