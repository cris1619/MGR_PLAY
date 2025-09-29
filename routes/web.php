<?php

use App\Http\Controllers\CanchasController; 
use App\Http\Controllers\MunicipiosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//RUTAS MUNICIPIOS
Route::get('/Municipios/index', [MunicipiosController::class, 'index'])->name('municipios.index');
Route::get('/Municipios/create', [MunicipiosController::class, 'create'])->name('municipios.create');
Route::post('/Municipios/store', [MunicipiosController::class, 'store'])->name('municipios.store');
Route::get('/Municipios/edit/{id}', [MunicipiosController::class, 'edit'])->name('municipios.edit');
Route::post('/Municipios/update/{id}', [MunicipiosController::class, 'update'])->name('municipios.update');
Route::post('/Municipios/delete/{id}', [MunicipiosController::class, 'destroy'])->name('municipios.destroy');

//RUTAS CANCHAS
Route::get('/Canchas/index', [CanchasController::class, 'index'])->name('canchas.index');
