<?php

use App\Http\Controllers\CanchasController;
use App\Http\Controllers\MunicipiosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//RUTAS MUNICIPIOS
Route::get('/Municipios/index', [MunicipiosController::class, 'index'])->name('municipios.index');


//RUTAS CANCHAS
Route::get('/Canchas/index', [CanchasController::class, 'index'])->name('canchas.index');