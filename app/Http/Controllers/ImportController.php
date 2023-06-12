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
use Mockery\Undefined;
use RealRashid\SweetAlert\Facades\Alert;

class ImportController extends Controller
{
    public function store(Request $request)
    {
        
        $this->validate($request, ["file" => "required"]);
        
        DB::disableQueryLog();
        DB::connection()->unsetEventDispatcher();

        //$encoder = (new CharsetConverter)->inputEncoding('utf-8')->outputEncoding('iso-8859-15');
        
        $file = file($request->file->getRealPath());
        $csv = \League\Csv\Reader::createFromPath($request->file('file')->getRealPath());
        $csv->setHeaderOffSet(0);
        $csv->setDelimiter(';');
        $users = [];
        if ($request->type == "instructor") {
            foreach ($csv as $data) {
                if ( !isset($data["name"])  || !isset($data["lastname"]) || !isset($data["number_document"])) {
                    Alert::error('Error importación', "Hay datos vacios en el formato que intenta importar, revise el documento e intente nuevamente.");
                    return back();
                }
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
                Alert::success('Carga Exitosa', "Los usuarios han sido cargados de forma exitosa.");
            } catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    Alert::error('Error email duplicado', "Uno de los correos ingresados ya existe.");
                    return back();
                }
            }catch(Exception $e){
                Alert::error('Error importación', "El documento cargado no es valido, revise el formato del documento.");
                return back();
            }
        } else if ($request->type == "computers") {
            foreach ($csv as $data) {
                if ( !isset($data["number_classroom"]) || !isset($data["code"]) || !isset($data["number_computer"])) {
                    Alert::error('Error importación', "Hay datos vacios o encabezados erroneos en el formato que intenta importar, revise el documento e intente nuevamente.");
                    return back();
                }
                $classroom = Classroom::where('number_classroom', '=', $data['number_classroom'])->get(['id']);
                Computer::create(
                    [
                        "code" => $data['code'],
                        "number_computer" => $data['number_computer'],
                        "classroom_id" => $classroom[0]['id']
                    ]
                );
            }
            Alert::success('Carga Exitosa', "Los equipos han sido cargados de forma exitosa.");
        } else {
            foreach ($csv as $data) {
                if ( !isset($data["number_classroom"])) {
                    Alert::error('Error importación', "Hay datos vacios o encabezados erroneos en el formato que intenta importar, revise el documento e intente nuevamente.");
                    return back();
                }
                $classroom = Classroom::create([
                    "number_classroom" => $data["number_classroom"],
                    "user_id" => null
                ]);
            }
            Alert::success('Carga Exitosa', "Los ambientes han sido cargados de forma exitosa.");
        }

        return redirect()->route('users');
    }
}
