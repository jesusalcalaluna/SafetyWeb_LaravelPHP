<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Companies_and_departments;
use App\Models\Acts_type;
use App\Models\Behaviors_group;
use App\Models\Gold_rule;
use App\Models\People;
use App\Models\Companion_care_record;
use Database\Seeders\companiesAndDepartmentsSeeder;

class CompanionCareController extends Controller
{
    public function showWriteCompanionCare(){
        $companies_departments = Companies_and_departments::all();
        
        $act_types = Acts_type::all();
        $behaviors_group = Behaviors_group::all();
        $gold_rules = Gold_rule::all();
        $people = People::where('status', 'ACTIVO')->get();

        return view('pages.dashboard.companionCare', compact('companies_departments', 'behaviors_group', 'act_types', 'gold_rules', 'people'));
    }

    public function writeCompanionCare(Request $request){

        //return $request;
        
        try {
            $people_id = People::where('SAP', $request->people_sap)->first();
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal con tu sap, intentalo de nuevo.')->withInput();
        }
        

        try {

                Companion_care_record::create([
                    'companion_to_care_name' => $request->companion_to_care_name,
                    'company_department_name' => $request->company_department_name,
                    'position_name' => $request->position_name == NULL ? 'N/A' : $request->position_name,
        
                    'turn' => $request->turn,
                    'shift_supervisor' => $request->shift_supervisor,
                    'description' => $request->description,
                    'corr_prev_pos' => $request->corr_prev_pos,
        
                    'behavior_group_id' => $request->behavior_group_id,

                    'acts_types_id' => $request->acts_types_id  == NULL ? NULL : $request->acts_types_id,
                    
                    'sif' => $request->sif  == NULL ? 'N/A' : $request->sif,
                    'gold_rules_id' => $request->gold_rules_id  == NULL ? NULL : $request->gold_rules_id,
        
                    'detection_source' => $request->detection_source,
                    'department_where_happens_id' => $request->department_where_happens_id,
                    'specific_area' => $request->specific_area,
                    'people_id' => $people_id->id,
                ]);

        } catch (\Throwable $th) {
            //dd($th);
            return back()->with('error', 'Algo salio mal, intentalo de nuevo.')->withInput();
        }
        
        

        return back()->with('success', 'Registro exitoso');
    }

    public function readCompanionCare(){
        $companion_care_record = Companion_care_record::orderBy('id', 'DESC')
                                                        ->with('behavior_group')
                                                        ->with('acts_types')
                                                        ->with('gold_rules')
                                                        ->with('department_where_happens')
                                                        ->with('people')
                                                        ->with('people.company_and_department')
                                                        ->get();
                                                        //return $companion_care_record;

        return view('pages.dashboard.companionCareTable', compact('companion_care_record'));
    }

    public function updateCompanionCare(){
        return "";
    }
}
