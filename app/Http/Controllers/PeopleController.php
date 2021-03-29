<?php

namespace App\Http\Controllers;

use App\Models\Companies_and_departments;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function createPerson(Request $request){
        try {
            $request->validate([
                'sap' => 'required|string|unique:people',
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'El SAP ya esta en uso');
        }
        
        try {
            
            $person = People::create([
                'sap' => $request->sap,
                'name' => $request->name,
                'position'=> $request->position,
                'companie_and_department_id' => $request->companie_and_department_id,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal');
        }
        
        return back()->with('success', 'Registro exitoso');
    }

    public function createPersonExtern(Request $request){
        $people = People::orderBy('id', 'DESC')->first();
        $newExtSap = $people->id + 1;
        
        try {
            
            $person = People::create([
                'sap' => $newExtSap,
                'name' => $request->name,
                'position'=> $request->position,
                'companie_and_department_id' => $request->companie_and_department_id,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal');
        }
        
        return back()->with('success', 'Registro exitoso');
    }

    public function createPersonForm(){
        $departments = Companies_and_departments::all();
        return view('pages.dashboard.people.peopleForm', compact('departments'));
    }

    public function getPeople()
    {
        $people = People::orderBy('name', 'ASC')->with('company_and_department')->get();
        
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
