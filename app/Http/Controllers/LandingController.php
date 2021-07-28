<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companion_care_record;
use App\Models\IncidentRecord;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use ArrayObject;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;

class LandingController extends Controller
{

    public function getIndex(){
        //date_default_timezone_set('America/Monterrey');

        $cantidad_personas_activas = $this->getTotalPeopleActive();
        $anio = date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $mes = date("m", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

        //COMPAÑEROS CUIDADOS
        //seguros
        $seguros = DB::table('companion_care_records')
            ->whereYear('created_at',$anio)
            ->where('corr_prev_pos', 'COMPORTAMIENTO SEGURO')->count();
        //inseguros
        $inseguros = DB::table('companion_care_records')
            ->whereYear('created_at',$anio)
            ->where('corr_prev_pos', 'COMPORTAMIENTO INSEGURO')->count();
        //CONDICIONES INSEGURAS
        //Detectadas
        $detectadas = DB::table('unsafe_conditions_records')
            ->whereYear('unsafe_conditions_records.created_at',$anio)
            ->count();
        //Atendidas
        $atendidas = DB::table('unsafe_conditions_records')
            ->whereYear('unsafe_conditions_records.created_at',$anio)
            ->where('status', 'COMPLETA')->count();
        //Avance
        $avance = 0;
        if ($detectadas) {
            $avance = number_format(($atendidas/$detectadas)*100 ,0);
        }

        //PARTICIPACION DE DETECCION
        //cuidado del compañero
        $cant_cc = Companion_care_record::whereYear('created_at',$anio)
            ->select("people_id")
            ->groupBy("people_id")
            ->get()
            ->count();
        $participacion_cc = 0;
        if ($cantidad_personas_activas) {
            $participacion_cc = number_format(($cant_cc/$cantidad_personas_activas)*100 ,1);
        }
        //condiciones inseguras
        $cant_ci = Unsafe_conditions_record::whereYear('created_at',$anio)
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
        $canti_monitoreos_ci = Unsafe_conditions_record::whereYear('created_at',$anio)
            ->where('detection_origin', 'Monitoreo de Seguridad')
            ->select("people_id")
            ->groupBy("people_id")
            ->get();
        $canti_monitoreos_cc = Companion_care_record::whereYear('created_at',$anio)
            ->where('detection_source', 'Monitoreo de Seguridad')
            ->select("people_id")
            ->groupBy("people_id")
            ->get();

        $agrupar_moniutoreo = new ArrayObject();
        foreach ($canti_monitoreos_ci as $key1 => $value) {

            if (!sizeof($agrupar_moniutoreo)) {
                $agrupar_moniutoreo->append($value);
            }

            foreach ($agrupar_moniutoreo as $key2 => $value1) {
                if($value->people_id == $value1->people_id){
                    break ;
                }else {
                    $agrupar_moniutoreo->append($value);
                    break ;
                }

            }
        }

        foreach ($canti_monitoreos_cc as $key2 => $value) {
            if (!sizeof($agrupar_moniutoreo)) {
                $agrupar_moniutoreo->append($value);
            }

            foreach ($agrupar_moniutoreo as $key2 => $value1) {
                if($value->people_id == $value1->people_id){
                    break ;
                }else {
                    $agrupar_moniutoreo->append($value);
                    break ;
                }

            }
        }
        $canti_total_moniutoreo = $agrupar_moniutoreo->count();
        $p_monitoreos = 0;
        if ($cantidad_personas_activas) {
            $p_monitoreos = number_format(($canti_total_moniutoreo/$cantidad_personas_activas)*100 ,1);
        }

        //OWD
        $canti_owd_ci = Unsafe_conditions_record::whereYear('created_at',$anio)
            ->where('detection_origin', 'DTO (OWD)')
            ->select("people_id")
            ->groupBy("people_id")
            ->get();
        $canti_owd_cc = Companion_care_record::whereYear('created_at',$anio)
            ->where('detection_source', 'DTO (OWD)')
            ->select("people_id")
            ->groupBy("people_id")
            ->get();

        $agrupar_owd = new ArrayObject();
        foreach ($canti_owd_ci as $key1 => $value) {

            if (!sizeof($agrupar_owd)) {
                $agrupar_owd->append($value);
            }

            foreach ($agrupar_owd as $key2 => $value1) {
                if($value->people_id == $value1->people_id){
                    break ;
                }else {
                    $agrupar_owd->append($value);
                    break ;
                }

            }
        }

        foreach ($canti_owd_cc as $key2 => $value) {
            if (!sizeof($agrupar_owd)) {
                $agrupar_owd->append($value);
            }

            foreach ($agrupar_owd as $key2 => $value1) {
                if($value->people_id == $value1->people_id){
                    break ;
                }else {
                    $agrupar_owd->append($value);
                    break ;
                }

            }
        }

        $canti_total_owd = $agrupar_owd->count();

        $p_owd = 0;
        if ($cantidad_personas_activas) {
            $p_owd = number_format(($canti_total_owd/$cantidad_personas_activas)*100 ,1);
        }

        $incidentes_lti = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'LTI')
        ->where('status', 1)
        ->count();
        $incidentes_mdi = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'MDI')
        ->where('status', 1)
        ->count();
        $incidentes_mti = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'MTI')
        ->where('status', 1)
        ->count();
        $incidentes_fai = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'FAI')
        ->where('status', 1)
        ->count();
        $incidentes = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'INCIDENTES')
        ->where('status', 1)
        ->count();

        $incidentes_lti_sif = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'LTI')
        ->where('sif', 1)
        ->where('status', 1)
        ->count();
        $incidentes_mdi_sif = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'MDI')
        ->where('sif', 1)
        ->where('status', 1)
        ->count();
        $incidentes_mti_sif = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'MTI')
        ->where('sif', 1)
        ->where('status', 1)
        ->count();
        $incidentes_fai_sif = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'FAI')
        ->where('sif', 1)
        ->where('status', 1)
        ->count();
        $incidentes_sif = IncidentRecord::whereYear('created_at',$anio)
        ->where('classification', 'INCIDENTE')
        ->where('sif', 1)
        ->where('status', 1)
        ->count();


        return view('index', compact('detectadas', 'atendidas', 'avance', 'seguros', 'inseguros', 'participacion_cc', 'participacion_ci', 'p_monitoreos', 'p_owd', 'incidentes_lti', 'incidentes_mdi', 'incidentes_mti', 'incidentes_fai', 'incidentes_lti_sif', 'incidentes_mdi_sif', 'incidentes_mti_sif', 'incidentes_fai_sif', 'incidentes_sif', 'incidentes'));
    }
    public function getTotalPeopleActive($departamento = ''): int
    {
        $peopleTotal = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->where('companies_and_departments.name', 'LIKE', '%'.$departamento.'%' )
            ->where('people.status', 'ACTIVO')
            ->count();

        return $peopleTotal;
    }
}
