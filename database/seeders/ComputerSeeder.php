<?php

namespace Database\Seeders;

use App\Models\Computer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $computer = new Computer();
       $computer->code = "12345678a";
       $computer->number_computer = "26";
       $computer->classroom_id = "1";
       $computer->save();
    }
}
