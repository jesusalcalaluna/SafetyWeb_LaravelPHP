<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condition_group;
use App\Models\Type_condition;
use App\Models\Companies_and_departments;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use Ramsey\Uuid\Type\Integer;

class UnsafeConditionsController extends Controller
{
    public function showWriteUnsafeConditions(){
        $condition_groups = Condition_group::all();
        $type_conditions = Type_condition::all();
        $departments = Companies_and_departments::all();
        $people = People::all();
        return view('pages.dashboard.unsafeConditionsForm', compact('condition_groups', 'type_conditions', 'departments', 'people'));
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
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Falta un campo por llenar');
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
            $unsafeCondition = Unsafe_conditions_record::create([
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
                'person_id' => $person->id,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal, intentalo de nuevo.');
        }
        
        return back()->with('success', 'Registro exitoso');
    }

    public function readUnsafeConditions(){
         
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
        
        

             

                                
        return view('pages.dashboard.unsafeConditionsTable', compact('unsafeConditionRecord', 'porcentCom', 'porcentProc', 'porcentInic', 'porcentRetr'));
    }

    public function updateUnsafeConditions(Request $request){
        $unsafeCondition = Unsafe_conditions_record::where('id', $request->id)->get();
        
        if( $request->status == $unsafeCondition[0]->status){
            return $unsafeCondition;
        }
        $unsafeCondition = Unsafe_conditions_record::where('id', $request->id)
                            ->update(['status' => $request->status]);

        return $unsafeCondition;
        
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

        $result = Unsafe_conditions_record::orderBy('id', 'DESC')
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();
        
        $countCom = Unsafe_conditions_record::where('status', 'COMPLETA')->get()->count();
        $countProc = Unsafe_conditions_record::where('status', 'EN PROCESO')->get()->count();
        $countInic = Unsafe_conditions_record::where('status', 'NO INICIADA')->get()->count();
        $countRetr = Unsafe_conditions_record::where('status', 'RETRASADA')->get()->count();

        $total = $countProc + $countInic + $countCom + $countRetr;
        $porcentCom  =  0;
        $porcentProc  =  0;
        $porcentInic  =  0;
        $porcentRetr  =  0;  
            
        if($total) {
            $porcentCom  = number_format(($countCom / $total) * 100, 1);
            $porcentProc  =  number_format(($countProc / $total) * 100, 1);
            $porcentInic  =  number_format(($countInic / $total) * 100, 1);
            $porcentRetr  =  number_format(($countRetr / $total) * 100, 1);   
        }
        $unsafeConditionRecord = Unsafe_conditions_record::orderBy('id', 'DESC')
                                ->where('status', $status)
                                ->with('type_condition')
                                ->with('responsable')
                                ->with('department')
                                ->with('reporter')
                                ->get();
                return view('pages.dashboard.unsafeConditionsTable', compact('unsafeConditionRecord', 'porcentCom', 'porcentProc', 'porcentInic', 'porcentRetr'));
    }

}
