<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\NotificationInstructor;
use App\Models\Classroom;
use App\Models\Image;
use App\Models\Novelty;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class NoveltyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $novelties = Novelty::all();
        return view('auth.novelties')->with("novelties",$novelties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms  =  Classroom::all(['id', 'number_classroom']);
        return view('auth.formNovelty')->with("classrooms", $classrooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        setlocale(LC_ALL, 'esp');
        $date = now();
        $rules = [
            // "file" => "required",
            "classroom" => "required",
            "description" => "required",
        ];
        $messages = [
            "classroom.required" => "Debe seleccionar un ambiente",
            "description.required" => "Debe incluir una descripción"
        ];
        $this->validate($request, $rules, $messages);
        $description = html_entity_decode($request->description);
        // dd($date->toDateTimeLocalString());
            $novelty = Novelty::create(['date_novelty' => $date->toDateTimeLocalString(), "description" => $description, "user_id" => Auth::user()->id, "state" => "pendiente","details_procces"=>null, "classroom_id" => $request->classroom]);
       
       
        // dd($novelty);
        $arreglo = (array)$request->only("files");
        for ($i = 0; $i < count($arreglo["files"]); $i++) {
            $imageObject = new Image();
            $nameImage = $arreglo["files"][$i]->getClientOriginalName();
            $request->file('files')[$i]->storeAs('public/NoveltyImage', $nameImage);
            $imageObject->image = $nameImage;
            $imageObject->novelty_id = $novelty->id;
            $imageObject->save();
        }
        try {
            $emailObject = Classroom::join('users','users.id','=','classrooms.user_id')
            ->where('classrooms.id', $request->classroom)
            ->get('users.email');
            $email = new NotificationInstructor(now()->toDateTimeString(), $description);
            Mail::to($emailObject[0]->email)->send($email);
            Alert::success('Novedad Creada','La novedad fue creada exitosamente y el cuentadante fue notificado');
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        return redirect()->route('novelty');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Novelty  $novelty
     * @return \Illuminate\Http\Response
     */
    public function show(Novelty $novelty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Novelty  $novelty
     * @return \Illuminate\Http\Response
     */
    public function edit(Novelty $novelty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Novelty  $novelty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        setlocale(LC_ALL, 'esp');
        $date = now();
        $novelty = Novelty::find($request->id);
        if ($request->state == "hecho") {
            $novelty->state = $request->state;
            $novelty->date_resolved =  $date->toDateTimeLocalString();
        } else {
            $novelty->state = $request->state;
            $novelty->details_procces = $request->description == null ? null:$request->description;
        }
        $novelty->save();
        Alert::success('Novedad Actualizada Exitosamente', "El estado actual de la novedad es $request->state.");
        return redirect()->route('myAmbient');
    }

    /**
     * Clean table novelties
     *
     * @param  \App\Models\Novelty  $novelty
     * @return \Illuminate\Http\Response
     */
    public function cleanNovelty()
    {
        try {
            $image = Image::truncate();
            DB::statement("SET foreign_key_checks=0");
            $novelty =  Novelty::truncate();
            DB::statement("SET foreign_key_checks=1");
            Alert::success('Limpiando Novedades', "Las novedades han sido limpiadas exitosamente");
        } catch (\Throwable $th) {
            Alert::success('Error', "Se ha presentado un error al limpiar novedades");
            // throw $th;
        }
        return redirect()->route('novelties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Novelty  $novelty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novelty $novelty)
    {
        //
    }
}
