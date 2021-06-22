<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Unsafe_conditions_record;
use Illuminate\Support\Carbon;
use App\Models\People;
use App\Http\Producer\Dashboard;
use App\Models\Role;
use ArrayObject;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(){
        date_default_timezone_set('America/Monterrey');
    /*    $par_UnsefeConditions_C = Unsafe_conditions_record::where('attention_priority','CRITICA')
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
*/

        $culturaDeSeguridadA = $this->getCultiraDeSeguridad(date("d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))), date('m'), date('Y'));
        //$culturaDeSeguridadD = $this->getCultiraDeSeguridad(date('d'), date('m'), date('Y'));
        //$culturaDeSeguridadM = $this->getCultiraDeSeguridad(null, date('m'), date('Y'));
        //$culturaDeSeguridadY = $this->getCultiraDeSeguridad(null, null, date('Y'));
       
        return $culturaDeSeguridadA;
    }

    public function getCultiraDeSeguridad($dia, $mes, $año){
        
        $compani_and_departments = DB::table('companies_and_departments')->get()->all();
        //return  $compani_and_departments;
        $departamentos = array();

        foreach ($compani_and_departments as $key => $value) {
            
            $det = $this->getDET($value->name, $dia, $mes, $año);
            /*$trat = $this->getTRAT($value->name, $dia, $mes, $año);
            $atencion = $this->getPorcentaje($det, $trat, $dia, $mes, $año);
            $detArea = $this->getDetArea($value->name, $dia, $mes, $año);
            $participacionCI = $this->getParticipacionCI($value->name, $dia, $mes, $año);
            $inseguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO INSEGURO", $dia, $mes, $año);
            $seguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO SEGURO", $dia, $mes, $año);
            $totalCuidadosArea = $this->getTotalCuidadosArea($value->name, $dia, $mes, $año);
            $CCporArea = $this->getCCporArea($value->name, $dia, $mes, $año);
            $participacionCC = $this->getParticipacionCC($value->name, $dia, $mes, $año);*/

            $departamentos[] = [
                "Departamento" => $value->name,
                "DET" => $det, 
                /*"TRAT" => $trat, 
                "Atencion" => $atencion, 
                "DetectadosArea" => $detArea, 
                "ParticipacionCI" => $participacionCI, 
                
                "Inseguro" => $inseguro, 
                "Seguro" => $seguro,
                "TotalCuidadosArea" => $totalCuidadosArea,
                "CuidadosPorElArea" => $CCporArea,
                "ParticipacionCC" => $participacionCC,*/
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
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia == null && $mes && $año) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $año)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia && $mes && $año) {
            
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
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
