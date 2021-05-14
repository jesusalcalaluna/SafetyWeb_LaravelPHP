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
            'description' => 'No Aplica',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 2,
            'rule_name' => 'SAM & LOTOTO',
            'description' => 'Siempre verificare el aislamiento adecuado de la energía peligrosa, realizando SAM o LOTOTO antes de acceder al equipo y/o trabajar en el equipo activo.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 3,
            'rule_name' => 'PERMISOS DE TRABAJO',
            'description' => 'Siempre Trabajare con los permisos de trabajo validado para tareas de alto riesgo y me asegurare de que todos los miembros de mi equipo de primera línea mitiguen los riesgos aplicando los requisitos del permiso de trabajo.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 4,
            'rule_name' => 'VEHÍCULOS',
            'description' => 'Siempre mantendré la distancia mínima de seguridad entre Vehículos y peatones (5 Metros)',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 5,
            'rule_name' => 'SUSTANCIAS PELIGROSAS',
            'description' => 'Siempre manipulare sustancias peligrosas solo si comprendo los peligros e implemento las medidas de control definidas para mitigar los riesgos. Si cuento con la capacitación y el procedimiento establecido como seguro.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 6,
            'rule_name' => 'TRABAJOS EN ALTURAS',
            'description' => 'Siempre usare todo el equipo adecuado de protección contra caídas cuando realice trabajos en alturas.Manipular sustancias químicas peligrosas, sólo si se cuenta con la capacitación y siguiendo el procedimiento establecido como seguro.',
        ]);
        DB::table('gold_rules')->insert([
            'id'=> 7,
            'rule_name' => 'ELECTRICIDAD',
            'description' => 'Trabajare siempre con electricidad solo si estoy calificado, entiendo los peligros e implemento las medidas de control definidas para mitigar los riesgos.',
        ]);
    }
}
