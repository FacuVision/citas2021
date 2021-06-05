<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Livewire\Navigation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CitaController;
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
    return view('welcome');
});

Route::get('/a',[Navigation::class,'render']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('reservar', CitaController::class)->names('cita.reserva'); // 
