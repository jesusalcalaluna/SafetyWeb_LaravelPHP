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

        $uc = DB::table('incident_records')
            ->join('companies_and_departments','companies_and_departments.id','=', 'incident_records.department_id')
            ->join('incidents', 'incidents.id', '=', 'incident_records.incident_id')
            ->join('incident_types', 'incident_types.id', '=', 'incidents.incident_type_id')
            ->join('people', 'people.id', '=', 'incident_records.people_id')
            ->join('companies_and_departments as reporterCompani','reporterCompani.id','=', 'people.companie_and_department_id')
            ->whereDate('incident_records.created_at',  $date)
            ->select('incident_records.classification',
                'incident_records.sif',
                'incident_records.event_date',
                'incident_records.description',
                'companies_and_departments.name',
                'incident_records.spesific_area',
                'incident_records.spesific_area',
                'incidents.incident_name',
                'incident_types.type_name',
                'incident_reason',
                'reason_description',
                'involbed_people_names',
                'solution_description',
                'solution_description',
                'people.name',
                'reporterCompani.name',
                'incident_records.created_at'
            )
            ->get();

        $exportUC = new CollectionExport($uc);

        return Excel::download($exportUC,'Incidentes '.$date.'.xlsx');

    }

    public function export_Month(){

        $month = date("m", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $year = date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $uc = DB::table('incident_records')
            ->join('companies_and_departments','companies_and_departments.id','=', 'incident_records.department_id')
            ->join('incidents', 'incidents.id', '=', 'incident_records.incident_id')
            ->join('incident_types', 'incident_types.id', '=', 'incidents.incident_type_id')
            ->join('people', 'people.id', '=', 'incident_records.people_id')
            ->join('companies_and_departments as reporterCompani','reporterCompani.id','=', 'people.companie_and_department_id')
            ->whereMonth('incident_records.created_at',  $month)
            ->whereYear('incident_records.created_at',  $year)
            ->select('incident_records.classification',
                'incident_records.sif',
                'incident_records.event_date',
                'incident_records.description',
                'companies_and_departments.name',
                'incident_records.spesific_area',
                'incident_records.spesific_area',
                'incidents.incident_name',
                'incident_types.type_name',
                'incident_reason',
                'reason_description',
                'involbed_people_names',
                'solution_description',
                'solution_description',
                'people.name',
                'reporterCompani.name',
                'incident_records.created_at'
            )
            ->get();

        $exportUC = new CollectionExport($uc);

        $date = date("Y-m", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        return Excel::download($exportUC,'Incidentes MES '.$date.'.xlsx');

    }

    public function export_Year(){

        $year = date("Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
        $uc = DB::table('incident_records')
            ->join('companies_and_departments','companies_and_departments.id','=', 'incident_records.department_id')
            ->join('incidents', 'incidents.id', '=', 'incident_records.incident_id')
            ->join('incident_types', 'incident_types.id', '=', 'incidents.incident_type_id')
            ->join('people', 'people.id', '=', 'incident_records.people_id')
            ->join('companies_and_departments as reporterCompani','reporterCompani.id','=', 'people.companie_and_department_id')
            ->whereYear('incident_records.created_at',  $year)
            ->select('incident_records.classification',
                'incident_records.sif',
                'incident_records.event_date',
                'incident_records.description',
                'companies_and_departments.name',
                'incident_records.spesific_area',
                'incident_records.spesific_area',
                'incidents.incident_name',
                'incident_types.type_name',
                'incident_reason',
                'reason_description',
                'involbed_people_names',
                'solution_description',
                'solution_description',
                'people.name',
                'reporterCompani.name',
                'incident_records.created_at'
            )
            ->get();

        $exportUC = new CollectionExport($uc);

        return Excel::download($exportUC,'Incidentes '.$year.'.xlsx');

    }

    public function export_all(){

        $date = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

        $uc = DB::table('incident_records')
            ->join('companies_and_departments','companies_and_departments.id','=', 'incident_records.department_id')
            ->join('incidents', 'incidents.id', '=', 'incident_records.incident_id')
            ->join('incident_types', 'incident_types.id', '=', 'incidents.incident_type_id')
            ->join('people', 'people.id', '=', 'incident_records.people_id')
            ->join('companies_and_departments as reporterCompani','reporterCompani.id','=', 'people.companie_and_department_id')
            ->select('incident_records.classification',
                'incident_records.sif',
                'incident_records.event_date',
                'incident_records.description',
                'companies_and_departments.name',
                'incident_records.spesific_area',
                'incident_records.spesific_area',
                'incidents.incident_name',
                'incident_types.type_name',
                'incident_reason',
                'reason_description',
                'involbed_people_names',
                'solution_description',
                'solution_description',
                'people.name',
                'reporterCompani.name',
                'incident_records.created_at'
            )
            ->get();

        $exportUC = new CollectionExport($uc);

        return Excel::download($exportUC,'Incidentes TODO '.$date.'.xlsx');

    }
}
