<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Computer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
        return view("auth/computer/computers")->with("computers",$computers);
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
        return view('auth/computer.formEditComputer')->with("computer",$computer)->with("classrooms",$classrooms);
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
        // $rules = [
        //     "code" => "required",
        //     "numberComputer" => "required",
        //     "classroom" => "required"
        // ];
        // $this->validate($request, $rules);
        $computer = Computer::find($id);
        try {
            $computer->code = $request->code;
            $computer->number_computer = $request->numberComputer;
            $computer->classroom_id = $request->classroom;
            $computer->save();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                Alert::error('Error código duplicado',"El código que ingreso ya esta asignado a otro equipo.");
                return back();
            }
        }
        return redirect()->route("listcomputers");
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
