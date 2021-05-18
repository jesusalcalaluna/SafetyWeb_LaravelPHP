<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies_and_departments;
use App\Models\IncidentType;
use App\Models\Incident;
use App\Models\IncidentRecord;
use App\Models\People;

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
        # code...
    }
}
