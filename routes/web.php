<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CanchasController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\ArbitrosController;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TorneosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


//rutas para login
Route::get('/login',[AdminController::class,'verlogin'])->name('login');
Route::post('/loginsubmit',[AdminController::class,'login'])->name('login.submit');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

//RUTAS REGISTRO
Route::get('/registro', [AdminController::class, 'verRegistro'])->name('registro');
Route::post('/registro-submit', [AdminController::class, 'registro'])->name('registro.submit');

//RUTA USUARIO
Route::get('/usuario/index', [UserController::class, 'index'])->name('usuario.vistaUsuario');
Route::get('/usuario/listaEquipos', [UserController::class, 'listaEquipos'])->name('usuario.listaEquipos');
Route::get('/usuario/listaJugadores', [UserController::class, 'listaJugadores'])->name('usuario.listaJugadores');

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
Route::get('/Equipos/show/{id}', [EquiposController::class, 'show'])->name('equipos.show');


//Rutas arbitros
Route::get('/Arbitros/index',[ArbitrosController::class,'index'])->name('Arbitros.index');
Route::get('/Arbitros/create', [ArbitrosController::class, 'create'])->name('Arbitros.create');
Route::post('/Arbitros/store', [ArbitrosController::class, 'store'])->name('Arbitros.store');
Route::get('/Arbitros/edit/{id}', [ArbitrosController::class, 'edit'])->name('Arbitros.edit');
Route::post('/Arbitros/update/{id}', [ArbitrosController::class, 'update'])->name('Arbitros.update');
Route::post('/Arbitros/delete/{id}', [ArbitrosController::class, 'destroy'])->name('Arbitros.destroy');

//RUTAS JUGADORES
Route::get('/Jugadores/index', [JugadoresController::class, 'index'])->name('jugadores.index');
Route::get('/Jugadores/create', [JugadoresController::class, 'create'])->name('jugadores.create');
Route::post('/Jugadores/store', [JugadoresController::class, 'store'])->name('jugadores.store');
Route::get('/Jugadores/edit/{id}', [JugadoresController::class, 'edit'])->name('jugadores.edit');
Route::post('/Jugadores/update/{id}', [JugadoresController::class, 'update'])->name('jugadores.update');
Route::post('/Jugadores/delete/{id}', [JugadoresController::class, 'destroy'])->name('jugadores.destroy');

//Rutas Torneos
Route::get('/Torneos/index', [TorneosController::class, 'index'])->name('torneos.index');
Route::get('/Torneos/create', [TorneosController::class, 'create'])->name('torneos.create');
Route::post('/Torneos/store', [TorneosController::class, 'store'])->name('torneos.store');
Route::get('/Torneos/edit/{id}', [TorneosController::class, 'edit'])->name('torneos.edit');
Route::post('/Torneos/update/{id}', [TorneosController::class, 'update'])->name('torneos.update');
Route::post('/Torneos/delete/{id}', [TorneosController::class, 'destroy'])->name('torneos.destroy');
Route::get('/Torneos/show/{id}', [TorneosController::class, 'show'])->name('torneos.show');

//Rutas Partidos
Route::get('/Partidos/index', [PartidoController::class,'index'])->name('partidos.index');
Route::get('/partidos/create', [PartidoController::class, 'create'])->name('partidos.create');
Route::post('/partidos/store', [PartidoController::class, 'store'])->name('partidos.store');    
Route::get('/partidos/{partido}/edit', [PartidoController::class, 'edit'])->name('partidos.edit');
Route::put('/partidos/{partido}', [PartidoController::class, 'update'])->name('partidos.update');
Route::delete('/partidos/{partido}', [PartidoController::class, 'destroy'])->name('partidos.destroy');
