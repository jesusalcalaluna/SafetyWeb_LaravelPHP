<?php

namespace App\Http\Controllers;

use App\Models\Companion_care_record;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        date_default_timezone_set('America/Monterrey');

        if (Auth::user()->role->role_name == 'ADMINISTRADOR') {

            $people = People::join('companies_and_departments', 'people.companie_and_department_id', '=', 'companies_and_departments.id')
            ->where('companies_and_departments.origin','INTERNO')
            ->count();

            $par_UnsefeConditions = Unsafe_conditions_record::groupBy('people_id')
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
        } else {

            $people = People::join('companies_and_departments', 'people.companie_and_department_id', '=', 'companies_and_departments.id')
                ->where('companies_and_departments.origin','INTERNO')
                //->where('companie_and_department_id', Auth::user()->person->company_and_department->id)
                ->count();

            $par_UnsefeConditions = Unsafe_conditions_record::groupBy('people_id')
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->count();
            $participation = ($par_UnsefeConditions/$people)*100;

            $participation = number_format($participation,1);

            //prioridad total
            $critica_total = DB::table('unsafe_conditions_records')->where('department_id', Auth::user()->person->company_and_department->id)->where('attention_priority', 'CRITICA')->count();
            $alta_total = DB::table('unsafe_conditions_records')->where('department_id', Auth::user()->person->company_and_department->id)->where('attention_priority', 'ALTA')->count();
            $media_total = DB::table('unsafe_conditions_records')->where('department_id', Auth::user()->person->company_and_department->id)->where('attention_priority', 'MEDIA')->count();
            $baja_total = DB::table('unsafe_conditions_records')->where('department_id', Auth::user()->person->company_and_department->id)->where('attention_priority', 'BAJA')->count();

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
        }
        
        $culturaDeSeguridadA = $this->getCultiraDeSeguridad(date('d')-1, date('m'), date('Y'));
        $culturaDeSeguridadD = $this->getCultiraDeSeguridad(date('d'), date('m'), date('Y'));
        $culturaDeSeguridadM = $this->getCultiraDeSeguridad(null, date('m'), date('Y'));
        $culturaDeSeguridadY = $this->getCultiraDeSeguridad(null, null, date('Y'));
        //return $par_CompanionCare;
        return view('pages.dashboard.index', compact('participation', 'porcent_critica', 'porcent_alta', 'porcent_media', 'porcent_baja', 'culturaDeSeguridadA', 'culturaDeSeguridadD', 'culturaDeSeguridadM', 'culturaDeSeguridadY'));
    }

    function getRecordsByDepartment_CurrentDay(){
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
        date_default_timezone_set('America/Monterrey');
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
            ],
            'Interno' => [
                'PartiY' => DashboardController::dashboardPartiChartsInternoY(),
                'PartiM' => DashboardController::dashboardPartiChartsInternoM(),
                'PartiD' => DashboardController::dashboardPartiChartsInternoD(),
            ],
            'Externo' => [
                'PartiY' => DashboardController::dashboardPartiChartsExternoY(),
                'PartiM' => DashboardController::dashboardPartiChartsExternoM(),
                'PartiD' => DashboardController::dashboardPartiChartsExternoD(),
            ]
        ];
        return $data;
    }

    static public function dashboardPartiChartsInternoY(){
        date_default_timezone_set('America/Monterrey');

        $AGUAS_AMB = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','AGUAS-AMB')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $CALIDAD = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','CALIDAD')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $COCIMIENTOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','COCIMIENTOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $CUARTOS_FRIOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','CUARTOS FRIOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $ENVASADO_LIDERAZGO = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LIDERAZGO')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();
        
        $ENVASADO_LINEA_1 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #1')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $ENVASADO_LINEA_2_3 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #2 & 3')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $ENVASADO_LINEA_4 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #4')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();
        $FINANZAS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FINANZAS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $GENTE_GESTION = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','GENTE Y GESTION')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $GERENCIA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','GERENCIA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $LOGÍSTICA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','LOGÍSTICA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $MTTO_GENERAL = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MTTO GENERAL')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $PROTECCION_PATRIMONIAL = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','PROTECCIÓN PATRIMONIAL')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $PROYECTOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','PROYECTOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $SEGURIDAD_SALUD = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SEGURIDAD Y SALUD')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $SERVICIO_ENERGIA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SERVICIO Y ENERGIA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        


        return $data=[
            $AGUAS_AMB,
            $CALIDAD,
            $COCIMIENTOS,
            $CUARTOS_FRIOS,
            $ENVASADO_LIDERAZGO,
            $ENVASADO_LINEA_1,
            $ENVASADO_LINEA_2_3,
            $ENVASADO_LINEA_4,
            $FINANZAS,
            $GENTE_GESTION,
            $GERENCIA,
            $LOGÍSTICA,
            $MTTO_GENERAL,
            $PROTECCION_PATRIMONIAL,
            $PROYECTOS,
            $SEGURIDAD_SALUD,
            $SERVICIO_ENERGIA,
        ];
    }

    static public function dashboardPartiChartsInternoM(){
        date_default_timezone_set('America/Monterrey');

        $AGUAS_AMB = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','AGUAS-AMB')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $CALIDAD = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','CALIDAD')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $COCIMIENTOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','COCIMIENTOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $CUARTOS_FRIOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','CUARTOS FRIOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $ENVASADO_LIDERAZGO = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LIDERAZGO')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $FINANZAS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FINANZAS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $GENTE_GESTION = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','GENTE Y GESTION')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $GERENCIA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','GERENCIA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $LOGÍSTICA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','LOGÍSTICA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $MTTO_GENERAL = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MTTO GENERAL')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $PROTECCION_PATRIMONIAL = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','PROTECCIÓN PATRIMONIAL')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $PROYECTOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','PROYECTOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $SEGURIDAD_SALUD = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SEGURIDAD Y SALUD')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $SERVICIO_ENERGIA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SERVICIO Y ENERGIA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $ENVASADO_LINEA_1 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #1')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $ENVASADO_LINEA_2_3 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #2 & 3')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $ENVASADO_LINEA_4 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #4')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();


        return $data=[
            $AGUAS_AMB,
            $CALIDAD,
            $COCIMIENTOS,
            $CUARTOS_FRIOS,
            $ENVASADO_LIDERAZGO,
            $ENVASADO_LINEA_1,
            $ENVASADO_LINEA_2_3,
            $ENVASADO_LINEA_4,
            $FINANZAS,
            $GENTE_GESTION,
            $GERENCIA,
            $LOGÍSTICA,
            $MTTO_GENERAL,
            $PROTECCION_PATRIMONIAL,
            $PROYECTOS,
            $SEGURIDAD_SALUD,
            $SERVICIO_ENERGIA,
        ];
    }

    static public function dashboardPartiChartsInternoD(){
        date_default_timezone_set('America/Monterrey');

        $AGUAS_AMB = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','AGUAS-AMB')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $CALIDAD = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','CALIDAD')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $COCIMIENTOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','COCIMIENTOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $CUARTOS_FRIOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','CUARTOS FRIOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $ENVASADO_LIDERAZGO = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LIDERAZGO')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $FINANZAS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FINANZAS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $GENTE_GESTION = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','GENTE Y GESTION')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $GERENCIA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','GERENCIA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $LOGÍSTICA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','LOGÍSTICA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $MTTO_GENERAL = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MTTO GENERAL')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $PROTECCION_PATRIMONIAL = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','PROTECCIÓN PATRIMONIAL')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $PROYECTOS = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','PROYECTOS')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $SEGURIDAD_SALUD = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SEGURIDAD Y SALUD')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $SERVICIO_ENERGIA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SERVICIO Y ENERGIA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $ENVASADO_LINEA_1 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #1')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $ENVASADO_LINEA_2_3 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #2 & 3')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $ENVASADO_LINEA_4 = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ENVASADO LÍNEA #4')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();


        return $data=[
            $AGUAS_AMB,
            $CALIDAD,
            $COCIMIENTOS,
            $CUARTOS_FRIOS,
            $ENVASADO_LIDERAZGO,
            $ENVASADO_LINEA_1,
            $ENVASADO_LINEA_2_3,
            $ENVASADO_LINEA_4,
            $FINANZAS,
            $GENTE_GESTION,
            $GERENCIA,
            $LOGÍSTICA,
            $MTTO_GENERAL,
            $PROTECCION_PATRIMONIAL,
            $PROYECTOS,
            $SEGURIDAD_SALUD,
            $SERVICIO_ENERGIA,
        ];
    }

    static public function dashboardPartiChartsExternoY(){
        date_default_timezone_set('America/Monterrey');

        $BRITE = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','BRITE')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $FEMOSA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FEMOSA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $SALN = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SALN')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $SGM = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SGM')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $ECOLAB = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ECOLAB')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();
        
        $NALCO = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','NALCO')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $LYM = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','L&M')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $MBSA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MBSA (Montajes Bocanegra)')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();
        $Lopez = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','J. Lopéz')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $JPAP = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','JPAP')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $Quiroz = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','R. Quiroz')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $FUMYCA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FUMYCA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $kitchen = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','kitchen (comedor)')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $CYH = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','C&H')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $MATRESA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MATRESA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $Practicante = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Practicante')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();

        $Visita = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Visita')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();
        $Proyectos = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Proyectos')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();
        $Transportista = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Transportista')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->count();


        


        return $data=[
            $BRITE,
            $FEMOSA,
            $SALN,
            $SGM,
            $ECOLAB,
            $NALCO,
            $LYM,
            $MBSA,
            $Lopez,
            $JPAP,
            $Quiroz,
            $FUMYCA,
            $kitchen,
            $CYH,
            $MATRESA,
            $Practicante,
            $Visita,
            $Proyectos,
            $Transportista,
        ];
    }

    static public function dashboardPartiChartsExternoM(){
        date_default_timezone_set('America/Monterrey');

        $BRITE = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','BRITE')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $FEMOSA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FEMOSA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $SALN = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SALN')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $SGM = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SGM')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $ECOLAB = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ECOLAB')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();
        
        $NALCO = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','NALCO')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $LYM = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','L&M')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $MBSA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MBSA (Montajes Bocanegra)')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();
        $Lopez = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','J. Lopéz')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $JPAP = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','JPAP')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $Quiroz = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','R. Quiroz')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $FUMYCA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FUMYCA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $kitchen = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','kitchen (comedor)')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $CYH = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','C&H')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $MATRESA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MATRESA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $Practicante = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Practicante')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        $Visita = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Visita')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();
        $Proyectos = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Proyectos')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();
        $Transportista = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Transportista')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->count();

        return $data=[
            $BRITE,
            $FEMOSA,
            $SALN,
            $SGM,
            $ECOLAB,
            $NALCO,
            $LYM,
            $MBSA,
            $Lopez,
            $JPAP,
            $Quiroz,
            $FUMYCA,
            $kitchen,
            $CYH,
            $MATRESA,
            $Practicante,
            $Visita,
            $Proyectos,
            $Transportista,
        ];
    }

    static public function dashboardPartiChartsExternoD(){
        date_default_timezone_set('America/Monterrey');

        $BRITE = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','BRITE')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $FEMOSA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FEMOSA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $SALN = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SALN')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $SGM = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','SGM')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $ECOLAB = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','ECOLAB')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();
        
        $NALCO = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','NALCO')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $LYM = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','L&M')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $MBSA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MBSA (Montajes Bocanegra)')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();
        $Lopez = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','J. Lopéz')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $JPAP = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','JPAP')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $Quiroz = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','R. Quiroz')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $FUMYCA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','FUMYCA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $kitchen = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','kitchen (comedor)')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $CYH = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','C&H')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $MATRESA = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','MATRESA')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $Practicante = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Practicante')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        $Visita = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Visita')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();
        $Proyectos = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Proyectos')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();
        $Transportista = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name','Transportista')
            ->whereYear('unsafe_conditions_records.created_at',date('Y'))
            ->whereMonth('unsafe_conditions_records.created_at',date('m'))
            ->whereDay('unsafe_conditions_records.created_at',date('d'))
            ->count();

        return $data=[
            $BRITE,
            $FEMOSA,
            $SALN,
            $SGM,
            $ECOLAB,
            $NALCO,
            $LYM,
            $MBSA,
            $Lopez,
            $JPAP,
            $Quiroz,
            $FUMYCA,
            $kitchen,
            $CYH,
            $MATRESA,
            $Practicante,
            $Visita,
            $Proyectos,
            $Transportista,
        ];
    }

    //Cultura de seguridad
    public function getCultiraDeSeguridad($dia, $mes, $año){

        $compani_and_departments = DB::table('companies_and_departments')->get()->all();
        //return  $compani_and_departments;
        $departamentos = array();

        foreach ($compani_and_departments as $key => $value) {
            
            $det = $this->getDET($value->name, $dia, $mes, $año);
            $trat = $this->getTRAT($value->name, $dia, $mes, $año);
            $atencion = $this->getPorcentaje($det, $trat, $dia, $mes, $año);
            $detArea = $this->getDetArea($value->name, $dia, $mes, $año);
            $participacionCI = $this->getParticipacionCI($value->name, $dia, $mes, $año);
            $inseguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO INSEGURO", $dia, $mes, $año);
            $seguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO SEGURO", $dia, $mes, $año);
            $totalCuidadosArea = $this->getTotalCuidadosArea($value->name, $dia, $mes, $año);
            $CCporArea = $this->getCCporArea($value->name, $dia, $mes, $año);
            $participacionCC = $this->getParticipacionCC($value->name, $dia, $mes, $año);
            
            $departamentos[] = [
                "Departamento" => $value->name,
                "DET" => $det, 
                "TRAT" => $trat, 
                "Atencion" => $atencion, 
                "DetectadosArea" => $detArea, 
                "ParticipacionCI" => $participacionCI, 
                
                "Inseguro" => $inseguro, 
                "Seguro" => $seguro,
                "TotalCuidadosArea" => $totalCuidadosArea,
                "CuidadosPorElArea" => $CCporArea,
                "ParticipacionCC" => $participacionCC,
            ];
            
        }

        return $departamentos;
    }

    public function getParticipacionCC($departamento, $dia, $mes, $año)
    {
        $people = DB::table('people')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->where('companies_and_departments.name', $departamento )
        ->where('people.status', 'ACTIVO')->count();

            

        if ($dia == null && $mes == null && $año) {
            $cc_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('companion_care_records', 'companion_care_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereYear('companion_care_records.created_at', $año)
            ->get('people_id')//->all();
            ->groupBy('people_id')->count();
        }
        if ($dia ==null && $mes && $año) {
            $cc_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('companion_care_records', 'companion_care_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereMonth('companion_care_records.created_at', $mes)
            ->whereYear('companion_care_records.created_at', $año)
            ->get('people_id')//->all();
            ->groupBy('people_id')->count();
        }
        if ($dia && $mes && $año) {

            $cc_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('companion_care_records', 'companion_care_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereDay('companion_care_records.created_at', $dia)
            ->whereMonth('companion_care_records.created_at', $mes)
            ->whereYear('companion_care_records.created_at', $año)
            ->get('people_id')//->all();
            ->groupBy('people_id')->count();
        }

        return $cc_departamento;
        $porcentaje = $this->getPorcentaje($people, $cc_departamento);

        return $porcentaje;
    }

    public function getCCporArea($departamento, $dia, $mes, $año)
    {
        if ($dia == null && $mes == null && $año) {
            $total = DB::table('companion_care_records')
            ->join('people', 'people.id', '=', 'companion_care_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereYear('companion_care_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )
            ->count();

        }
        if ($dia ==null && $mes && $año) {
            $total = DB::table('companion_care_records')
            ->join('people', 'people.id', '=', 'companion_care_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereMonth('companion_care_records.created_at', $mes)
            ->whereYear('companion_care_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )
            ->count();
        }
        if ($dia && $mes && $año) {
            $total = DB::table('companion_care_records')
            ->join('people', 'people.id', '=', 'companion_care_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereDay('companion_care_records.created_at', $dia)
            ->whereMonth('companion_care_records.created_at', $mes)
            ->whereYear('companion_care_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )
            ->count();
        }

        return $total;
    }

    public function getTotalCuidadosArea($departamento, $dia, $mes, $año)
    {
        
        if ($dia == null && $mes == null && $año) {                                                                 
            $total = DB::table('companion_care_records')
            ->whereYear('created_at', $año)
            ->where('company_department_name', $departamento )
            ->count();
        }
        if ($dia == null && $mes && $año) {
            $total = DB::table('companion_care_records')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $año)
            ->where('company_department_name', $departamento )
            ->count();
        }
        if ($dia && $mes && $año){                                                                                                                
            $total = DB::table('companion_care_records')
            ->whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $año)
            ->where('company_department_name', $departamento )
            ->count();
        }
        

        return $total;
    }

    public function getSeguroInseguroCC($departamento, $seguro_inseguro, $dia, $mes, $año)
    {
        if ($dia == null && $mes == null && $año) {
            $seguro = DB::table('companion_care_records')
            ->whereYear('created_at', $año)
            ->where('company_department_name', $departamento )
            ->where('corr_prev_pos', $seguro_inseguro)
            ->count();
        }
        if ($dia == null && $mes && $año) {
            $seguro = DB::table('companion_care_records')
            ->whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $año)
            ->where('company_department_name', $departamento )
            ->where('corr_prev_pos', $seguro_inseguro)
            ->count();
        }
        if ($dia && $mes && $año) {
            $seguro = DB::table('companion_care_records')
            ->whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $año)
            ->where('company_department_name', $departamento )
            ->where('corr_prev_pos', $seguro_inseguro)
            ->count();
        }
        

        return $seguro;
    }

    public function getDET($departamento, $dia, $mes, $año)
    {
        if ($dia == null && $mes == null && $año) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia == null && $mes && $año) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia && $mes && $año) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereDay('unsafe_conditions_records.created_at', $dia)
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        //prioridad total DET
        
        return $ci_det;
    }

    public function getTRAT($departamento, $dia, $mes, $año)
    {
        if ($dia == null && $mes == null && $año) {
            $ci_completa = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', $departamento)->count();
        }
        if ($dia == null && $mes && $año) {
            $ci_completa = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', $departamento)->count();
        }
        if ($dia && $mes && $año) {
            $ci_completa = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereDay('unsafe_conditions_records.created_at', $dia)
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', $departamento)->count();
            }
            //prioridad completadas TRAT
            
            return $ci_completa;
    }

    public function getPorcentaje($total, $secundario){
        $result = 0;
        if ($total) {
            $result = number_format(($secundario/$total)*100 ,0);
        }
        
        return $result;
    }

    public function getDetArea($departamento, $dia, $mes, $año){
        $departamentoId = DB::table('companies_and_departments')->where('name', $departamento)->get()->all();
        if ($dia == null && $mes == null && $año) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('unsafe_conditions_records.department_id', $departamentoId[0]->id)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia == null && $mes && $año) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('unsafe_conditions_records.department_id', $departamentoId[0]->id)
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia && $mes && $año) {
            
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('unsafe_conditions_records.department_id', $departamentoId[0]->id)
            ->whereDay('unsafe_conditions_records.created_at', $dia)
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        //prioridad total DET
        
        return $ci_det;
    }

    public function getParticipacionCI($departamento, $dia, $mes, $año)
    {
        $people = DB::table('people')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->where('companies_and_departments.name', $departamento )
        ->where('people.status', 'ACTIVO')->count();
        
        if ($dia == null && $mes == null && $año) {
            $ci_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('unsafe_conditions_records', 'unsafe_conditions_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->get('people_id')//->all();
            ->groupBy('people_id')->count();
            
        }
        if ($dia == null && $mes && $año) {
            $ci_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('unsafe_conditions_records', 'unsafe_conditions_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->get('people_id')//->all();
            ->groupBy('people_id')->count();
        }
        if ($dia && $mes && $año) {
            $ci_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('unsafe_conditions_records', 'unsafe_conditions_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereDay('unsafe_conditions_records.created_at', $dia)
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->get('people_id')//->all();
            ->groupBy('people_id')->count();
        }
        

        $porcentaje = $this->getPorcentaje($people, $ci_departamento);

        return $porcentaje;
    }
}
