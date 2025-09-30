<?php

namespace App\Http\Controllers;

use App\Models\Canchas;
use App\Models\municipios;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $municipios = municipios::all();
        $canchas = Canchas::all();
        return view('/vistaUsuario', compact('municipios', 'canchas'));
    }
}
