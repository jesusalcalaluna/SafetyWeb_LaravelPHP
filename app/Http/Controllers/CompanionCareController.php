<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Companies_and_departments;
use App\Models\Acts_type;
use App\Models\Behaviors_group;
use App\Models\Gold_rule;
use App\Models\People;
use App\Models\Companion_care_record;
use Database\Seeders\companiesAndDepartmentsSeeder;
use Maatwebsite\Excel\Facades\Excel;

class CompanionCareController extends Controller
{
    public function showWriteCompanionCare(){//formulario
        $companies_departments = Companies_and_departments::where('status', true)->get();

        $act_types = Acts_type::all();
        $behaviors_group = Behaviors_group::where('status', true)->get();
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

    public function getUpdate(){
        return "";
    }

    public function postUpdate(Request $request){
        return "";
    }

    public function postDelete(Request $request){
        Companion_care_record::find($request->id)->forceDelete();
    }

    public function export_Yesterday(){

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));

        $uc = DB::table('companion_care_records')
            ->leftJoin('behaviors_groups', 'behaviors_groups.id', '=', 'companion_care_records.behavior_group_id')
            ->leftJoin('acts_types', 'acts_types.id', '=', 'companion_care_records.acts_types_id')
            ->leftJoin('gold_rules', 'gold_rules.id', '=', 'companion_care_records.gold_rules_id')
            ->leftJoin('companies_and_departments', 'companies_and_departments.id', '=', 'companion_care_records.department_where_happens_id')
            ->leftJoin('people', 'people.id', '=', 'companion_care_records.people_id')
            ->leftJoin('companies_and_departments as people_department', 'people_department.id', '=', 'people.companie_and_department_id')
            ->whereDate('companion_care_records.created_at',  $date)
            ->select('companion_care_records.companion_to_care_name',
                'companion_care_records.company_department_name',
                'companion_care_records.position_name',
                'companion_care_records.turn',
                'companion_care_records.shift_supervisor',
                'companion_care_records.description',
                'companion_care_records.corr_prev_pos',
                'behaviors_groups.group_name',
                'acts_types.type_name',
                'companion_care_records.sif',
                'gold_rules.rule_name',
                'companion_care_records.detection_source',
                'companies_and_departments.name',
                'companion_care_records.specific_area',
                'people.name',
                'people_department.name',
                'companion_care_records.created_at')
            ->get();

        $exportUC = new CollectionExport($uc);

        return Excel::download($exportUC,'Condiciones Inseguras DIA '.$date.'.xlsx');

    }

    public function export_Month(){

        $month = date("m", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $year = date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $uc = DB::table('companion_care_records')
            ->leftJoin('behaviors_groups', 'behaviors_groups.id', '=', 'companion_care_records.behavior_group_id')
            ->leftJoin('acts_types', 'acts_types.id', '=', 'companion_care_records.acts_types_id')
            ->leftJoin('gold_rules', 'gold_rules.id', '=', 'companion_care_records.gold_rules_id')
            ->leftJoin('companies_and_departments', 'companies_and_departments.id', '=', 'companion_care_records.department_where_happens_id')
            ->leftJoin('people', 'people.id', '=', 'companion_care_records.people_id')
            ->leftJoin('companies_and_departments as people_department', 'people_department.id', '=', 'people.companie_and_department_id')
            ->whereMonth('companion_care_records.created_at',  $month)
            ->whereYear('companion_care_records.created_at',  $year)
            ->select('companion_care_records.companion_to_care_name',
                'companion_care_records.company_department_name',
                'companion_care_records.position_name',
                'companion_care_records.turn',
                'companion_care_records.shift_supervisor',
                'companion_care_records.description',
                'companion_care_records.corr_prev_pos',
                'behaviors_groups.group_name',
                'acts_types.type_name',
                'companion_care_records.sif',
                'gold_rules.rule_name',
                'companion_care_records.detection_source',
                'companies_and_departments.name',
                'companion_care_records.specific_area',
                'people.name',
                'people_department.name',
                'companion_care_records.created_at')
            ->get();

        $exportUC = new CollectionExport($uc);

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        return Excel::download($exportUC,'Cuidado del Compañero MES '.$date.'.xlsx');

    }

    public function export_Year(){

        //$date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $year = date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $uc = DB::table('companion_care_records')
            ->leftJoin('behaviors_groups', 'behaviors_groups.id', '=', 'companion_care_records.behavior_group_id')
            ->leftJoin('acts_types', 'acts_types.id', '=', 'companion_care_records.acts_types_id')
            ->leftJoin('gold_rules', 'gold_rules.id', '=', 'companion_care_records.gold_rules_id')
            ->leftJoin('companies_and_departments', 'companies_and_departments.id', '=', 'companion_care_records.department_where_happens_id')
            ->leftJoin('people', 'people.id', '=', 'companion_care_records.people_id')
            ->leftJoin('companies_and_departments as people_department', 'people_department.id', '=', 'people.companie_and_department_id')
            ->whereYear('unsafe_conditions_records.created_at',  $year)
            ->select('companion_care_records.companion_to_care_name',
                'companion_care_records.company_department_name',
                'companion_care_records.position_name',
                'companion_care_records.turn',
                'companion_care_records.shift_supervisor',
                'companion_care_records.description',
                'companion_care_records.corr_prev_pos',
                'behaviors_groups.group_name',
                'acts_types.type_name',
                'companion_care_records.sif',
                'gold_rules.rule_name',
                'companion_care_records.detection_source',
                'companies_and_departments.name',
                'companion_care_records.specific_area',
                'people.name',
                'people_department.name',
                'companion_care_records.created_at')
            ->get();

        $exportUC = new CollectionExport($uc);

        return Excel::download($exportUC,'Cuidado del Compañero '.$year.'.xlsx');

    }

    public function export_all(){

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

        $uc = DB::table('companion_care_records')
            ->leftJoin('behaviors_groups', 'behaviors_groups.id', '=', 'companion_care_records.behavior_group_id')
            ->leftJoin('acts_types', 'acts_types.id', '=', 'companion_care_records.acts_types_id')
            ->leftJoin('gold_rules', 'gold_rules.id', '=', 'companion_care_records.gold_rules_id')
            ->leftJoin('companies_and_departments', 'companies_and_departments.id', '=', 'companion_care_records.department_where_happens_id')
            ->leftJoin('people', 'people.id', '=', 'companion_care_records.people_id')
            ->leftJoin('companies_and_departments as people_department', 'people_department.id', '=', 'people.companie_and_department_id')
            ->select('companion_care_records.companion_to_care_name',
                'companion_care_records.company_department_name',
                'companion_care_records.position_name',
                'companion_care_records.turn',
                'companion_care_records.shift_supervisor',
                'companion_care_records.description',
                'companion_care_records.corr_prev_pos',
                'behaviors_groups.group_name',
                'acts_types.type_name',
                'companion_care_records.sif',
                'gold_rules.rule_name',
                'companion_care_records.detection_source',
                'companies_and_departments.name',
                'companion_care_records.specific_area',
                'people.name',
                'people_department.name',
                'companion_care_records.created_at')
            ->get();

        $exportUC = new CollectionExport($uc);

        return Excel::download($exportUC,'Cuidado del compañero TODO '.$date.'.xlsx');

    }

}
