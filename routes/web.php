<?php

use App\Http\Controllers\CanchasController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//RUTA USUARIO
Route::get('/usuario/index', [UserController::class, 'index'])->name('usuario.vistaUsuario');



//RUTAS MUNICIPIOS
Route::get('/Municipios/index', [MunicipiosController::class, 'index'])->name('municipios.index');
Route::get('/Municipios/create', [MunicipiosController::class, 'create'])->name('municipios.create');
Route::post('/Municipios/store', [MunicipiosController::class, 'store'])->name('municipios.store');
Route::get('/Municipios/edit/{id}', [MunicipiosController::class, 'edit'])->name('municipios.edit');
Route::post('/Municipios/update/{id}', [MunicipiosController::class, 'update'])->name('municipios.update');
Route::post('/Municipios/delete/{id}', [MunicipiosController::class, 'destroy'])->name('municipios.destroy');

//RUTAS CANCHAS
Route::get('/Canchas/index', [CanchasController::class, 'index'])->name('canchas.index');
Route::get('/Canchas/create', [CanchasController::class, 'create'])->name('canchas.create');
Route::post('/Canchas/store', [CanchasController::class, 'store'])->name('canchas.store');
Route::get('/Canchas/edit/{id}', [CanchasController::class, 'edit'])->name('canchas.edit');
Route::post('/Canchas/update/{id}', [CanchasController::class, 'update'])->name('canchas.update');
Route::post('/Canchas/delete/{id}', [CanchasController::class, 'destroy'])->name('canchas.destroy');

//RUTAS EQUIPOS
Route::get('/Equipos/index', [EquiposController::class, 'index'])->name('equipos.index');
Route::get('/Equipos/create', [EquiposController::class, 'create'])->name('equipos.create');
Route::post('/Equipos/store', [EquiposController::class, 'store'])->name('equipos.store');
Route::get('/Equipos/edit/{id}', [EquiposController::class, 'edit'])->name('equipos.edit');
Route::post('/Equipos/update/{id}', [EquiposController::class, 'update'])->name('equipos.update');
Route::post('/Equipos/delete/{id}', [EquiposController::class, 'destroy'])->name('equipos.destroy');
