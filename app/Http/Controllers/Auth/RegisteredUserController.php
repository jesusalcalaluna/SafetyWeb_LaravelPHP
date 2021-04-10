<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\Companies_and_departments;
use App\Models\People;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        $people = People::all();
        $companies_departments = Companies_and_departments::all();
        return view('auth.register', compact('roles', 'companies_departments', 'people'));
    }
    public function createAdmin()
    {
        $roles = Role::all();
        $people = People::all();
        $companies_departments = Companies_and_departments::all();
        $users = User::with('person')->with('role')->get();
        return view('auth.register-admin', compact('roles', 'companies_departments', 'people', 'users'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'sap' => 'required',
            'role_id' => 'required',
        ]);
        $person = [];

        if ($request->name) {
            try {
                $request->validate([
                    'sap' => 'required|unique:people',
                ]);
            } catch (\Throwable $th) {
                return back()->with('error', 'Ya existe una persona con ese SAP ó ID');
            }
            try {
                $person = People::create([
                    'name' => $request->name,
                    'sap' => $request->sap,
                    'companie_and_department_id' => $request->companie_and_department_id,
                ]);
            } catch (\Throwable $th) {
                return back()->with('error', 'Algo salio mal al registrar la persona');
            }
            
            
        }else {
            $person = People::where('sap', $request->sap)->first();
        }
        try {
            $user = User::create([
                'people_id' => $person->id,
                'role_id' => $request->role_id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal al registrar el usuario');
        }
        

        return back()->with('success', 'Registro exitoso');
    }
}
