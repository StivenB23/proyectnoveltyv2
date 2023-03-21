<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $messages = [
            "number_document.required" => "El número de documento es requerido",
            "number_document.numeric" => "El número de documento debe ser un número",
            "number_document.max" => "El número de documento no puede tener más de 10 números",
            "password.required" => "La contraseña es requerida",
            "password.min" => "La contraseña debe tener minimo 8 caracteres"
        ];
        $this->validate($request, ['number_document'=>'required|numeric','password'=>'required|min:8'], $messages);

        if (!Auth::attempt(['number_document' => $request->number_document,'password'=>$request->password, 'state'=>true])) {
            Alert::error('Inicio de sesión fallido',"Las credenciales ingresadas no son validas.");
            return back()->with('message','El usuario no tiene acceso permitido');
        }
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }
}
