<?php

namespace App\Http\Controllers;

use App\Models\Companies_and_departments;
use App\Models\CompanyPrefix;
use App\Models\People;
use App\Models\Role;
use App\Models\User;
use ArrayObject;
use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    public function createPerson(Request $request){
        $company_origin = (Companies_and_departments::where('id', $request->companie_and_department_id)->first('origin'))->origin;
        $person = new ArrayObject();
        if($company_origin == "INTERNO"){
            try {

                $request->validate([
                    'sap' => 'unique:people',
                ]);

            } catch (\Throwable $th) {

                return back()->with('error', 'El SAP ya esta en uso');

            }
            try {

                $person = People::create([
                    'sap' => $request->sap,
                    'name' => strtoupper($request->name) ,
                    'position'=> strtoupper( $request->position),
                    'companie_and_department_id' => $request->companie_and_department_id,
                ]);

            } catch (\Throwable $th) {

                return back()->with('error', 'Algo salio mal');

            }

            return back()->with('success', 'Registro exitoso con SAP: '.$person->sap);

        }else {
            try {

                $prefix = (CompanyPrefix::where('company_id', $request->companie_and_department_id)->first())->prefix;
                $people = People::orderBy('id', 'DESC')->first();
                $newExtId = $people->id + 1;

                $person = People::create([
                    'sap' => $prefix.$newExtId,
                    'name' => strtoupper( $request->name),
                    'position'=> strtoupper( $request->position),
                    'companie_and_department_id' => $request->companie_and_department_id,
                ]);

            } catch (\Throwable $th) {

                return back()->with('error', 'Algo salio mal');

            }
            return back()->with('success', 'Registro exitoso su ID es el siguiente: '.$person->sap);
        }




    }

    public function createPersonForm(){
        $departments = Companies_and_departments::all();
        return view('pages.dashboard.people.peopleForm', compact('departments'));
    }

    public function getPeople(){//Metodo para departamentos espesificos

        $countCC = 0;
        $countUC = 0;
        $people = People::where('status','!=', 'INACTIVO')->orderBy('name', 'ASC')->where('companie_and_department_id', Auth::user()->person->company_and_department->id)
        ->with('unsafe_condition_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->with('companion_care_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->get();

        foreach ($people as $key => $value) {

            if (count($value->unsafe_condition_records)) {
                $countUC ++;
            }

            if (count($value->companion_care_records)) {
                $countCC ++;
            }

        }

        $countPeopleDepartment = People::where('status','!=', 'INACTIVO')->where('companie_and_department_id', Auth::user()->person->company_and_department->id)->count();

        $ppcc = 0;
        if ($countPeopleDepartment) {
            $ppcc = number_format(($countCC/$countPeopleDepartment)*100 );
        }

        $ppuc = 0;
        if ($countPeopleDepartment) {
            $ppuc = number_format(($countUC/$countPeopleDepartment)*100 );
        }

        return view('pages.dashboard.people.peopleTable', compact('people', 'ppuc', 'ppcc', 'countCC', 'countUC'));
    }

    public function getPeopleIntern(){//metodo para ADMINISTRADORES

        $countCC = 0;
        $countUC = 0;

        $people = People::where('status','!=', 'ELIMINADO')->orderBy('name', 'ASC')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'INTERNO');
        })->with('unsafe_condition_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->with('companion_care_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->get();

        foreach ($people as $key => $value) {

            if (count($value->unsafe_condition_records)) {
                $countUC ++;
            }

            if (count($value->companion_care_records)) {
                $countCC ++;
            }

        }

        $countPeopleDepartment = People::where('status','!=', 'ELIMINADO')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'INTERNO');
        })->count();

        $ppcc = 0;
        if ($countPeopleDepartment) {
            $ppcc = number_format(($countCC/$countPeopleDepartment)*100,1 );
        }

        $ppuc = 0;
        if ($countPeopleDepartment) {
            $ppuc = number_format(($countUC/$countPeopleDepartment)*100,1 );
        }

        $departments = Companies_and_departments::where('origin', 'INTERNO')->get();


        return view('pages.dashboard.people.peopleInternTable', compact('people', 'ppuc', 'ppcc', 'departments', 'countCC', 'countUC'));
    }

    public function getPeopleExtern(){//metodo para ADMIONISTRADORES

        $countCC = 0;
        $countUC = 0;
        $people = People::where('status','!=', 'ELIMINADO')->orderBy('name', 'ASC')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'EXTERNO');
        })->with('unsafe_condition_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->with('companion_care_records', function($query){
            return $query->whereMonth('created_at', '=', date('m'))
                         ->whereYear('created_at', '=', date('Y'));
        })->get();

        foreach ($people as $key => $value) {

            if (count($value->unsafe_condition_records)) {
                $countUC ++;
            }

            if (count($value->companion_care_records)) {
                $countCC ++;
            }

        }

        $countPeopleDepartment = People::where('status','!=', 'ELIMINADO')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'EXTERNO');
        })->count();

        $ppcc = 0;
        if ($countPeopleDepartment) {
            $ppcc = number_format(($countCC/$countPeopleDepartment)*100, 1 );
        }

        $ppuc = 0;
        if ($countPeopleDepartment) {
            $ppuc = number_format(($countUC/$countPeopleDepartment)*100, 1 );
        }
        $companies = Companies_and_departments::where('origin', 'EXTERNO')->get();

        return view('pages.dashboard.people.peopleExternTable', compact('people', 'ppuc', 'ppcc', 'companies', 'countCC', 'countUC'));
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
                'status' => $request->status,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal');
        }
        return back()->with('success', 'Registro exitoso');

    }

    public function deactivatePerson(Request $request){
        try {
            $person = People::where('id',  $request->id)
            ->update(['status' => 'ELIMINADO']);
        } catch (\Throwable $th) {
            return "error";
        }
        return $person;
    }

    public function getEliminatedPeople(){
        $people = People::where('status', 'ELIMINADO')->get()->all();
        return view('pages.dashboard.people.eliminatedPeople', compact('people'));
    }

    public function getParticipation(){
        $people = People::where('status', 'ACTIVO')->orderBy('name', 'ASC')->with('company_and_department')->whereHas('company_and_department', function ($query) {
            return $query->where('origin', 'EXTERNO');
        })->get();
        return "participation";
    }

}
