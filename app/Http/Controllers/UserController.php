<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updateUser(Request $request){
        
        try {
            User::where('id', $request->id)
            ->update([
                'email' => $request->email,
                'role_id' => $request->role_id,
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Algo salio mal');
        }
        return back()->with('success', 'Registro exitoso');
        
    }

    public function updatePass(Request $request){
        try {
            $request->validate([
                'id' => 'required',
                'password' => 'required',
                'new_password' => 'required|required_with:confirm_password|min:6',
                'confirm_password' => 'required|same:new_password'
            ]);
        } catch (\Throwable $th) {
            
            return back()->with('error', 'La contraseña no coincide');
        }
        
        if (Hash::check($request->password,Auth::user()->password)) {
            User::where('id', $request->id)
            ->update([
                'password' => Hash::make($request->new_password) ,
            ]);
        }else {
            return back()->with('error', 'La contraseña es incorrecta');
        }
    
        return back()->with('success', 'Registro exitoso');
        
    }
}
