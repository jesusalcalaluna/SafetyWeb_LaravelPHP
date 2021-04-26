<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companion_care_record;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use ArrayObject;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{

    public function getIndex(){
        date_default_timezone_set('America/Monterrey');

        $cantidad_personas_activas = People::where('status', "ACTIVO")->count();

        //COMPAÑEROS CUIDADOS
        //seguros
        $seguros = DB::table('companion_care_records')
        ->whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->where('corr_prev_pos', 'COMPORTAMIENTO SEGURO')->count();
        //inseguros
        $inseguros = DB::table('companion_care_records')
        ->whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->where('corr_prev_pos', 'COMPORTAMIENTO INSEGURO')->count();
        //CONDICIONES INSEGURAS
        //Detectadas
        $detectadas = DB::table('unsafe_conditions_records')
        ->whereYear('unsafe_conditions_records.created_at',date('Y'))
        ->whereMonth('unsafe_conditions_records.created_at',date('m'))
        ->count();
        //Atendidas
        $atendidas = DB::table('unsafe_conditions_records')
        ->whereYear('unsafe_conditions_records.created_at',date('Y'))
        ->whereMonth('unsafe_conditions_records.created_at',date('m'))
        ->where('status', 'COMPLETA')->count();
        //Avance
        $avance = 0;
        if ($detectadas) {
            $avance = number_format(($atendidas/$detectadas)*100 ,0);
        }

        //PARTICIPACION DE DETECCION
        //cuidado del compañero
        $cant_cc = Companion_care_record::whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->select("people_id")
        ->groupBy("people_id")
        ->get()
        ->count();
        $participacion_cc = 0;
        if ($cantidad_personas_activas) {
            $participacion_cc = number_format(($cant_cc/$cantidad_personas_activas)*100 ,1);
        }
        //condiciones inseguras
        $cant_ci = Unsafe_conditions_record::whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->select("people_id")
        ->groupBy("people_id")
        ->get()
        ->count();
        $participacion_ci = 0;
        if ($cantidad_personas_activas) {
            $participacion_ci = number_format(($cant_ci/$cantidad_personas_activas)*100 ,1);
        }

        //CUMPLIMIENTO A LA RUTINA
        //monitoreos
        $canti_monitoreos_ci = Unsafe_conditions_record::whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->where('detection_origin', 'Monitoreo de Seguridad')
        ->select("people_id")
        ->groupBy("people_id")
        ->get();
        $canti_monitoreos_cc = Companion_care_record::whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->where('detection_source', 'Monitoreo de Seguridad')
        ->select("people_id")
        ->groupBy("people_id")
        ->get();

        $canti_total_moniutoreo = new ArrayObject();
        foreach ($canti_monitoreos_ci as $key1 => $value1) {
            
            foreach ($canti_monitoreos_cc as $key2 => $value2) {

                if ($value1 == $value2) {
                    foreach ($canti_total_moniutoreo as $key => $value) {
                        if ($value1 == $value) {
                            # code...
                        } else {
                            $canti_total_moniutoreo->append($value1);
                        }
                        
                    }
                    
                }else {
                    foreach ($canti_total_moniutoreo as $key => $value) {
                        if ($value2 == $value) {
                            # code...
                        } else {
                            $canti_total_moniutoreo->append($value2);
                        }
                        
                    }
                    
                }

            }
        }
        return $canti_total_moniutoreo;
        //OWD

        return view('index', compact('detectadas', 'atendidas', 'avance', 'seguros', 'inseguros', 'participacion_cc', 'participacion_ci'));
    }
}
