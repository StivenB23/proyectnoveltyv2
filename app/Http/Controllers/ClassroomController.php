<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Novelty;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::select('id','number_classroom')->orderBy('number_classroom', 'asc')->get();
        return view('auth/classroom.classrooms')->with("classrooms", $classrooms);
    }

    function listClassrooms()  {
        $classrooms = Classroom::select('*')->orderBy('number_classroom', 'asc')->get();
        return view('auth/classroom.listClassrooms')->with("classrooms",$classrooms); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "classroom" => "required"
        ];
        $this->validate($request,$rules);
        try {
            $classroom = new Classroom();
            $classroom->number_classroom = $request->classroom;
            $classroom->save();
            Alert::toast('Ambiente Registrado', 'success');
        } catch (Exception $th) {
            Alert::toast('Hubo un error, vuelve a intentarlo', 'error');
        }
        return redirect()->route('listarAmbiente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = Classroom::where('id', '=', $id)->get(['id', 'number_classroom','user_id']);
        $history = Classroom::find($id)->novelties;
        return view('auth/classroom.historyClassroom')->with("classroom", $classroom)->with("history", $history);
    }

    public function myClassroom()
    {
        $classroom = Classroom::where('user_id',Auth::user()->id)->get(['id','number_classroom']);
        return view('auth/classroom.myClassroom')->with('classroom',$classroom);
    }

    public function historyAmbient($id)
    {
       $history = Classroom::find($id)->novelties;
       return view('auth/classroom.myClassroomHistory')->with('history',$history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Classroom::destroy($request->id);
            Alert::success("Ambiente eliminado","El ambiente fue eliminado de forma exitosa");
        } catch (\Throwable $th) {
            Alert::error("Error","El ambiente tiene equipos y novedades registrados no es posible eliminarlo");
        }
        return redirect()->route("listarAmbiente");
    }

    function deleteClassroom()  {
        try {
            DB::statement("SET foreign_key_checks=0");
            DB::select("DELETE FROM classrooms");
            DB::statement("SET foreign_key_checks=1");
            Alert::success('Limpieza ambientes', "Los ambientes fueron eliminados");
        } catch (\Throwable $th) {
            Alert::success('Error', "Se ha presentado un error al limpiar ambientes");
        }
        return redirect()->route('ambientes');
    }
}
