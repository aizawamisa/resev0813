<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Shop;

class FavoriteFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => 3,
            'shop_id' => function () {
                return Shop::inRandomOrder()->first()->id;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
