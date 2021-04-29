<?php

namespace App\Http\Controllers;

use App\Models\Companies_and_departments;
use App\Models\People;
use App\Models\Role;
use App\Models\User;
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
        $people = People::where('status', 'ACTIVO')->orderBy('name', 'ASC')->with('company_and_department')->get();
        
        return view('pages.dashboard.people.peopleTable', compact('people'));
    }

    public function getPeopleIntern()
    {
        $people = People::where('status', 'ACTIVO')->orderBy('name', 'ASC')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'INTERNO');
        })->get();
        
        return view('pages.dashboard.people.peopleInternTable', compact('people'));
    }

    public function getPeopleExtern()
    {
        $people = People::where('status', 'ACTIVO')->orderBy('name', 'ASC')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'EXTERNO');
        })->get();
        
        return view('pages.dashboard.people.peopleExternTable', compact('people'));
    }

    public function updatePersonForm($id){
        
        $person = People::with('company_and_department')
        ->with('user')
        ->with('user.role')
        ->where('id', $id)->first();

        $roles = Role::all();
        $departments = Companies_and_departments::all();
        
        return view('pages.dashboard.personUpdateForm', compact('person', 'roles', 'departments'));
        
    }

    public function updatePerson(Request $request){
        
        try {
            People::where('id', $request->id)
            ->update([
                'sap' => $request->sap,
                'name' => $request->name,
                'position' => $request->position,
                'companie_and_department_id' => $request->companie_and_department_id,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal');
        }
        return back()->with('success', 'Registro exitoso');
        
    }

    public function deactivatePerson(Request $request)
    {
        try {
            $person = People::where('id',  $request->id)
            ->update(['status' => 'INACTIVO']);
        } catch (\Throwable $th) {
            return "error";
        }
        return $person;
    }
}
