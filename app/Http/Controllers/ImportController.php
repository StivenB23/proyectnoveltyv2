<?php

namespace App\Http\Controllers;

use App\Mail\NotificationCreateUser;
use App\Models\Classroom;
use App\Models\Computer;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use League\Csv\CharsetConverter;
use League\Csv\Writer;
use RealRashid\SweetAlert\Facades\Alert;

class ImportController extends Controller
{
    public function store(Request $request)
    {
        
        $this->validate($request, ["file" => "required"]);
        
        DB::disableQueryLog();
        DB::connection()->unsetEventDispatcher();

        $encoder = (new CharsetConverter)->inputEncoding('utf-8')->outputEncoding('iso-8859-15');
        
        $file = file($request->file->getRealPath());
        $csv = \League\Csv\Reader::createFromPath($request->file('file')->getRealPath());
        $csv->setHeaderOffSet(0);
        $csv->setDelimiter(';');
        $users = [];
        if ($request->type == "instructor") {
            foreach ($csv as $data) {
                $users[] = [
                    "name" => $data["name"],
                    "lastname" => $data["lastname"],
                    "number_document" => $data["number_document"],
                    "email" => $data["email"],
                    "password" => Hash::make($data["number_document"]),
                    "state" => 1,
                    "role" => "instructor",
                    "created_at" => now(),
                    "updated_at" => now()
                ];
                $email = new NotificationCreateUser();
                $correo =$data["email"];
                Mail::to($correo)->send($email);
            }
            try {
                DB::table('users')->insert($users);
            } catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    Alert::error('Error email duplicado', "Uno de los correos ingresados ya existe.");
                    return back();
                }
            }
        } else if ($request->type == "computers") {
            foreach ($csv as $data) {
                $classroom = Classroom::where('number_classroom', '=', $data['number_classroom'])->get(['id']);
                Computer::create(
                    [
                        "code" => $data['code'],
                        "number_computer" => $data['number_computer'],
                        "classroom_id" => $classroom[0]['id']
                    ]
                );
            }
        } else {
            foreach ($csv as $data) {
                $classroom = Classroom::create([
                    "number_classroom" => $data["number_classroom"],
                    "user_id" => null
                ]);
            }
        }

        return redirect()->route('users');
    }
}
