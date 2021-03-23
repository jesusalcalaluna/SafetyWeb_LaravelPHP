<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            'id'=> 1,
            'role_name' => 'ADMINISTRADOR'
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role_name' => 'SUPERVISOR'
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'role_name' => 'COMUN'
        ]);
        
    }
}
