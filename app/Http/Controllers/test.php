<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Unsafe_conditions_record;
use Illuminate\Support\Carbon;
use App\Models\People;
use App\Http\Producer\Dashboard;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(){
        date_default_timezone_set('America/Monterrey');
        $par_UnsefeConditions_C = Unsafe_conditions_record::where('attention_priority','CRITICA')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->count();
        
        $par_UnsefeConditions_C_com = Unsafe_conditions_record::where('attention_priority','CRITICA')
        ->where('status', 'COMPLETA')
        ->whereDate('created_at', '=', date('Y-m-d'))
        ->count();
        $porcent_complit_c=0;
        if ($par_UnsefeConditions_C) {
            $porcent_complit_c = number_format(($par_UnsefeConditions_C_com/$par_UnsefeConditions_C)*100 ,0);
        }

        //condiciones criticas por departamento - se muestran solo los departamentos que tienen registros
        $criticas_hoy_departamento = DB::table('unsafe_conditions_records')
        ->select('companies_and_departments.name', DB::raw('count(unsafe_conditions_records.id) as total'))
        ->whereDate('unsafe_conditions_records.created_at', '=', date('Y-m-d'))
        ->rightJoin('companies_and_departments', 'unsafe_conditions_records.department_id','=','companies_and_departments.id')
        ->where('companies_and_departments.origin', 'INTERNO')
        ->groupBy('companies_and_departments.name')
        ->get();

        $criticas_mes_departamento = DB::table('unsafe_conditions_records')
        ->select('companies_and_departments.name', DB::raw('count(unsafe_conditions_records.id) as total'))
        ->whereMonth('unsafe_conditions_records.created_at', '=', date('m'))
        ->whereYear('unsafe_conditions_records.created_at', '=', date('Y'))
        ->rightJoin('companies_and_departments', 'unsafe_conditions_records.department_id','=','companies_and_departments.id')
        ->where('companies_and_departments.origin', 'INTERNO')
        ->groupBy('companies_and_departments.name')
        ->get();

        $criticas_año_departamento = DB::table('unsafe_conditions_records')
        ->select('companies_and_departments.name', DB::raw('count(unsafe_conditions_records.id) as total'))
        ->whereYear('unsafe_conditions_records.created_at', '=', date('Y'))
        ->rightJoin('companies_and_departments', 'unsafe_conditions_records.department_id','=','companies_and_departments.id')
        ->where('companies_and_departments.origin', 'INTERNO')
        ->groupBy('companies_and_departments.name')
        ->get();


        //prioridad total
        $critica_total = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')->count();
        $alta_total = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')->count();
        $media_total = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')->count();
        $baja_total = DB::table('unsafe_conditions_records')->where('attention_priority', 'BAJA')->count();

        //prioridad completadas
        $critica_completa = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')
        ->where('status', 'COMPLETA')->count();
        $alta_completa = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')
        ->where('status', 'COMPLETA')->count();
        $media_completa = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')
        ->where('status', 'COMPLETA')->count();
        $baja_completa = DB::table('unsafe_conditions_records')->where('attention_priority', 'BAJA')
        ->where('status', 'COMPLETA')->count();

        //porcentaje completado por prioridad
        $porcent_critica = 0;
        if ($critica_total) {
            $porcent_critica = number_format(($critica_completa/$critica_total)*100 ,0);
        }
        $porcent_alta = 0;
        if ($alta_total) {
            $porcent_alta = number_format(($alta_completa/$alta_total)*100 ,0);
        }
        $porcent_media = 0;
        if ($media_total) {
            $porcent_media = number_format(($media_completa/$media_total)*100 ,0);
        }
        $porcent_baja = 0;
        if ($baja_total) {
            $porcent_baja = number_format(($baja_completa/$baja_total)*100 ,0);
        }

        $SEGURIDAD_SALUD = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SEGURIDAD')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();
        

        $people = People::where('status', 'ACTIVO')->orderBy('name', 'ASC')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'EXTERNO');
        })->with('unsafe_condition_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->with('companion_care_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->get();


        //ASI CALCULAREMOS LAS DET Y TRAT EN CONDICIONES INSEGURAS PARA LA TABLA DE COLTURA DE SEGURIDAD
        //prioridad total DET
        $ci_total = DB::table('unsafe_conditions_records')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->whereDate('unsafe_conditions_records.created_at', date('Y-m').'-'.date('d'))
        ->where('companies_and_departments.name', 'COCIMIENTOS')->count();

        //prioridad completadas TRAT
        $ci_completa = DB::table('unsafe_conditions_records')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->whereDate('unsafe_conditions_records.updated_at', date('Y-m').'-'.date('d'))
        ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', 'COCIMIENTOS')->count();

        return [$ci_total, $ci_completa];
    }
}
