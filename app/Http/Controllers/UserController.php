<?php

namespace App\Http\Controllers;

use App\Models\Canchas;
use App\Models\Equipos;
use App\Models\Jugadores;
use App\Models\municipios;
use App\Services\userService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(userService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $municipios = municipios::all();
        $canchas = Canchas::all();
        $accesosRapidos = [
            'totalJugadores' => $this->userService->totalJugadores(),
            'totalEquipos' => $this->userService->totalEquipos(),
            'totalCanchas' => $this->userService->totalCanchas(),
        ];

        return view('usuario.vistaUsuario', compact('municipios', 'canchas', 'accesosRapidos'));
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
   public function listaJugadores(Request $request)
{
    // Filtros
    $query = Jugadores::with('equipos'); // Cargamos relación con equipos

    // 🔍 Buscar por nombre o apellido
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nombre', 'like', "%$search%")
              ->orWhere('apellido', 'like', "%$search%");
        });
    }

    // 📌 Filtrar por posición
    if ($request->filled('posicion')) {
        $query->where('posicion', $request->posicion);
    }

    // 📌 Filtrar por equipo
    if ($request->filled('idEquipo')) {
        $query->where('idEquipo', $request->idEquipo);
    }

    // 📌 Paginación (con opción "todos")
    $perPage = $request->get('per_page', 10);
    if ($perPage === 'all') {
        $jugadores = $query->get();
    } else {
        $jugadores = $query->paginate($perPage)->appends($request->query());
    }

    // Pasamos también la lista de equipos al filtro
    $equipos = Equipos::all();

    return view('usuario.listaJugadores', compact('jugadores', 'equipos'));
}



}
