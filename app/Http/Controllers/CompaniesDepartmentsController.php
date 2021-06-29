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

        return view('pages.dashboard.configuration.departmentsCompanies.createDepartmentsAndCompanies');
    }

    public function getEdit()
    {
        $departmentsCompanies = Companies_and_departments::get()->all();

        return view();
    }
    public function postEdit(Request $request)
    {
        $departmentsCompanies = Companies_and_departments::get()->all();

        return view();
    }

}
