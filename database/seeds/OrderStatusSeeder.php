<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert([
            'name' => 'Created'
        ]);
        DB::table('order_status')->insert([
            'name' => 'Processing'
        ]);
        DB::table('order_status')->insert([
            'name' => 'Completed'
        ]);
        DB::table('order_status')->insert([
            'name' => 'Canceled'
        ]);
    }
}
