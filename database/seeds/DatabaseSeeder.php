<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //\Database\Seeders\ColorSeeder::class
            \Database\Seeders\CartStatusSeeder::class,
            \Database\Seeders\OrderStatusSeeder::class
        ]);
    }
}
