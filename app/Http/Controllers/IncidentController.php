<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function getForm()
    {
        return view('pages.dashboard.Incidents.incidentsRecordForm');
    }

    public function setIncidentRecord(Request $request)
    {
        # code...
    }
}
