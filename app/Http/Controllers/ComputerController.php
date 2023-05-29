<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Computer;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $computers = Computer::all();
        return view("auth/computer/computers")->with("computers", $computers);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $computer = Computer::find($id);
        $classrooms = Classroom::all('id', 'number_classroom', 'user_id');
        return view('auth/computer.formEditComputer')->with("computer", $computer)->with("classrooms", $classrooms);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $computer = Computer::find($id);
        try {
            $computer->code = $request->code;
            $computer->number_computer = $request->numberComputer;
            $computer->classroom_id = $request->classroom;
            $computer->save();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Alert::error('Error código duplicado', "El código que ingreso ya esta asignado a otro equipo.");
                return back();
            }
        }
        return redirect()->route("listcomputers");
    }

    public function cleanComputers()
    {
        try {
            DB::statement("SET foreign_key_checks=0");
            $computer =  Computer::truncate();
            DB::statement("SET foreign_key_checks=1");
            Alert::success('Limpiando Equipos', "Los equipos han sido limpiados exitosamente");
        } catch (Exception $th) {
            Alert::success('Error', "Se ha presentado un error al limpiar los equipos");
        }
        return redirect()->route('novelties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer)
    {
        //
    }
}
