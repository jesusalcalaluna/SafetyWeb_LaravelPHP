<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function getPeople()
    {
        $people = People::with('company_and_department')->get();
        
        return view('pages.dashboard.peopleTable', compact('people'));
    }

    public function updatePerson($id){
        
        $person = People::with('company_and_department')
        ->with('user')
        ->with('user.role')
        ->where('id', $id)->first();
        
        return view('pages.dashboard.personUpdateForm', compact('person'));
        
    }
}
