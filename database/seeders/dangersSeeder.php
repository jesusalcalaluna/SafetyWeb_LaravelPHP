<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dangersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dangers')->insert([
            'id'=>1,
            'danger_name'=>'Peligros físicos'
        ]);
        DB::table('dangers')->insert([
            'id'=>2,
            'danger_name'=>'Peligros Químicos'
        ]);
        DB::table('dangers')->insert([
            'id'=>3,
            'danger_name'=>'Peligros Biológicos'
        ]);
        DB::table('dangers')->insert([
            'id'=>4,
            'danger_name'=>'Peligros Sanitarios'
        ]);
        DB::table('dangers')->insert([
            'id'=>5,
            'danger_name'=>'Peligros Ergonomicos'
        ]);
    }
}
