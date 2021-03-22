<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Unsafe_conditions_record;

class test extends Controller
{
    public function test(){
        
        $request = "rutina";

        $result = Unsafe_Conditions_record::where('status','LIKE','%'.$request.'%')
                ->orWhere('condition_detected','LIKE','%'.$request.'%')
                ->orWhere('detection_origin','LIKE','%'.$request.'%')
                ->orWhere('deadline','LIKE','%'.$request.'%')
                ->orWhere('area','LIKE','%'.$request.'%')
                ->orWhere('risk','LIKE','%'.$request.'%')
                ->orWhere('risk_type','LIKE','%'.$request.'%')
                ->orWhere('attention_priority','LIKE','%'.$request.'%')
                ->orWhere('scope','LIKE','%'.$request.'%')
                ->orWhere('notice_number','LIKE','%'.$request.'%')
                ->with('type_condition')
                ->with('type_condition.condition_group')
                ->with('responsable')
                ->with('department')
                ->with('reporter')
                ->with('reporter.company_and_department')
                ->get();
                

                return $result;

        return $result;
    }
}
