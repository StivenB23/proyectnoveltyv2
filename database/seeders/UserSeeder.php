<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->number_document = '12345678901';
        $user->name = 'Admin ';
        $user->lastname = 'Sena ';
        $user->email = 'stiven@gmail.com';
        $user->password = Hash::make('12345678');
        $user->role = 'administrador';
        $user->state = true;
        $user->save();
    }
}
