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
            'role_name' => 'ADMINISTRADOR',
            'hierarchy' => 1
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role_name' => 'SUPERVISOR',
            'hierarchy' => 2
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'role_name' => 'COMUN',
            'hierarchy' => 3
        ]);
        DB::table('roles')->insert([
            'id'=> 4,
            'role_name' => 'SUPERUSUARIO',
            'hierarchy' => 0
        ]);
    }
}
