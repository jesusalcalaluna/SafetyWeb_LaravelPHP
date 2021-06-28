<?php

namespace App\Http\Controllers;

use App\Models\Companies_and_departments;
use Illuminate\Http\Request;

class CopaniesDepartmentsController extends Controller
{
    public function getCompaniesDepartments()
    {
        $departmentsCompanies = Companies_and_departments::get()->all();

        return view('pages.dashboard.configuration.departmentsCompaniesTable', compact('departmentsCompanies'));
    }
}
