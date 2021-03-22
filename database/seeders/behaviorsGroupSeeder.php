<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class behaviorsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('behaviors_groups')->insert([
            'id'=>1,
            'group_name'=>'USO ADECUADO DE EPP'
        ]);
        DB::table('behaviors_groups')->insert([
            'id'=>2,
            'group_name'=>'DESPLAZAMIENTO SEGURO'
        ]);
        DB::table('behaviors_groups')->insert([
            'id'=>3,
            'group_name'=>'USO CORRECTO DE EQUIPOS Y HERRAMIENTAS'
        ]);
        DB::table('behaviors_groups')->insert([
            'id'=>4,
            'group_name'=>'MANIPULACÍON ADECUADA DE MATERIALES'
        ]);
        DB::table('behaviors_groups')->insert([
            'id'=>5,
            'group_name'=>'CIRCULACÍON SEGURA DE MONTACARGAS Y VEHÍCULOS'
        ]);
        DB::table('behaviors_groups')->insert([
            'id'=>6,
            'group_name'=>'COVID 19'
        ]);
    }
}
