<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dangerousConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dangerous_conditions')->insert([
            'associated_danger'=>'Electricidad Estatica y Atmosferica',
            'description'=> 'Contacto con corriente electrica (Electrocucion)',
            'danger_id'=>1
        ]);
        DB::table('dangerous_conditions')->insert([
            'associated_danger'=>'Corriente Electrica',
            'description'=> 'Contacto con corriente electrica (Electrocucion)',
            'danger_id'=>1
        ]);
        DB::table('dangerous_conditions')->insert([
            'associated_danger'=>'Electricidad Residual',
            'description'=> 'Contacto con corriente electrica residual (Electrocucion)',
            'danger_id'=>1
        ]);

        //-----------------------------------
    }
}
