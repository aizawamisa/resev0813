<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PrefecturesTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
    }
}
