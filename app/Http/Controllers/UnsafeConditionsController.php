<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use Illuminate\Http\Request;
use App\Models\Condition_group;
use App\Models\Type_condition;
use App\Models\Companies_and_departments;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Type\Integer;

class UnsafeConditionsController extends Controller
{
    public function showWriteUnsafeConditions(){
        $condition_groups = Condition_group::all();
        $type_conditions = Type_condition::all();
        $departments = Companies_and_departments::all();
        $people = People::where('status', 'ACTIVO')->get();
        $peopleSupervisores = People::where('status', 'ACTIVO')
        ->orWhere("position", 'LIKE','%asesor%')
        ->orWhere("position", 'LIKE','%gerente%')
        ->orWhere("position", 'LIKE','%supervisor%')->get();
        return view('pages.dashboard.unsafeConditionsForm', compact('condition_groups', 'type_conditions', 'departments', 'people', 'peopleSupervisores'));
    }

    public function writeUnsafeConditions(Request $request){
        try {
            $request->validate([
                'condition_detected' => 'required',
                'type_condition_id' => 'required',
                'detection_origin' => 'required',
                'deadline' => 'required',
                'department_id' => 'required',
                'responsable_id' => 'required',
                'area' => 'required',
                'probability' => 'required',
                'impact' => 'required',
                'frequency' => 'required',
                'scope' => 'required',
                'notice_number' => 'required',
                'sap' => 'required',
                'status' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Falta un campo por llenar')->withInput();
        }


        $person = People::where('sap', $request->sap)->first();

        $risk = $request->probability * $request->impact * $request->frequency;
        $risk_type = "";
        $attention_priority = "";

        if ($risk > 0 && $risk <= 20) {
            $risk_type = "RIESGO LIGERO";
            $attention_priority = "BAJA";
        }
        if ($risk > 20 && $risk <= 70) {
            $risk_type = "POSIBLE RIESGO";
            $attention_priority = "BAJA";
        }
        if ($risk > 70 && $risk <= 200) {
            $risk_type = "RIESGO SUSTANCIAL";
            $attention_priority = "MEDIA";
        }
        if ($risk > 200 && $risk <= 400) {
            $risk_type = "RIESGO ALTO";
            $attention_priority = "ALTA";
        }
        if ($risk > 400) {
            $risk_type = "RIESGO MUY ALTO";
            $attention_priority = "CRÍTICA";
        }
        try {
            if ($request->status == "COMPLETA") {
                $unsafeCondition = Unsafe_conditions_record::create([
                    'status' => $request->status,
                    'condition_detected' => $request->condition_detected,
                    'type_condition_id' => $request->type_condition_id,
                    'detection_origin' => $request->detection_origin,
                    'deadline' => $request->deadline,
                    'department_id' => $request->department_id,
                    'responsable_id' => $request->responsable_id,
                    'area' => $request->area,
                    'probability' => $request->probability,
                    'impact' => $request->impact,
                    'frequency' => $request->frequency,
                    'risk' => $risk,
                    'risk_type' => $risk_type,
                    'attention_priority' => $attention_priority,
                    'scope' => $request->scope,
                    'notice_number' => $request->notice_number,
                    'people_id' => $person->id,
                    'completed_at' => date("Y-m-d G:i:s"),
                ]);
            }else {
                $unsafeCondition = Unsafe_conditions_record::create([
                    'status' => $request->status,
                    'condition_detected' => $request->condition_detected,
                    'type_condition_id' => $request->type_condition_id,
                    'detection_origin' => $request->detection_origin,
                    'deadline' => $request->deadline,
                    'department_id' => $request->department_id,
                    'responsable_id' => $request->responsable_id,
                    'area' => $request->area,
                    'probability' => $request->probability,
                    'impact' => $request->impact,
                    'frequency' => $request->frequency,
                    'risk' => $risk,
                    'risk_type' => $risk_type,
                    'attention_priority' => $attention_priority,
                    'scope' => $request->scope,
                    'notice_number' => $request->notice_number,
                    'people_id' => $person->id,
                ]);
            }



        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal, reportalo.')->withInput();
        }

        return back()->with('success', 'Registro exitoso');
    }

    public function readUnsafeConditions(){
        $unsafeConditionRecord = "";

        if (Auth::user()->role->hierarchy <= 1) {
            $unsafeConditionRecord = Unsafe_conditions_record::orderBy('id', 'DESC')
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();

            if($unsafeConditionRecord){
                $countCom = Unsafe_conditions_record::where('status', 'COMPLETA')->get()->count();
                $countProc = Unsafe_conditions_record::where('status', 'EN PROCESO')->get()->count();
                $countInic = Unsafe_conditions_record::where('status', 'NO INICIADA')->get()->count();
                $countRetr = Unsafe_conditions_record::where('status', 'RETRASADA')->get()->count();

                $total = $countProc + $countInic + $countCom + $countRetr;

                if($total) {
                    $porcentCom  = number_format(($countCom / $total) * 100, 1);
                    $porcentProc  =  number_format(($countProc / $total) * 100, 1);
                    $porcentInic  =  number_format(($countInic / $total) * 100, 1);
                    $porcentRetr  =  number_format(($countRetr / $total) * 100, 1);
                }else {
                    $porcentCom  =  0;
                    $porcentProc  =  0;
                    $porcentInic  =  0;
                    $porcentRetr  =  0;
                }

            }
        }
        else {
            $unsafeConditionRecord = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->orderBy('id', 'DESC')
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();

            if($unsafeConditionRecord){
                $countCom = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'COMPLETA')->get()->count();
                $countProc = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'EN PROCESO')->get()->count();
                $countInic = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'NO INICIADA')->get()->count();
                $countRetr = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'RETRASADA')->get()->count();

                $total = $countProc + $countInic + $countCom + $countRetr;

                if($total) {
                    $porcentCom  = number_format(($countCom / $total) * 100, 1);
                    $porcentProc  =  number_format(($countProc / $total) * 100, 1);
                    $porcentInic  =  number_format(($countInic / $total) * 100, 1);
                    $porcentRetr  =  number_format(($countRetr / $total) * 100, 1);
                }else {
                    $porcentCom  =  0;
                    $porcentProc  =  0;
                    $porcentInic  =  0;
                    $porcentRetr  =  0;
                }

            }
        }

        return view('pages.dashboard.unsafeConditionsTable', compact('unsafeConditionRecord', 'porcentCom', 'porcentProc', 'porcentInic', 'porcentRetr'));
    }

    public function updateUnsafeConditions(Request $request){
        date_default_timezone_set('America/Monterrey');
        $unsafeCondition = Unsafe_conditions_record::where('id', $request->id)->get();

        if( $request->status != $unsafeCondition[0]->status){
            if ($request->status == "COMPLETA") {
                $unsafeCondition = Unsafe_conditions_record::where('id', $request->id)
                                ->update(['status' => $request->status,
                                'completed_at' => date("Y-m-d G:i:s")]);
            }else {
                $unsafeCondition = Unsafe_conditions_record::where('id', $request->id)
                                ->update(['status' => $request->status]);
            }
        }
        //Calcular porcentaje nuevo de estado
        if (Auth::user()->role->hierarchy <= 1) {
            $unsafeConditionRecord = Unsafe_conditions_record::orderBy('id', 'DESC')
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();


            if($unsafeConditionRecord){
                $countCom = Unsafe_conditions_record::where('status', 'COMPLETA')->get()->count();
                $countProc = Unsafe_conditions_record::where('status', 'EN PROCESO')->get()->count();
                $countInic = Unsafe_conditions_record::where('status', 'NO INICIADA')->get()->count();
                $countRetr = Unsafe_conditions_record::where('status', 'RETRASADA')->get()->count();

                $total = $countProc + $countInic + $countCom + $countRetr;

                if($total) {
                    $porcentCom  = number_format(($countCom / $total) * 100, 1);
                    $porcentProc  =  number_format(($countProc / $total) * 100, 1);
                    $porcentInic  =  number_format(($countInic / $total) * 100, 1);
                    $porcentRetr  =  number_format(($countRetr / $total) * 100, 1);
                }else {
                    $porcentCom  =  0;
                    $porcentProc  =  0;
                    $porcentInic  =  0;
                    $porcentRetr  =  0;
                }

            }
        }
        else {
            $unsafeConditionRecord = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->orderBy('id', 'DESC')
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();

            if($unsafeConditionRecord){
                $countCom = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'COMPLETA')->get()->count();
                $countProc = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'EN PROCESO')->get()->count();
                $countInic = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'NO INICIADA')->get()->count();
                $countRetr = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'RETRASADA')->get()->count();

                $total = $countProc + $countInic + $countCom + $countRetr;

                if($total) {
                    $porcentCom  = number_format(($countCom / $total) * 100, 1);
                    $porcentProc  =  number_format(($countProc / $total) * 100, 1);
                    $porcentInic  =  number_format(($countInic / $total) * 100, 1);
                    $porcentRetr  =  number_format(($countRetr / $total) * 100, 1);
                }else {
                    $porcentCom  =  0;
                    $porcentProc  =  0;
                    $porcentInic  =  0;
                    $porcentRetr  =  0;
                }

            }
        }

        //regresamos nuevo porcentaje de estados
        $response = array('porcentCom' => $porcentCom,
        'porcentProc' => $porcentProc,
        'porcentInic' => $porcentInic,
        'porcentRetr' => $porcentRetr,
        'unsafeCondition' => $unsafeCondition,
        //fin de porcentaje de estados
     );

        return $response;

    }

    public function getUpdate($id){
        $unsafeCondition = Unsafe_conditions_record::where('id', $id)
            ->with('reporter')
            ->first();
        $condition_groups = Condition_group::all();
        $type_conditions = Type_condition::all();
        $departments = Companies_and_departments::all();
        $people = People::where('status', 'ACTIVO')->get();
        $peopleSupervisores = People::where('status', 'ACTIVO')
            ->orWhere("position", 'LIKE','%asesor%')
            ->orWhere("position", 'LIKE','%gerente%')
            ->orWhere("position", 'LIKE','%supervisor%')->get();
        return view('pages.dashboard.unsafeCondition.updateUnsafeConditions', compact('unsafeCondition','condition_groups', 'type_conditions', 'departments', 'people', 'peopleSupervisores'));

    }

    public function postUpdate(Request  $request){
        date_default_timezone_set('America/Monterrey');

        Unsafe_conditions_record::where('id', $request->id)
            ->update(['notice_number' => $request->notice_number,]);

        return redirect(route('unsafeConditionDetails', [$request->id])) ;

    }

    public function readUnsafeConditionDetails($id){

        $unsafeConditionRecord = Unsafe_conditions_record::with('type_condition')
        ->with('type_condition.condition_group')
        ->with('responsable')
        ->with('department')
        ->with('reporter')
        ->with('reporter.company_and_department')
        ->where('id', $id)->get();

        return view('pages.dashboard.unsafeConditionDetails', compact('unsafeConditionRecord'));
    }

    public function search($word){
        $unsafeConditionRecord = Unsafe_conditions_record::orderBy('id', 'DESC')
                ->where('status','LIKE','%'.$word.'%')
                ->orWhere('condition_detected','LIKE','%'.$word.'%')
                ->orWhere('detection_origin','LIKE','%'.$word.'%')
                ->orWhere('deadline','LIKE','%'.$word.'%')
                ->orWhere('area','LIKE','%'.$word.'%')
                ->orWhere('risk','LIKE','%'.$word.'%')
                ->orWhere('risk_type','LIKE','%'.$word.'%')
                ->orWhere('attention_priority','LIKE','%'.$word.'%')
                ->orWhere('scope','LIKE','%'.$word.'%')
                ->orWhere('notice_number','LIKE','%'.$word.'%')
                ->with('type_condition')
                ->with('type_condition.condition_group')
                ->with('responsable')
                ->with('department')
                ->with('reporter')
                ->with('reporter.company_and_department')
                ->get();


                return view('pages.dashboard.unsafeConditionsTable', compact('unsafeConditionRecord'));
    }

    public function getUnsafeConditionByStatus($status){


        if (Auth::user()->role->hierarchy <= 1) {

            $unsafeConditionRecord = Unsafe_conditions_record::orderBy('id', 'DESC')
                                ->where('status', $status)
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();


            if($unsafeConditionRecord){
                $countCom = Unsafe_conditions_record::where('status', 'COMPLETA')->get()->count();
                $countProc = Unsafe_conditions_record::where('status', 'EN PROCESO')->get()->count();
                $countInic = Unsafe_conditions_record::where('status', 'NO INICIADA')->get()->count();
                $countRetr = Unsafe_conditions_record::where('status', 'RETRASADA')->get()->count();

                $total = $countProc + $countInic + $countCom + $countRetr;

                if($total) {
                    $porcentCom  = number_format(($countCom / $total) * 100, 1);
                    $porcentProc  =  number_format(($countProc / $total) * 100, 1);
                    $porcentInic  =  number_format(($countInic / $total) * 100, 1);
                    $porcentRetr  =  number_format(($countRetr / $total) * 100, 1);
                }else {
                    $porcentCom  =  0;
                    $porcentProc  =  0;
                    $porcentInic  =  0;
                    $porcentRetr  =  0;
                }

            }

        } else {

            $unsafeConditionRecord = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->orderBy('id', 'DESC')
                                ->where('status', $status)
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();

            if($unsafeConditionRecord){
                $countCom = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'COMPLETA')->get()->count();
                $countProc = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'EN PROCESO')->get()->count();
                $countInic = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'NO INICIADA')->get()->count();
                $countRetr = Unsafe_conditions_record::where('department_id', Auth::user()->person->company_and_department->id)->where('status', 'RETRASADA')->get()->count();

                $total = $countProc + $countInic + $countCom + $countRetr;

                if($total) {
                    $porcentCom  = number_format(($countCom / $total) * 100, 1);
                    $porcentProc  =  number_format(($countProc / $total) * 100, 1);
                    $porcentInic  =  number_format(($countInic / $total) * 100, 1);
                    $porcentRetr  =  number_format(($countRetr / $total) * 100, 1);
                }else {
                    $porcentCom  =  0;
                    $porcentProc  =  0;
                    $porcentInic  =  0;
                    $porcentRetr  =  0;
                }

            }
        }
                return view('pages.dashboard.unsafeConditionsTable', compact('unsafeConditionRecord', 'porcentCom', 'porcentProc', 'porcentInic', 'porcentRetr'));
    }

    public function deleteUnsafeCondition(Request $request){
        try {
            $unsafecondition = Unsafe_conditions_record::where('id', $request->id)->first();
            $unsafecondition->delete();
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal, reportalo.');
        }
        return redirect(route('getUnsafeConditions'))->with('success', 'Eliminación exitosa');

    }

    public function export(Request $request){

        $uc = DB::table('unsafe_conditions_records')
            ->join('type_conditions', 'type_conditions.id','=', 'unsafe_conditions_records.type_condition_id')
            ->join('condition_groups', 'condition_groups.id', '=', 'type_conditions.condition_group_id')
            ->join('people as people_responsable', 'people_responsable.id', '=', 'unsafe_conditions_records.responsable_id',)
            ->join('companies_and_departments as  department','department.id','=', 'unsafe_conditions_records.department_id')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereDay('created_at', 'LIKE', '%'.$request->date.'%')
            ->whereMonth('created_at', 'LIKE', '%'.$request->date.'%')
            ->whereYear('created_at', 'LIKE', '%'.$request->date.'%')
            ->select('unsafe_conditions_records.id',
                'unsafe_conditions_records.created_at',
                'unsafe_conditions_records.condition_detected',
                'condition_groups.group_name',
                'type_conditions.action_name',
                'unsafe_conditions_records.detection_origin',
                'unsafe_conditions_records.deadline',
                'people_responsable.name',
                'department.name',
                'unsafe_conditions_records.area',
                'unsafe_conditions_records.status',
                'unsafe_conditions_records.probability',
                'unsafe_conditions_records.frequency',
                'unsafe_conditions_records.impact',
                'unsafe_conditions_records.risk',
                'unsafe_conditions_records.risk_type',
                'unsafe_conditions_records.attention_priority',
                'unsafe_conditions_records.scope',
                'unsafe_conditions_records.notice_number',
                'people.name',
                'companies_and_departments.name',
                'people.position')
            ->get();
        $exportUC = new CollectionExport($uc);
        return Excel::download($exportUC,'Condiciones Inseguras '.date('d-m-Y').'.xlsx');

    }

}
