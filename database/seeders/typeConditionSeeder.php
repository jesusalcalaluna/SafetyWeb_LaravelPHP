<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class typeConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_conditions')->insert([
            'action_name'=>'Elementos de protección deshabilitados',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Ausencia de elementos de protección (cubierta, delimitación de área, guarda, etc.)',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Elementos de protección dañados',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Superficies húmedas / derrapantes',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Superficie en mal estado',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Superficie irregular',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Indefinición - ausencia de ruta peatonal',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Falta de delimitación de área',
            
            'condition_group_id'=>1
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Ausencia de orden y limpieza',
            
            'condition_group_id'=>1
        ]);


        DB::table('type_conditions')->insert([
            'action_name'=>'Condiciones deficientes en herramientas',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Condiciones deficientes en maquinaria y equipo.',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Elementos de protección dañados (guardas, protectores, etc.)',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Elemento de protección faltante',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Elemento de seguridad no acorde al riesgo',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Dispositivo de seguridad deshabilitado',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Dispositivo de seguridad dañado',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Dispositivo de seguridad faltante',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Dispositivo de seguridad no acorde al riesgo',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Equipos o material no acorde a la actividad',
            
            'condition_group_id'=>2
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Defectos de fabricación (elementos, dispositivos y EPP)',
            
            'condition_group_id'=>2
        ]);


        DB::table('type_conditions')->insert([
            'action_name'=>'Bloqueo de equipo de respuesta a emergencia',
            
            'condition_group_id'=>3
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Ausencia de orden',
            
            'condition_group_id'=>3
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Inestabilidad de estibas',
            
            'condition_group_id'=>3
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Congestión de materiales',
            
            'condition_group_id'=>3
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Exceso de peso y dimensiones',
            
            'condition_group_id'=>3
        ]);


        DB::table('type_conditions')->insert([
            'action_name'=>'Señales y avisos de seguridad nula/deficiente',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Fugas, derrames (agentes contaminantes polvos, humos, neblinas)',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Infraestructura deficiente o en mal estado.',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Iluminación nula/ deficiente',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Bordes filosos o punzo cortantes, salientes',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Infraestructura deficiente para medios de acceso (escaleras, plataformas)',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Infraestructura deficiente en edificios (Paredes, nivel azotea, ventanas)',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Infraestructura deficiente en instalaciones eléctricas (ausencia de resguardo, aislamientos)',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Ausencia de orden y limpieza (Racks, cajones, gavetas, etc.)',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Presencia de fauna nociva',
            
            'condition_group_id'=>4
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Ausencia de elementos para el control de pandemias (Gel, material desinfectante, etc.)',
            
            'condition_group_id'=>4
        ]);


        DB::table('type_conditions')->insert([
            'action_name'=>'Falta de mantenimiento',
            
            'condition_group_id'=>5
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Llantas dañadas/desgastadas',
            
            'condition_group_id'=>5
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Fugas de líquidos (aceite, frenos, transmisión, agua, etc.)',
            
            'condition_group_id'=>5
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Sistema de iluminación nulo/ deficiente',
            
            'condition_group_id'=>5
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Frenos deficientes',
            
            'condition_group_id'=>5
        ]);
        DB::table('type_conditions')->insert([
            'action_name'=>'Daño o ausencia en elementos de seguridad (claxon, cinturón de seguridad, extintor, etc.)',
            
            'condition_group_id'=>5
        ]);
    }
}
