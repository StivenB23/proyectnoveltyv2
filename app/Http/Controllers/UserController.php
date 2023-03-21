<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $classrooms = Classroom::all();
        return view('auth.users')->with('users', $users)->with('classrooms', $classrooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms  =  Classroom::all(['id', 'number_classroom']);
        return view('auth.formUser')->with("classrooms", $classrooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "name" => "required|alpha:ascii",
            "lastname" => "required|alpha:ascii",
            "number_document" => "required|numeric",
            "email" => "required|email:rfc,dns",
            // "classroom" => "required",
        ];
        // dd($request->only("classrooms"));
        $messages = [
            "name.required" => "El nombre es obligatorio",
            "name.alpha" => "El nombre debe tener solo letras",
            "lastname.required" => "El apellido es obligatorio",
            "lastname.alpha" => "El apellido debe tener solo letras",
            "number_document.required" => "El número de documento es obligatorio",
            "number_document.numeric" => "El número de documento debe ser un número",
            "email.required" => "El correo es obligatorio",
            "email.email" => "El correo no es obligatorio",
        ];
        $this->validate($request, $rules, $messages);

        $user = User::create([
                "name" => $request->name,
                "lastname" => $request->lastname,
                "number_document" => $request->number_document,
                "email" => $request->email,
                "role" => "instructor",
                "state" => true,
                "password" => Hash::make($request->number_document)]);
        $arreglo = (array)$request->only("classrooms");
        for ($index=0; $index < count($arreglo['classrooms']) ; $index++) {  
            if ($arreglo['classrooms'][$index] == "NULL") {
                break;
            } else {
                $classrooms = Classroom::find($arreglo['classrooms'][$index]);
                if ($classrooms->id == $arreglo['classrooms'][$index]) {
                    $classrooms->user_id = $user->id;
                    $classrooms->save();
                }
            }
        }

        Alert::success('Usuario Creada Exitosamente',"El usuario $request->name $request->lastname fue creado exitosamente.");
        return redirect()->route('formUser');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id,['id', 'name','lastname', 'number_document','email']);
        $classrooms = Classroom::all('id','number_classroom','user_id');
        return view('auth.detailsUser')->with("classrooms",$classrooms)->with("user",$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            "name" => "required",
            "lastname" => "required",
            "email" => "required",
            "classrooms" => "required",
        ];
        $this->validate($request, $rules);
        $user = User::find($id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $arreglo = (array)$request->only("classrooms");
        for ($index=0; $index < count($arreglo['classrooms']) ; $index++) {  
            if ($arreglo['classrooms'][$index] == "NULL") {
                break;
            } else {
                $classrooms = Classroom::find($arreglo['classrooms'][$index]);
                if ($classrooms->id == $arreglo['classrooms'][$index]) {
                    $classrooms->user_id = $user->id;
                    $classrooms->save();
                }
            }
        }
        // $user->classroom_id  = $request->classroom == "NULL" ? null : $request->classroom;
        $user->save();
        Alert::success('Usuario Actualizado Exitosamente',"El usuario $request->name $request->lastname fue actualizado exitosamente.");
        return redirect()->route('dashboard');
    }

    public function updateInformation(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->email = $request->email;
            if ($request->password != "") {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            Alert::success('Cambios exitosos',"Los cambios fueron actualizados exitosamente");
            return redirect()->route('setting'); 
        } catch (Exception $th) {
            Alert::error('ERROR',"Ponganse en contacto con el equipo técnico");
            return redirect()->route('setting'); 
        }
    }

    public function changeStateUser(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->state = !$user->state;
            $user->save();
            Alert::success('Estado Actualizado Exitosamente',"El estado del usuario $user->name $user->lastname fue cambiado .");
            return redirect()->route('users');
        } catch (Exception $th) {
            Alert::error('ERROR',"Ponganse en contacto con el equipo técnico");
            return redirect()->route('users');
        }
    }

    public function resetPassword()
    {
        
    }

    public function setting()
    {
        return view('auth.settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
