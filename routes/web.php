<?php

use App\Http\Controllers\CanchasController;
use App\Http\Controllers\MunicipiosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MunicipiosController::class, 'index'])->name('welcome');





Route::get('/', [CanchasController::class, 'index'])->name('welcome');