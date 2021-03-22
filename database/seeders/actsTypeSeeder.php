<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class actsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acts_types')->insert([
            'type_name'=>'No usar EPP / Uso inadecuado del EPP',
            
            'behavior_group_id'=>1
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No usar EPP / Uso inadecuado del EPP para actividades de alto riesgo',
            
            'behavior_group_id'=>1
        ]);

        //--------------------------------------------------
        DB::table('acts_types')->insert([
            'type_name'=>'Correr / No saltar',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No usar tres puntos de apoyo en las escaleras (escaleras verticales)',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Camina alejado del pasamanos en las escaleras de peldaños',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No transitar por senderos peatonales.',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Caminar libre de distracciones de dispositivos electrónicos',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No respetar radio de acción de montacargas (5m de distancia)',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Usar audífonos en zonas de proceso',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No pasar por debajo de los transportadores siempre y cuando estén identificados como seguros',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Sentarse o apoyarse en canastas o equipos',
            
            'behavior_group_id'=>2
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Ingresar a áreas no autorizadas',
            
            'behavior_group_id'=>2
        ]);

        //--------------------------------------------------
        DB::table('acts_types')->insert([
            'type_name'=>'No realiza check de dispositivos de seguridad',
            
            'behavior_group_id'=>3
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No bloquear fuentes de energía peligrosa. Aplicar LOTO.',
            
            'behavior_group_id'=>3
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No emplear dispositivos de seguridad de la máquina',
            
            'behavior_group_id'=>3
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No operar máquinas en forma segura; respetando límites de capacidad, velocidad, entre otros.',
            
            'behavior_group_id'=>3
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No utilizar siempre equipos y herramientas para los fines que fueron diseñados y en condición de operación.',
            
            'behavior_group_id'=>'3'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No verificar que cualquier máquina intervenida vuelve a su condición normal de seguridad',
            
            'behavior_group_id'=>'3'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No mantener operativos los sistemas SAM',
            
            'behavior_group_id'=>'3'
        ]);

        //------------------------------------------------
        DB::table('acts_types')->insert([
            'type_name'=>'No adoptar prácticas de higiene postural durante el manejo manual de cargas',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No cumplir con carga máxima permitida. No exceder carga.',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No hacer uso de ayudas mecánicas para el manejo de cargas.',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Realizar apilamiento de manera inadecuada.',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No manipular adecuadamente las botellas de vidrio.',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No hacer uso correcto de los dispositivos de elevación.',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No hace uso adecuado de los equipos de respuesta a emergencia',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No manipular correctamente sustancias químicas peligrosas.',
            
            'behavior_group_id'=>'4'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No almacena las sustacias químicas peligrosas de acuerdo a tabla de compatibilidad',
            
            'behavior_group_id'=>'4'
        ]);

        //--------------------------------------------------
        DB::table('acts_types')->insert([
            'type_name'=>'No Realizar Check de Montacargas previo uso.',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No hacer uso del cinturón de seguridad.',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Estacionar en zonas o áreas no autorizadas.',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No conducir vehículos automotores en forma segura; sin respetar los límites de capacidad, velocidad, entre otros.',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Uso inadecuado de la bocina (clax ) en giros y puntos ciegos.',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No conducir libre de distracciones de uso de celulares, reproductores de sonido, etc.',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Conducir vehículos que no están en condición de operación .',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No respetar la red zone.',
            
            'behavior_group_id'=>'5'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No respetar la distancia entre peatón y vehículo.',
            
            'behavior_group_id'=>'5'
        ]);

        //---------------------------------------------------
        DB::table('acts_types')->insert([
            'type_name'=>'No respeta el distanciamiento social (mínimo 1,8)',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No desinfecta su puesto de trabajo o vehículo al iniciar la jornada (accesorios y/o dispositivos que entren en contacto con las manos).',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No participa en el protocolo de ingreso a planta para minimizar el riesgo de contagio.',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No usa su cuerpo para abrir las puertas (en caso de puertas abatibles)',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No usa correctamente su tapabocas',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Hace uso de herramientas manuales sin realizar desinfección',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Pasa su mano por la cara',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'Supera la capacidad máxima de ocupantes en sala',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No reporta síntomas',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No desinfecta sus botas al momento de ingresar a las áreas.',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No usa el cabello recogido',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No desinfecta su EPP previo a usarlo',
            
            'behavior_group_id'=>'6'
        ]);
        DB::table('acts_types')->insert([
            'type_name'=>'No realiza el re-cambio de tapabocas cuando es necesario',
            
            'behavior_group_id'=>'6'
        ]);
    }
}
