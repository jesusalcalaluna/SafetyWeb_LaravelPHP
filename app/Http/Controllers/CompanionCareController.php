<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Companies_and_departments;
use App\Models\Position;
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
        $people = People::all();

        return view('pages.dashboard.companionCare', compact('companies_departments', 'behaviors_group', 'act_types', 'gold_rules', 'people'));
    }

    public function writeCompanionCare(Request $request){
        
        //dd($request);
        DB::table('companion_care_records')->insert([
            'companion_to_care'=> $request->companion_to_care,
            'company_department_id' => $request->company_department_id,
            'position_id' => $request->position_id,

            'turn' => $request->turn,
            'shift_supervisor' => $request->shift_supervisor,
            'description' => $request->description,
            'corr_prev_pos' => $request->corr_prev_pos,

            'behavior_group_id' => $request->behavior_group_id,
            'acts_types_id' => $request->acts_types_id,
            
            'sif' => $request->sif,
            'gold_rules_id' => $request->gold_rules_id,

            'detection_source' => $request->detection_source,
            'department_where_happens_id' => $request->department_where_happens_id,
            'specific_area' => $request->specific_area,
            'informant_department_company_id' => $request->informant_department_company_id,
            'people_id' => $request->people_id,
        ]);

        return redirect(route('index'));
    }

    public function readCompanionCare(){
        $companion_care_record = Companion_care_record::with('company_department')
                                                        ->with('behavior_group')
                                                        ->with('position')
                                                        ->with('acts_types')
                                                        ->with('gold_rules')
                                                        ->with('department_where_happens')
                                                        ->with('informant_department_company')
                                                        ->with('people')->get();
                                                        //return $companion_care_record;

        return view('pages.dashboard.companionCareTable', compact('companion_care_record'));
    }

    public function updateCompanionCare(){

    }
}
