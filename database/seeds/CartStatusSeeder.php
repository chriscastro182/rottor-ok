<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cart_status')->insert([
            'name' => 'Created'
        ]);
        DB::table('cart_status')->insert([
            'name' => 'Processing'
        ]);
        DB::table('cart_status')->insert([
            'name' => 'Completed'
        ]);
        DB::table('cart_status')->insert([
            'name' => 'Abandoned'
        ]);
    }
}
