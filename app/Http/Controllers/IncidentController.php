<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use Illuminate\Http\Request;
use App\Models\Companies_and_departments;
use App\Models\IncidentType;
use App\Models\Incident;
use App\Models\IncidentRecord;
use App\Models\People;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IncidentController extends Controller
{
    public function getForm()
    {
        $incident = Incident::all();
        $incidentType = IncidentType::all();
        $departments = Companies_and_departments::all();
        $people = People::where('status', 'ACTIVO')->get();
        return view('pages.dashboard.Incidents.incidentsRecordForm', compact('incident', 'incidentType', 'departments', 'people'));
    }

    public function setIncidentRecord(Request $request)
    {

        try {
            $person = People::where('sap', $request->sap)->first();
            IncidentRecord::create([
                'sif' => $request->sif,
                'classification' => $request->classification,
                'event_date' => $request->event_date,
                'description' => $request->description,
                'department_id' => $request->department_id,
                'spesific_area' => $request->spesific_area,
                'incident_id' => $request->incident_id,
                'incident_reason'=> $request->incident_reason,
                'reason_description' => $request->reason_description,
                'involbed_people_names' => $request->involbed_people_names,
                'solution_description' => $request->solution_description,
                'people_id' => $person->id,
            ]);
        } catch (\Throwable $th) {

            return back()->with('error', 'Algo salio mal, intentalo de nuevo.');
        }
        return back()->with('success', 'Registro exitoso');
    }

    public function getIncidenteTable()
    {
        $incidents = IncidentRecord::with('incident')->with('incident.incident_type')->with('department')->with('reporter')->get();

        return view('pages.dashboard.Incidents.incidentsRecordTable', compact('incidents'));
    }

    public function getIncidentDetails($id)
    {
        $IDatails = IncidentRecord::with('incident')
        ->with('incident.incident_type')
        ->with('department')
        ->with('reporter')
        ->with('reporter.company_and_department')
        ->where('id', $id)->get();

        return view('pages.dashboard.Incidents.incidentsRecordDetails', compact('IDatails'));
    }

    public function updateIncident(Request $request)
    {
        $incident = IncidentRecord::where('id', $request->id)->get();

        if( $request->status == $incident[0]->status){
            return $incident;
        }
        $incident = IncidentRecord::where('id', $request->id)
                            ->update(['status' => $request->status]);
    }

    public function export_Yesterday(){

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));

        $uc = DB::table('unsafe_conditions_records')
            ->join('type_conditions', 'type_conditions.id','=', 'unsafe_conditions_records.type_condition_id')
            ->join('condition_groups', 'condition_groups.id', '=', 'type_conditions.condition_group_id')
            ->join('people as people_responsable', 'people_responsable.id', '=', 'unsafe_conditions_records.responsable_id',)
            ->join('companies_and_departments as  department','department.id','=', 'unsafe_conditions_records.department_id')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereDate('unsafe_conditions_records.created_at',  $date)
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

        return Excel::download($exportUC,'Condiciones Inseguras '.$date.'.xlsx');

    }

    public function export_Month(){

        $month = date("m", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $year = date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $uc = DB::table('unsafe_conditions_records')
            ->join('type_conditions', 'type_conditions.id','=', 'unsafe_conditions_records.type_condition_id')
            ->join('condition_groups', 'condition_groups.id', '=', 'type_conditions.condition_group_id')
            ->join('people as people_responsable', 'people_responsable.id', '=', 'unsafe_conditions_records.responsable_id',)
            ->join('companies_and_departments as  department','department.id','=', 'unsafe_conditions_records.department_id')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereMonth('unsafe_conditions_records.created_at',  $month)
            ->whereYear('unsafe_conditions_records.created_at',  $year)
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

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        return Excel::download($exportUC,'Condiciones Inseguras '.$date.'.xlsx');

    }

    public function export_Year(){

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $year = date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $uc = DB::table('unsafe_conditions_records')
            ->join('type_conditions', 'type_conditions.id','=', 'unsafe_conditions_records.type_condition_id')
            ->join('condition_groups', 'condition_groups.id', '=', 'type_conditions.condition_group_id')
            ->join('people as people_responsable', 'people_responsable.id', '=', 'unsafe_conditions_records.responsable_id',)
            ->join('companies_and_departments as  department','department.id','=', 'unsafe_conditions_records.department_id')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
            ->whereYear('unsafe_conditions_records.created_at',  $year)
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

        return Excel::download($exportUC,'Condiciones Inseguras '.$date.'.xlsx');

    }

    public function export_all(){

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

        $uc = DB::table('unsafe_conditions_records')
            ->join('type_conditions', 'type_conditions.id','=', 'unsafe_conditions_records.type_condition_id')
            ->join('condition_groups', 'condition_groups.id', '=', 'type_conditions.condition_group_id')
            ->join('people as people_responsable', 'people_responsable.id', '=', 'unsafe_conditions_records.responsable_id',)
            ->join('companies_and_departments as  department','department.id','=', 'unsafe_conditions_records.department_id')
            ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
            ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
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

        return Excel::download($exportUC,'Condiciones Inseguras '.$date.'.xlsx');

    }
}
