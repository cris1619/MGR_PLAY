<?php

namespace App\Http\Controllers;

use App\Models\Canchas;
use App\Models\Equipos;
use App\Models\municipios;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $municipios = municipios::all();
        $canchas = Canchas::all();
        return view('usuario.vistaUsuario', compact('municipios', 'canchas'));
    }

    public function listaEquipos(Request $request)
{
    $query = Equipos::with('municipio');

    // Filtrar por municipio
    if ($request->filled('IdMunicipio')) {
        $query->where('idMunicipio', $request->IdMunicipio);
    }

    // Buscar por nombre
    if ($request->filled('search')) {
        $query->where('nombre', 'like', '%' . $request->search . '%');
    }

    // Paginación o todos
    if ($request->per_page === 'all') {
        $equipos = $query->get();
    } else {
        $perPage = $request->input('per_page', 10); // default 10
        $equipos = $query->paginate($perPage)->appends($request->all());
    }

    $municipios = Municipios::all();

    return view('Usuario.listaEquipos', compact('equipos', 'municipios'));
}


}
