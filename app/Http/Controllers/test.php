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



        $compani_and_departments = DB::table('companies_and_departments')->get()->all();
        //return  $compani_and_departments;
        $departamentos = array();

        foreach ($compani_and_departments as $key => $value) {
            
            $det = $this->getDET($value->name);
            $trat = $this->getTRAT($value->name);
            $atencion = $this->getPorcentaje($det, $trat);
            $detArea = $this->getDetArea($value->name);
            $participacionCI = $this->getParticipacionCI($value->name);
            $inseguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO INSEGURO");
            $seguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO SEGURO");
            $totalCuidadosArea = $this->getTotalCuidadosArea($value->name);
            $CCporArea = $this->getCCporArea($value->name);
            $participacionCC = $this->getParticipacionCC($value->name);
            //return $inseguro;
            $departamentos[] = [
                "departamento" => $value->name, 
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

    public function getParticipacionCC($departamento)
    {
        $people = DB::table('people')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->where('companies_and_departments.name', $departamento )
        ->where('people.status', 'ACTIVO')->count();
        
        $cc_departamento = DB::table('companion_care_records')
        ->join('people', 'people.id', '=', 'companion_care_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->whereDate('companion_care_records.created_at', date('Y-m').'-'.date('d'))
        ->where('companies_and_departments.name', $departamento )->count();

        $porcentaje = $this->getPorcentaje($people, $cc_departamento);

        return $porcentaje;
    }

    public function getCCporArea($departamento)
    {
        $total = DB::table('companion_care_records')
        ->join('people', 'people.id', '=', 'companion_care_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->whereDate('companion_care_records.created_at', date('Y-m').'-'.date('d'))
        ->where('companies_and_departments.name', $departamento )
        ->count();

        return $total;
    }

    public function getTotalCuidadosArea($departamento)
    {
        $total = DB::table('companion_care_records')
        ->whereDate('created_at', date('Y-m').'-'.date('d'))
        ->where('company_department_name', $departamento )
        ->count();

        return $total;
    }

    public function getSeguroInseguroCC($departamento, $seguro_inseguro)
    {
        $seguro = DB::table('companion_care_records')
        ->whereDate('created_at', date('Y-m').'-'.date('d'))
        ->where('company_department_name', $departamento )
        ->where('corr_prev_pos', $seguro_inseguro)
        ->count();

        return $seguro;
    }

    public function getDET($departamento)
    {
        //prioridad total DET
        $ci_det = DB::table('unsafe_conditions_records')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->whereDate('unsafe_conditions_records.created_at', date('Y-m').'-'.date('d'))
        ->where('companies_and_departments.name', $departamento )->count();
        return $ci_det;
    }

    public function getTRAT($departamento)
    {
        //prioridad completadas TRAT
        $ci_completa = DB::table('unsafe_conditions_records')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->whereDate('unsafe_conditions_records.updated_at', date('Y-m').'-'.date('d'))
        ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', $departamento)->count();
        return $ci_completa;
    }

    public function getPorcentaje($total, $secundario){
        $result = 0;
        if ($total) {
            $result = number_format(($secundario/$total)*100 ,0);
        }
        
        return $result;
    }

    public function getDetArea($departamento){
        //prioridad total DET
        $departamentoId = DB::table('companies_and_departments')->where('name', $departamento)->get()->all();
        $ci_det = DB::table('unsafe_conditions_records')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->where('unsafe_conditions_records.department_id', $departamentoId[0]->id)
        ->whereDate('unsafe_conditions_records.created_at', date('Y-m').'-'.date('d'))
        ->where('companies_and_departments.name', $departamento )->count();
        return $ci_det;
    }

    public function getParticipacionCI($departamento)
    {
        $people = DB::table('people')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->where('companies_and_departments.name', $departamento )
        ->where('people.status', 'ACTIVO')->count();
        
        $ci_departamento = DB::table('unsafe_conditions_records')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->whereDate('unsafe_conditions_records.created_at', date('Y-m').'-'.date('d'))
        ->where('companies_and_departments.name', $departamento )->count();

        $porcentaje = $this->getPorcentaje($people, $ci_departamento);

        return $porcentaje;
    }
}
