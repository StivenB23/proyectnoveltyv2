<?php

namespace App\Http\Controllers;

use App\Mail\RecoverPassword;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class forgotPassword extends Controller
{
    public function formForgotPassword()
    {
        return view('forgotPassword');
    }

    public function resetPassword(Request $request)
    {
        $messages = [
            "number_document.required" => "El número de documento no puede estar vacío",
            "number_document.numeric" => "El número de documento debe ser un número",
            "number_document.min" => "El número de documento debe tener minimo 8 digitos"
        ];
        $this->validate($request, ['number_document' => 'required|numeric|min:8'], $messages);
            $user = User::where('number_document','=',$request->number_document)->get(['id','email']);
            if ($user->isEmpty()) {
                Alert::error("Error al restaurar contraseña","El número de documento ingresado no se encuentra en el sistema");
                return back();
            }

            try {   
                $email = new RecoverPassword($request->number_document);
                Mail::to($user[0]->email)->send($email);
                Alert::info('Restauración Exitosa',"Se enviara un mensaje al correo registrado para el documento $request->number_document para continuar con el proceso.");
                return redirect()->to("login");
            } catch (\Throwable $th) {
                throw $th;
            }
    }
}
