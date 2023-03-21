<?php

namespace App\Http\Controllers;

use App\Mail\NotificationCreateUser;
use App\Models\Classroom;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ImportController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request,["file" => "required"]);

        $file = file($request->file->getRealPath());
        $csv = \League\Csv\Reader::createFromPath($request->file('file')->getRealPath());
        $csv->setHeaderOffSet(0);
        
        if ($request->type == "instructor") {
                foreach ($csv as $data) {
                    $user = User::create([
                     "name" => $data["name"],
                     "lastname" => $data["lastname"],
                     "number_document" => $data["number_document"],
                     "email" => $data["email"],
                     "password" => Hash::make($data["number_document"]),
                     "state" => $data["state"],
                     "role" => "instructor"
                    ]);
                    $email = new NotificationCreateUser();
                    Mail::to($data["email"])->send($email);
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
