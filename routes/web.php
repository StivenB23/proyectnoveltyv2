<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoveltyController;
use App\Http\Controllers\RecoverPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->middleware('guest')->name('home');


Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::get('/formp', function ()
{
    return view('form');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/restaurarcontraseña/{document}', [RecoverPasswordController::class, 'index'])->name('recover');
Route::post('/restaurarcontraseña', [RecoverPasswordController::class, 'notification']);
Route::post('/recoverpassword', [RecoverPasswordController::class, 'recover']);

Route::get('/Registro', [UserController::class, 'create'])->middleware('auth')->name('formUser');
Route::post('/Registro', [UserController::class, 'store'])->middleware('auth')->name('formUser');

Route::get('/Novedad', [NoveltyController::class, 'create'])->middleware('auth')->name('novelty');
Route::post('/Novedad', [NoveltyController::class, 'store'])->name('novelty');
Route::put('/novedad', [NoveltyController::class,'update']);


Route::get('/ambientes', [ClassroomController::class, 'index'])->middleware('auth')->name('classrooms');
Route::get('/miambiente', [ClassroomController::class, 'myClassroom'])->middleware('auth')->name('myAmbient');
Route::get('/miambientehistorial/{id}', [ClassroomController::class, 'historyAmbient'])->middleware('auth');
Route::get('/ambiente/{id}', [ClassroomController::class, 'show'])->middleware('auth');
Route::post('/ambiente', [ClassroomController::class, 'store']);

Route::get('/setting', [UserController::class,'setting'])->middleware('auth')->name('setting');
Route::post('/changeEmail',[UserController::class, 'updateInformation'])->middleware('auth');

// middleware que restringe que permite el acceso a administrador
Route::middleware(['auth','validate-role-user:administrador'])->group(function(){
    Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users');
    Route::get('/user/{id}', [UserController::class,'edit'])->middleware('auth');
    Route::put('/user/{id}', [UserController::class,'update'])->middleware('auth');
    Route::post('/changeStateUser',[UserController::class, 'changeStateUser'])->middleware('auth');
    Route::post('/uploadData',[ImportController::class, 'store'])->middleware('auth')->name('uploadData');
});

Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->name('dashboard')->middleware('auth');
