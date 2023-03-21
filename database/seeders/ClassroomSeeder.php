<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classroom = new Classroom();
        $classroom->number_classroom = "412";
        $classroom->save();

        $classroom = new Classroom();
        $classroom->number_classroom = "410";
        $classroom->save();

        $classroom = new Classroom();
        $classroom->number_classroom = "511";
        $classroom->save();

        $classroom = new Classroom();
        $classroom->number_classroom = "510";
        $classroom->save();
    }
}
