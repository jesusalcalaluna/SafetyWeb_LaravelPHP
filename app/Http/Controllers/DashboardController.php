<?php

namespace App\Http\Controllers;

use App\Models\Companion_care_record;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        date_default_timezone_set('America/Monterrey');

        $people = People::join('companies_and_departments', 'people.companie_and_department_id', '=', 'companies_and_departments.id')
        ->where('companies_and_departments.origin','INTERNO')
        ->count();

        $par_UnsefeConditions = Unsafe_conditions_record::groupBy('person_id')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->count();
        $participation = ($par_UnsefeConditions/$people)*100;

        $participation = number_format($participation,1) ;

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
        
        //return $par_CompanionCare;
        return view('pages.dashboard.index', compact('participation', 'porcent_critica', 'porcent_alta', 'porcent_media', 'porcent_baja'));
    }

    function getRecordsByDepartment_CurrentDay()
    {
        date_default_timezone_set('America/Monterrey');
        $par_UnsefeConditions = DB::table('unsafe_conditions_records')
        ->join('companies_and_departments', 'unsafe_conditions_records.department_id','=','companies_and_departments.id')
        ->select('companies_and_departments.name', DB::raw('count(*) as total'))
        ->where('attention_priority','CRITICA')
        ->whereDate('unsafe_conditions_records.created_at', '=', date('Y-m-d'))
        ->groupBy('companies_and_departments.name')
        ->get();
        return $par_UnsefeConditions;
        
    }

    public function dashboardCharts(){
        //prioridad critica registrada ultimos 6 dias
        $critica_total_dia_1 = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')
        ->whereDate('created_at', date('Y-m').'-'.date('d'))->count();
        $critica_total_dia_2 = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-1,2,"0", STR_PAD_LEFT))->count();
        $critica_total_dia_3 = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-2,2,"0", STR_PAD_LEFT))->count();
        $critica_total_dia_4 = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-3,2,"0", STR_PAD_LEFT))->count();
        $critica_total_dia_5 = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-4,2,"0", STR_PAD_LEFT))->count();
        $critica_total_dia_6 = DB::table('unsafe_conditions_records')->where('attention_priority', 'CRITICA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-5,2,"0", STR_PAD_LEFT))->count();

        $alta_total_dia_1 = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')
        ->whereDate('created_at', date('Y-m').'-'.date('d'))->count();
        $alta_total_dia_2 = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-1,2,"0", STR_PAD_LEFT))->count();
        $alta_total_dia_3 = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-2,2,"0", STR_PAD_LEFT))->count();
        $alta_total_dia_4 = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-3,2,"0", STR_PAD_LEFT))->count();
        $alta_total_dia_5 = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-4,2,"0", STR_PAD_LEFT))->count();
        $alta_total_dia_6 = DB::table('unsafe_conditions_records')->where('attention_priority', 'ALTA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-5,2,"0", STR_PAD_LEFT))->count();

        $media_total_dia_1 = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')
        ->whereDate('created_at', date('Y-m').'-'.date('d'))->count();
        $media_total_dia_2 = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-1,2,"0", STR_PAD_LEFT))->count();
        $media_total_dia_3 = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-2,2,"0", STR_PAD_LEFT))->count();
        $media_total_dia_4 = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-3,2,"0", STR_PAD_LEFT))->count();
        $media_total_dia_5 = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-4,2,"0", STR_PAD_LEFT))->count();
        $media_total_dia_6 = DB::table('unsafe_conditions_records')->where('attention_priority', 'MEDIA')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-5,2,"0", STR_PAD_LEFT))->count();

        $baja_total_dia_1 = DB::table('unsafe_conditions_records')->where('risk_type', 'POSIBLE RIESGO')
        ->whereDate('created_at', date('Y-m').'-'.date('d'))->count();
        $baja_total_dia_2 = DB::table('unsafe_conditions_records')->where('risk_type', 'POSIBLE RIESGO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-1,2,"0", STR_PAD_LEFT))->count();
        $baja_total_dia_3 = DB::table('unsafe_conditions_records')->where('risk_type', 'POSIBLE RIESGO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-2,2,"0", STR_PAD_LEFT))->count();
        $baja_total_dia_4 = DB::table('unsafe_conditions_records')->where('risk_type', 'POSIBLE RIESGO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-3,2,"0", STR_PAD_LEFT))->count();
        $baja_total_dia_5 = DB::table('unsafe_conditions_records')->where('risk_type', 'POSIBLE RIESGO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-4,2,"0", STR_PAD_LEFT))->count();
        $baja_total_dia_6 = DB::table('unsafe_conditions_records')->where('risk_type', 'POSIBLE RIESGO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-5,2,"0", STR_PAD_LEFT))->count();

        $baja2_total_dia_1 = DB::table('unsafe_conditions_records')->where('risk_type', 'RIESGO LIGERO')
        ->whereDate('created_at', date('Y-m').'-'.date('d'))->count();
        $baja2_total_dia_2 = DB::table('unsafe_conditions_records')->where('risk_type', 'RIESGO LIGERO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-1,2,"0", STR_PAD_LEFT))->count();
        $baja2_total_dia_3 = DB::table('unsafe_conditions_records')->where('risk_type', 'RIESGO LIGERO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-2,2,"0", STR_PAD_LEFT))->count();
        $baja2_total_dia_4 = DB::table('unsafe_conditions_records')->where('risk_type', 'RIESGO LIGERO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-3,2,"0", STR_PAD_LEFT))->count();
        $baja2_total_dia_5 = DB::table('unsafe_conditions_records')->where('risk_type', 'RIESGO LIGERO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-4,2,"0", STR_PAD_LEFT))->count();
        $baja2_total_dia_6 = DB::table('unsafe_conditions_records')->where('risk_type', 'RIESGO LIGERO')
        ->whereDate('created_at', date('Y-m').'-'.str_pad(date('d')-5,2,"0", STR_PAD_LEFT))->count();

        $data= [
            'dates' => [
                date('d').'-'.date('m-Y'),
                str_pad(date('d')-1,2,"0", STR_PAD_LEFT).'-'.date('m-Y'),
                str_pad(date('d')-2,2,"0", STR_PAD_LEFT).'-'.date('m-Y'),
                str_pad(date('d')-3,2,"0", STR_PAD_LEFT).'-'.date('m-Y'),
                str_pad(date('d')-4,2,"0", STR_PAD_LEFT).'-'.date('m-Y'),
                str_pad(date('d')-5,2,"0", STR_PAD_LEFT).'-'.date('m-Y'),
            ],
            'chart_1' => [
                $critica_total_dia_1,
                $critica_total_dia_2,
                $critica_total_dia_3,
                $critica_total_dia_4,
                $critica_total_dia_5,
                $critica_total_dia_6
            ],
            'chart_2' => [
                $alta_total_dia_1,
                $alta_total_dia_2,
                $alta_total_dia_3,
                $alta_total_dia_4,
                $alta_total_dia_5,
                $alta_total_dia_6,
            ],
            'chart_3' => [
                $media_total_dia_1,
                $media_total_dia_2,
                $media_total_dia_3,
                $media_total_dia_4,
                $media_total_dia_5,
                $media_total_dia_6,
            ],
            'chart_4' => [
                $baja_total_dia_1,
                $baja_total_dia_2,
                $baja_total_dia_3,
                $baja_total_dia_4,
                $baja_total_dia_5,
                $baja_total_dia_6,
            ],
            'chart_4_2' => [
                $baja2_total_dia_1,
                $baja2_total_dia_2,
                $baja2_total_dia_3,
                $baja2_total_dia_4,
                $baja2_total_dia_5,
                $baja2_total_dia_6,
            ]
        ];
        return $data;
    }
}
