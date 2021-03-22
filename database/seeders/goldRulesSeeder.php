<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class goldRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gold_rules')->insert([
            'id'=> 1,
            'rule_name' => 'No',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 2,
            'rule_name' => 'Realizar actividades de alto riesgo solo si se cuenta con la capacitación y adiestramiento, así como la autorización por escrito.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 3,
            'rule_name' => 'Intervenir maquinaria / equipo con fuentes de energía peligrosas aplicando SAM o LOTO.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 4,
            'rule_name' => 'Manipular maquinaria o equipo solo si se cuenta con la capacitación y adiestramiento.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 5,
            'rule_name' => 'Manipular sustancias químicas peligrosas, sólo si se cuenta con la capacitación y siguiendo el procedimiento establecido como seguro.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 6,
            'rule_name' => 'No convivencia entre vehículo y peatón en procesos de carga y descarga.',
        ]);
    }
}
