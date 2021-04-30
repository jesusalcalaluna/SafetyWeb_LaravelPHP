<?php

namespace Database\Seeders;

use App\Models\Incident;
use Illuminate\Database\Seeder;

class incidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident::create([
            'incident_name' => 'Tropezar sin caer al piso, sin lesión',
            'incident_type_id' => 1,
        ]);
        Incident::create([
            'incident_name' => 'Resbalarse sin caer al piso, sin lesión',
            'incident_type_id' => 1,
        ]);
        Incident::create([
            'incident_name' => 'Tropezar sin caer de escaleras, sin lesión',
            'incident_type_id' => 1,
        ]);
        Incident::create([
            'incident_name' => 'Resbalarse sin caer de escaleras, sin lesión',
            'incident_type_id' => 1,
        ]);

        Incident::create([
            'incident_name' => 'Golpe contra (objeto) sin lesión ',
            'incident_type_id' => 2,
        ]);
        Incident::create([
            'incident_name' => 'Caída de carga suspendida (actividades de izaje)',
            'incident_type_id' => 2,
        ]);
        Incident::create([
            'incident_name' => 'Atoramiento de herramienta eléctrica ',
            'incident_type_id' => 2,
        ]);
        Incident::create([
            'incident_name' => 'Descarga de electricidad estática  ',
            'incident_type_id' => 2,
        ]);
        Incident::create([
            'incident_name' => 'Corto circuito (<=110 volts)',
            'incident_type_id' => 2,
        ]);
        Incident::create([
            'incident_name' => 'Caída de herramienta (trabajos en alturas)',
            'incident_type_id' => 2,
        ]);

        Incident::create([
            'incident_name' => 'Caída de pallet en Depaletizador (sin montacargas involucrado)',
            'incident_type_id' => 3,
        ]);
        Incident::create([
            'incident_name' => 'Caída de pallet en Paletizador (sin montacargas involucrado)',
            'incident_type_id' => 3,
        ]);
        Incident::create([
            'incident_name' => 'Caída de Pallet mal estibados ',
            'incident_type_id' => 3,
        ]);
        Incident::create([
            'incident_name' => 'Caída de materiales en proceso (Cartón, botellas, charolas)',
            'incident_type_id' => 3,
        ]);
        Incident::create([
            'incident_name' => 'Caída de materiales en proceso (Cartón, botellas, charolas)',
            'incident_type_id' => 3,
        ]);
        Incident::create([
            'incident_name' => 'Derrame de sustancias Químicas peligrosas (fuera de diques de contención)',
            'incident_type_id' => 3,
        ]);
        Incident::create([
            'incident_name' => 'Derrame de líquidos calientes >40°',
            'incident_type_id' => 3,
        ]);

        Incident::create([
            'incident_name' => 'Contacto entre montacargas',
            'incident_type_id' => 4,
        ]);
        Incident::create([
            'incident_name' => 'Contacto entre montacargas e infraestructura',
            'incident_type_id' => 4,
        ]);
        Incident::create([
            'incident_name' => 'Contacto entre vehículo e infraestructura ',
            'incident_type_id' => 4,
        ]);
        Incident::create([
            'incident_name' => 'Caída de materiales durante traslado ',
            'incident_type_id' => 4,
        ]);
        Incident::create([
            'incident_name' => 'Caída de pallet durante traslado',
            'incident_type_id' => 4,
        ]);
        Incident::create([
            'incident_name' => 'Caída de materiales por contacto con montacargas.',
            'incident_type_id' => 4,
        ]);

        Incident::create([
            'incident_name' => 'Caída de Luminarias ',
            'incident_type_id' => 5,
        ]);
        Incident::create([
            'incident_name' => 'Caída de Luminarias ',
            'incident_type_id' => 5,
        ]);
        Incident::create([
            'incident_name' => 'Emisión de Amoniaco (NH3)',
            'incident_type_id' => 5,
        ]);
        Incident::create([
            'incident_name' => 'Emisión de Cloro',
            'incident_type_id' => 5,
        ]);
        Incident::create([
            'incident_name' => 'Fuga de Vapor ',
            'incident_type_id' => 5,
        ]);
        Incident::create([
            'incident_name' => 'Atoramiento con objetos sobresalientes (tornillos, clavos, etc)',
            'incident_type_id' => 5,
        ]);
        Incident::create([
            'incident_name' => 'Conato de incendio',
            'incident_type_id' => 5,
        ]);
    }
}
