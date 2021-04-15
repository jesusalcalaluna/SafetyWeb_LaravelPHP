<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BehaviorsGroupController extends Controller
{
    public function showWriteBeahaviorGroup(){
        return view('test');
    }

    public function writeBehaviorGroup(Request $request){
        
        $data = DB::table('behaviors_groups')->insert([
            'group_name' => $request->group_name
        ]);

    }

    public function readBehaviorGroup(){
        return "";
    }

    public function updateBehaviorGroup(){
        return "";
    }
}
