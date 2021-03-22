<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class positionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'id'=> 1,
            'name' => 'SUPERVISOR'
        ]);
        DB::table('positions')->insert([
            'id' => 2,
            'name' => 'OPERADOR'
        ]);
        DB::table('positions')->insert([
            'id' => 3,
            'name' => 'SIN ASIGNAR'
        ]);
    }
}
