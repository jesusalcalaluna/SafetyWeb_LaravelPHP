<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncidentType;

class incidentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncidentType::create([
            'id' => 1,
            'type_name' => 'DESPLAZAMIENTO SEGURO DE PERSONAS | PASILLOS / PISOS',
        ]);
        IncidentType::create([
            'id' => 2,
            'type_name' => 'USO CORRECTO DE EQUIPOS Y HERRAMIENTA | EQUIPO / HERRAMIENTAS',
        ]);

        IncidentType::create([
            'id' => 3,
            'type_name' => 'MANIPULACIÓN ADECUADA DE MATERIALES | MANIPULACIÓN DE MATERIALES',
        ]);
        IncidentType::create([
            'id' => 4,
            'type_name' => 'CIRCULACIÓN SEGURA DE MONTACARGAS VEHÍCULOS | VEHÍCULOS',
        ]);

        IncidentType::create([
            'id' => 5,
            'type_name' => 'INFRAESTRUCTURA',
        ]);
    }
}
