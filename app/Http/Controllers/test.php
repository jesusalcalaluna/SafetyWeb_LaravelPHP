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

//use App\Exports\UnsafeConditionsExport;
//use Maatwebsite\Excel\Facades\Excel;

class test extends Controller
{
    public function test(){

        //return Excel::download(new UnsafeConditionsExport, 'Condiciones Inseguras.xlsx');

        date_default_timezone_set('America/Monterrey');

        $culturaDeSeguridadA = $this->getCultiraDeSeguridad(date("d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))), date("m", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))), date("Y", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))));
        $culturaDeSeguridadD = $this->getCultiraDeSeguridad(date("d", mktime(0, 0, 0, date("m")  , date("d"), date("Y"))), date("m", mktime(0, 0, 0, date("m")  , date("d"), date("Y"))), date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y"))));
        $culturaDeSeguridadM = $this->getCultiraDeSeguridad(null, date("m", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))), date("Y", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))));
        $culturaDeSeguridadY = $this->getCultiraDeSeguridad(null, null, date("Y", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))));

        return $culturaDeSeguridadA;
    }

    public function getCultiraDeSeguridad($dia, $mes, $anio){

        $compani_and_departments = DB::table('companies_and_departments')->get()->all();
        $departamentos = array();

        foreach ($compani_and_departments as $key => $value) {

            $det = $this->getDET($value->name, $dia, $mes, $anio);
            $trat = $this->getTRAT($value->name, $dia, $mes, $anio);
            $atencion = $this->getPorcentaje($det, $trat);
            $detArea = $this->getDetArea($value->name, $dia, $mes, $anio);
            $participacionCI = $this->getParticipacionCI($value->name, $dia, $mes, $anio);
            $inseguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO INSEGURO", $dia, $mes, $anio);
            $seguro = $this->getSeguroInseguroCC($value->name, "COMPORTAMIENTO SEGURO", $dia, $mes, $anio);
            $totalCuidadosArea = $this->getTotalCuidadosEnArea($value->name, $dia, $mes, $anio);
            $CCporArea = $this->getCCporArea($value->name, $dia, $mes, $anio);
            $participacionCC = $this->getParticipacionCC($value->name, $dia, $mes, $anio);

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

    public function getParticipacionCC($departamento, $dia, $mes, $anio)
    {
        $people = $this->getTotalPeopleActive($departamento);

        if ($dia == null && $mes == null && $anio) {
            $cc_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('companion_care_records', 'companion_care_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereYear('companion_care_records.created_at', $anio)
            ->get('people_id')
            ->groupBy('people_id')->count();
        }
        if ($dia ==null && $mes && $anio) {
            $cc_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('companion_care_records', 'companion_care_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereMonth('companion_care_records.created_at', $mes)
            ->whereYear('companion_care_records.created_at', $anio)
            ->get('people_id')
            ->groupBy('people_id')->count();
        }
        if ($dia && $mes && $anio) {

            $cc_departamento = DB::table('people')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->join('companion_care_records', 'companion_care_records.people_id', '=', 'people.id')
            ->where('people.status', 'ACTIVO')
            ->where('companies_and_departments.name', $departamento )
            ->whereDay('companion_care_records.created_at', $dia)
            ->whereMonth('companion_care_records.created_at', $mes)
            ->whereYear('companion_care_records.created_at', $anio)
            ->get('people_id')
            ->groupBy('people_id')->count();
        }

        $porcentaje = $this->getPorcentaje($people, $cc_departamento,1);

        return $porcentaje;
    }

    public function getCCporArea($departamento, $dia, $mes, $anio)
    {
        if ($dia == null && $mes == null && $anio) {
            $total = DB::table('companion_care_records')
                ->join('people', 'people.id', '=', 'companion_care_records.people_id')
                ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
                ->where('companies_and_departments.name', $departamento )
                ->whereYear('companion_care_records.created_at', $anio)
                ->count();

        }
        if ($dia ==null && $mes && $anio) {
            $total = DB::table('companion_care_records')
                ->join('people', 'people.id', '=', 'companion_care_records.people_id')
                ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
                ->where('companies_and_departments.name', $departamento )
                ->whereMonth('companion_care_records.created_at', $mes)
                ->whereYear('companion_care_records.created_at', $anio)
                ->count();
        }
        if ($dia && $mes && $anio) {
            $total = DB::table('companion_care_records')
                ->join('people', 'people.id', '=', 'companion_care_records.people_id')
                ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
                ->where('companies_and_departments.name', $departamento )
                ->whereDay('companion_care_records.created_at', $dia)
                ->whereMonth('companion_care_records.created_at', $mes)
                ->whereYear('companion_care_records.created_at', $anio)
                ->count();
        }

        return $total;
    }

    public function getTotalCuidadosEnArea($departamento, $dia, $mes, $anio)
    {

        if ($dia == null && $mes == null && $anio) {

            $total = DB::table('companion_care_records')
                ->join('companies_and_departments','companies_and_departments.id','=', 'companion_care_records.department_where_happens_id')
                ->where('companies_and_departments.name', $departamento )
                ->whereYear('companion_care_records.created_at', $anio)
                ->count();
        }
        if ($dia == null && $mes && $anio) {

            $total = DB::table('companion_care_records')
                ->join('companies_and_departments','companies_and_departments.id','=', 'companion_care_records.department_where_happens_id')
                ->where('companies_and_departments.name', $departamento )
                ->whereMonth('ccompanion_care_records.reated_at', $mes)
                ->whereYear('companion_care_records.created_at', $anio)
                ->count();
        }
        if ($dia && $mes && $anio){
            $total = DB::table('companion_care_records')
                ->join('companies_and_departments','companies_and_departments.id','=', 'companion_care_records.department_where_happens_id')
                ->where('companies_and_departments.name', $departamento )
                ->whereDay('companion_care_records.created_at', $dia)
                ->whereMonth('companion_care_records.created_at', $mes)
                ->whereYear('companion_care_records.created_at', $anio)
                ->count();
        }


        return $total;
    }

    public function getSeguroInseguroCC($departamento, $seguro_inseguro, $dia, $mes, $anio)
    {
        if ($dia == null && $mes == null && $anio) {
            $seguro = DB::table('companion_care_records')
                ->where('company_department_name', $departamento )
                ->where('corr_prev_pos', $seguro_inseguro)
                ->whereYear('created_at', $anio)
                ->count();
        }
        if ($dia == null && $mes && $anio) {
            $seguro = DB::table('companion_care_records')
                ->where('company_department_name', $departamento )
                ->where('corr_prev_pos', $seguro_inseguro)
                ->whereMonth('created_at', $mes)
                ->whereYear('created_at', $anio)
                ->count();
        }
        if ($dia && $mes && $anio) {
            $seguro = DB::table('companion_care_records')
            ->where('company_department_name', $departamento )
            ->where('corr_prev_pos', $seguro_inseguro)
            ->whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $anio)
            ->count();
        }


        return $seguro;
    }

    public function getDET($departamento, $dia, $mes, $anio)//lista
    {
        if ($dia == null && $mes == null && $anio) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereYear('unsafe_conditions_records.created_at', $anio)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia == null && $mes && $anio) {
            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $anio)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        if ($dia && $mes && $anio) {

            $ci_det = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereDay('unsafe_conditions_records.created_at', $dia)
            ->whereMonth('unsafe_conditions_records.created_at', $mes)
            ->whereYear('unsafe_conditions_records.created_at', $anio)
            ->where('companies_and_departments.name', $departamento )->count();
        }
        //prioridad total DET

        return $ci_det;
    }

    public function getTRAT($departamento, $dia, $mes, $anio)
    {
        if ($dia == null && $mes == null && $anio) {
            $ci_completa = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereYear('unsafe_conditions_records.completed_at', $anio)
            ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', $departamento)->count();
        }
        if ($dia == null && $mes && $anio) {
            $ci_completa = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereMonth('unsafe_conditions_records.completed_at', $mes)
            ->whereYear('unsafe_conditions_records.completed_at', $anio)
            ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', $departamento)->count();
        }
        if ($dia && $mes && $anio) {
            $ci_completa = DB::table('unsafe_conditions_records')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'unsafe_conditions_records.department_id')
            ->whereDay('unsafe_conditions_records.completed_at', $dia)
            ->whereMonth('unsafe_conditions_records.completed_at', $mes)
            ->whereYear('unsafe_conditions_records.completed_at', $anio)
            ->where('unsafe_conditions_records.status', 'COMPLETA')->where('companies_and_departments.name', $departamento)->count();
            }

            return $ci_completa;
    }

    public function getPorcentaje($total, $secundario, $decimals = 0){
        $result = 0;
        if ($total) {
            $result = number_format(($secundario/$total)*100 ,$decimals);
        }

        return $result;
    }

    public function getDetArea($departamento, $dia, $mes, $anio): int
    {

        if ($dia == null && $mes == null && $anio) {
            $ci_det = DB::table('unsafe_conditions_records')
                ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
                ->join('companies_and_departments as people_department','people_department.id','=', 'people.companie_and_department_id')
                ->join('companies_and_departments as uc_department', 'uc_department.id', '=', 'unsafe_conditions_records.department_id')
                ->where('people_department.name', $departamento)
                ->where('uc_department.name', $departamento )
                ->whereYear('unsafe_conditions_records.created_at', $anio)
                ->count();
        }
        if ($dia == null && $mes && $anio) {
            $ci_det = DB::table('unsafe_conditions_records')
                ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
                ->join('companies_and_departments as people_department','people_department.id','=', 'people.companie_and_department_id')
                ->join('companies_and_departments as uc_department', 'uc_department.id', '=', 'unsafe_conditions_records.department_id')
                ->where('people_department.name', $departamento)
                ->where('uc_department.name', $departamento )
                ->whereMonth('unsafe_conditions_records.created_at', $mes)
                ->whereYear('unsafe_conditions_records.created_at', $anio)
                ->count();
        }
        if ($dia && $mes && $anio) {

            $ci_det = DB::table('unsafe_conditions_records')
                ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
                ->join('companies_and_departments as people_department','people_department.id','=', 'people.companie_and_department_id')
                ->join('companies_and_departments as uc_department', 'uc_department.id', '=', 'unsafe_conditions_records.department_id')
                ->where('people_department.name', $departamento)
                ->where('uc_department.name', $departamento )
                ->whereDay('unsafe_conditions_records.created_at', $dia)
                ->whereMonth('unsafe_conditions_records.created_at', $mes)
                ->whereYear('unsafe_conditions_records.created_at', $anio)
                ->count();
        }

        return $ci_det;
    }

    public function getParticipacionCI($departamento, $dia, $mes, $anio)
    {
        $peopleTotal = $this->getTotalPeopleActive($departamento);

        if ($dia == null && $mes == null && $anio) {
            $ci_departamento = DB::table('people')
                ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
                ->join('unsafe_conditions_records', 'unsafe_conditions_records.people_id', '=', 'people.id')
                ->where('people.status', 'ACTIVO')
                ->where('companies_and_departments.name', $departamento )
                ->whereYear('unsafe_conditions_records.created_at', $anio)
                ->get('people_id')
                ->groupBy('people_id')->count();

        }
        if ($dia == null && $mes && $anio) {
            $ci_departamento = DB::table('people')
                ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
                ->join('unsafe_conditions_records', 'unsafe_conditions_records.people_id', '=', 'people.id')
                ->where('people.status', 'ACTIVO')
                ->where('companies_and_departments.name', $departamento )
                ->whereMonth('unsafe_conditions_records.created_at', $mes)
                ->whereYear('unsafe_conditions_records.created_at', $anio)
                ->get('people_id')
                ->groupBy('people_id')->count();
        }
        if ($dia && $mes && $anio) {
            $ci_departamento = DB::table('people')
                ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
                ->join('unsafe_conditions_records', 'unsafe_conditions_records.people_id', '=', 'people.id')
                ->where('people.status', 'ACTIVO')
                ->where('companies_and_departments.name', $departamento )
                ->whereDay('unsafe_conditions_records.created_at', $dia)
                ->whereMonth('unsafe_conditions_records.created_at', $mes)
                ->whereYear('unsafe_conditions_records.created_at', $anio)
                ->get('people_id')
                ->groupBy('people_id')->count();
        }


        $porcentaje = $this->getPorcentaje($peopleTotal, $ci_departamento,1);

        return $porcentaje;
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
