<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class companiesAndDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies_and_departments')->insert([
            'id' => 1,
            'name' => 'AGUAS-AMB',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 2,
            'name' => 'CALIDAD',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 3,
            'name' => 'COCIMIENTOS',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 4,
            'name' => 'CUARTOS FRIOS',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 5,
            'name' => 'ENVASADO LIDERAZGO',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 6,
            'name' => 'FINANZAS',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 7,
            'name' => 'GENTE Y GESTION',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 8,
            'name' => 'GERENCIA',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 9,
            'name' => 'LOGÍSTICA',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 10,
            'name' => 'MTTO GENERAL',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 11,
            'name' => 'PROTECCIÓN PATRIMONIAL',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 12,
            'name' => 'PROYECTOS',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 13,
            'name' => 'SEGURIDAD',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 14,
            'name' => 'SERVICIO Y ENERGIA',
            'origin' => 'INTERNO'
        ]);

        //-----------EXTERNOS
        DB::table('companies_and_departments')->insert([
            'id' => 15,
            'name' => 'BRITE',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 16,
            'name' => 'FEMOSA',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 17,
            'name' => 'SALN',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 18,
            'name' => 'SGM',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 19,
            'name' => 'ECOLAB',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 20,
            'name' => 'NALCO',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 21,
            'name' => 'L&M',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 22,
            'name' => 'MBSA (Montajes Bocanegra)',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 23,
            'name' => 'J. Lopéz',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 24,
            'name' => 'JPAP',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 25,
            'name' => 'R. Quiroz',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 26,
            'name' => 'FUMYCA',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 27,
            'name' => 'kitchen (comedor)',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 28,
            'name' => 'C&H',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 29,
            'name' => 'MATRESA',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 30,
            'name' => 'Practicante',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 31,
            'name' => 'Visita',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 32,
            'name' => 'Proyectos',
            'origin' => 'EXTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 33,
            'name' => 'Transportista',
            'origin' => 'EXTERNO'
        ]);

        // --------INTERNO
        DB::table('companies_and_departments')->insert([
            'id' => 34,
            'name' => 'ENVASADO LÍNEA #1',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 35,
            'name' => 'ENVASADO LÍNEA #2 & 3',
            'origin' => 'INTERNO'
        ]);
        DB::table('companies_and_departments')->insert([
            'id' => 36,
            'name' => 'ENVASADO LÍNEA #4',
            'origin' => 'INTERNO'
        ]);

    }
}
