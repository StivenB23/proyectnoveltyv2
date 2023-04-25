<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Novelty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('auth.classrooms')->with("classrooms", $classrooms);
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
        } catch (\Throwable $th) {
            Alert::toast('Hubo un error, vuelve a intentarlo', 'error');
        }
        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $classroom = Classroom::where('id', '=', $id)->get(['id', 'number_classroom','user_id']);
        $classroom = Novelty::join('images','images.novelty_id','=','novelties.id')
        ->where('novelties.classroom_id',$id)
        ->get(['novelties.id','images.image','novelties.date_novelty','novelties.date_resolved','novelties.description','novelties.details_procces','novelties.state','novelties.user_id','novelties.classroom_id']);
        $history = Classroom::find($id)->novelties;
        

        return view('auth.historyClassroom')->with("classroom", $classroom)->with("history", $history);
    }

    public function myClassroom()
    {
        // $history = Classroom::find(Auth::user()->classroom_id)->novelties;
        $classroom = Classroom::where('user_id',Auth::user()->id)->get(['id','number_classroom']);
        return view('auth.myClassroom')->with('classroom',$classroom);
    }

    public function historyAmbient($id)
    {
    //    $history = Classroom::find($id)->novelties;
       $history  = Novelty::join('images','images.novelty_id','=','novelties.id')
        ->where('novelties.classroom_id',$id)
        ->get(['novelties.id','images.image','novelties.date_novelty','novelties.date_resolved','novelties.description','novelties.details_procces','novelties.state','novelties.user_id','novelties.classroom_id']);
        // dd($history);
       return view('auth.myClassroomHistory')->with('history',$history);
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
    public function destroy(Classroom $classroom)
    {
        //
    }
}
