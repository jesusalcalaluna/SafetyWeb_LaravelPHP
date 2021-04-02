<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Unsafe_conditions_record;
use Illuminate\Support\Carbon;

class test extends Controller
{
    public function test(){
        
        $result = Unsafe_conditions_record::where('attention_priority','LIKE','%Media%')
                                            ->whereDate('created_at', '=', Carbon::now()->add(-7, 'day')->format('Y-m-d'))
                                            ->groupByDate('created_at')
                                            ->cout()
                                            ->get();

        return $result;
    }
}
