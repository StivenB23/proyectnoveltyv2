<?php

namespace App\Http\Controllers;

use App\Mail\RecoverPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class RecoverPasswordController extends Controller
{
    public function index($document)
    {
        return view('auth.recoverPassword')->with("document", $document);
    }
    public function recover(Request $request)
    {
        $rules = [
            "password" => "regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/",
        ];
        $messages = [
            "password.regex" => "La contraseña debe tener minimo 8 caracteres, una minuscula, una mayuscula y un número"
        ];
        $this->validate($request, $rules, $messages);
        try {
            $user = User::where('number_document', $request->document)->update(["password"=>Hash::make($request->password)]);
            Alert::success('Contraseña Restaurada exitosamente',"La contraseña fue restaurada exitosamente, intente ingresar al sistema.");
        } catch (\Throwable $th) {
            Alert::error('Restauración Fallida',"Oh, algo salio mal.");
            return back();
        }
        return redirect()->route('home');
    }
    public function notification(Request $request)
    {
        try {
            $email = new RecoverPassword($request->document);
            Mail::to($request->email)->send($email);
            Alert::info('Restauración Exitosa',"Se enviara un correo a $request->email para continuar con el proceso.");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->route('users');
    }
}
