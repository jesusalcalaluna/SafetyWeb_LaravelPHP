<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class conditionGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('condition_groups')->insert([
            'id'=>1,
            'group_name'=>'Pasillos – Pisos'
        ]);

        DB::table('condition_groups')->insert([
            'id'=>2,
            'group_name'=>'Equipos – Herramientas'
        ]);

        DB::table('condition_groups')->insert([
            'id'=>3,
            'group_name'=>'Manipulación de materiales'
        ]);

        DB::table('condition_groups')->insert([
            'id'=>4,
            'group_name'=>'Infraestructura'
        ]);

        DB::table('condition_groups')->insert([
            'id'=>5,
            'group_name'=>'Vehículos'
        ]);
    }
}
