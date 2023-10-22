<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'name' => 'Negro'
        ]);
        DB::table('colors')->insert([
            'name' => 'Rojo'
        ]);
        DB::table('colors')->insert([
            'name' => 'Gris'
        ]);
        DB::table('colors')->insert([
            'name' => 'Plateado'
        ]);
        DB::table('colors')->insert([
            'name' => 'Blanco'
        ]);
        DB::table('colors')->insert([
            'name' => 'Verde'
        ]);
        DB::table('colors')->insert([
            'name' => 'Azul'
        ]);
        DB::table('colors')->insert([
            'name' => 'Amarillo'
        ]);
        DB::table('colors')->insert([
            'name' => 'Café'
        ]);
        DB::table('colors')->insert([
            'name' => 'Otro'
        ]);
    }
}
