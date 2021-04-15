<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class superUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
            'id'=> 1,
            'sap' => '000000',
            'position' => 'SISTEMAS SEGURIDAD INDUSTRIAL',
            'name' => 'JESUS ALCALA LUNA',
            'companie_and_department_id'=> 13
        ]);
        DB::table('users')->insert([
            'id'=> 1,
            'email' => 'jesusalcalaluna@gmail.com',
            'password' => '$2y$10$m64TJd33oZ1ARTPz5ShvOuBDvy.ZdrmJCBe12oE0ktsugmCMicLVG',//superPass123
            'people_id'=> 1,
            'role_id'=> 1,
        ]);
    }
}
