<?php

namespace App\Http\Controllers;

use App\Models\Companies_and_departments;
use Illuminate\Http\Request;

class CompaniesDepartmentsController extends Controller
{
    public function getCompaniesDepartments()
    {
        $departmentsCompanies = Companies_and_departments::get()->all();

        return view('pages.dashboard.configuration.departmentsCompanies.departmentsCompaniesTable', compact('departmentsCompanies'));
    }

    public function getCreate()
    {
        return view('pages.dashboard.configuration.departmentsCompanies.createDepartmentsAndCompanies');
    }
    public function postCreate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'origin' => 'required',
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Falta un campo por llenar')->withInput();
        }
        try {
            Companies_and_departments::create([
                'name' => $request->name,
                'origin' => $request->origin,
            ]);
        }catch (\Throwable $th){
            return back()->with('error', 'Algo salio mal, reportalo.')->withInput();
        }
        return redirect(route('companiesAndDepartments'))->with('success', 'Registro exitoso');
    }

    public function getEdit($id)
    {
        $departmentsCompanies = Companies_and_departments::find($id);

        return view('pages.dashboard.configuration.departmentsCompanies.editDepartmentsAndCompanies', compact('departmentsCompanies'));
    }
    public function postEdit(Request $request)
    {
        Companies_and_departments::find($request->id)->update(['name' => $request->name,]);

        return redirect(route('companiesAndDepartments'));
    }

}
