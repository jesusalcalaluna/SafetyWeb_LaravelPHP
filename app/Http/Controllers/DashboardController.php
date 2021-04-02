<?php

namespace App\Http\Controllers;

use App\Models\Companion_care_record;
use App\Models\People;
use App\Models\Unsafe_conditions_record;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $people = People::count('id');

        $par_UnsefeConditions = Unsafe_conditions_record::groupBy('person_id')->count();
        $par_CompanionCare = Companion_care_record::count();
        //return $par_CompanionCare;
        return view('pages.dashboard.index');
    }

    public function dashboardCharts(){
        $data= "hola";
        return $data;
    }
}
