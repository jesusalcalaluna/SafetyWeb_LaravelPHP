<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companion_care_record;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{

    public function getIndex(){
        date_default_timezone_set('America/Monterrey');

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

        return view('index', compact('detectadas', 'atendidas', 'avance', 'seguros', 'inseguros'));
    }
}
