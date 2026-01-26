<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Canchas;
use App\Models\Clasificacion;
use App\Models\Equipos;
use App\Models\Jugadores;
use App\Models\Municipios;
use App\Models\Partido;
use App\Models\Torneos;
use App\Services\userService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(userService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $municipios = Municipios::all();
        $canchas = Canchas::all();
        $admin = Auth::user();
        $accesosRapidos = [
            'totalJugadores' => $this->userService->totalJugadores(),
            'totalEquipos' => $this->userService->totalEquipos(),
            'totalCanchas' => $this->userService->totalCanchas(),
        ];

        // Obtener los próximos 5 partidos a partir de hoy
    // Fecha de hoy (inicio del día)
    $hoy = Carbon::now()->startOfDay();

    // Traer próximos 5 partidos con relaciones relevantes
    $partidos = Partido::with(['equipos', 'cancha.municipio', 'torneo', 'arbitro'])
        ->where('fecha', '>=', $hoy)
        ->orderBy('fecha', 'asc')
        ->take(5)
        ->get();

    // Normalizar para la vista: crear propiedades equipoLocal y equipoVisitante
   $partidosProximos = $partidos->map(function ($p) {

    $local = $p->equipos->firstWhere('pivot.rol', 'Local');
    $visitante = $p->equipos->firstWhere('pivot.rol', 'Visitante');

    $p->equipoLocal = $local;
    $p->equipoVisitante = $visitante;

    return $p;
});


    // Otras colecciones que usas en la vista
    $municipios = Municipios::all();
    $canchas = Canchas::all();
    $torneos = Torneos::all();
    $equipos = Equipos::all();


    return view('Usuario.vistaUsuario', compact(
        'municipios',
        'canchas',
        'accesosRapidos',
        'admin',
        'partidosProximos',
        'torneos',
        'equipos'
    ));
    }

    public function listaEquipos(Request $request)
{
    $admin = Auth::user();
    $query = Equipos::with('municipio');

        // Buscar por nombre
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        // Buscar por municipio
        if ($request->filled('IdMunicipio')) {
            $query->where('IdMunicipio', $request->IdMunicipio);
        }

        // 🔹 Límite de registros (10, 25, 50 o todos)
        $perPage = $request->input('per_page', 10); // por defecto 10

        if ($perPage == 'all') {
            $equipos = $query->get(); // trae todos
        } else {
            $equipos = $query->paginate((int)$perPage)->appends($request->query());
        }

        $municipios = Municipios::all();

        return view('Usuario.listaEquipos', compact('equipos', 'municipios', 'perPage','admin'));
}

   public function listaJugadores(Request $request)
{
    // Filtros
    $admin = Auth::user();
    // Obtener equipos y municipios para los selects
    $equipos = Equipos::all();
    $municipios = Municipios::all();

    // Lista de posiciones
    $posiciones = ['portero', 'defensa', 'mediocentro', 'delantero', 'lateral izquierdo', 'lateral derecho', 'defensa central', 'extremo izquierdo', 'extremo derecho'];

    // Query base
    $query = Jugadores::with('equipos');

    // Filtro por nombre
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nombre', 'like', '%' . $request->search . '%')
              ->orWhere('apellido', 'like', '%' . $request->search . '%');
        });
    }

    // Filtro por posición
    if ($request->filled('posicion')) {
        $query->where('posicion', $request->posicion);
    }

    // Filtro por equipo
    if ($request->filled('idEquipo')) {
        $query->where('idEquipo', $request->idEquipo);
    }

    // Filtro por municipio del equipo
    if ($request->filled('idMunicipio')) {
        $query->whereHas('equipos', function($q) use ($request) {
            $q->where('idMunicipio', $request->idMunicipio);
        });
    }

    // Paginación
    $jugadores = $query->paginate(10)->appends($request->all());

    return view('Usuario.listaJugadores', compact('equipos', 'municipios', 'jugadores', 'posiciones','admin'));
}

public function listaPartidos(Request $request)
{
    $admin = Auth::user();
    // 1. Cargar las variables necesarias para los filtros (Selects)
    $municipios = Municipios::orderBy('nombre')->get();
    $torneos = Torneos::orderBy('nombre')->get(); 
    
    // 2. Iniciar la consulta de Partidos con las relaciones necesarias
    $query = Partido::with('equipos');

    // 3. Aplicar Filtro por Municipio (CORREGIDO: Usando 'id_municipio')
    if ($request->filled('municipio_id')) {
        // El valor viene de la vista como 'municipio_id', pero el filtro usa 'id_municipio'
        $query->where('id_municipio', $request->municipio_id); 
    }
    
    // 4. Aplicar Filtro por Torneo (CORREGIDO: Usando 'id_torneo')
    if ($request->filled('torneo_id')) {
        // El valor viene de la vista como 'torneo_id', pero el filtro usa 'id_torneo'
        $query->where('id_torneo', $request->torneo_id);
    }
    
    // 5. Obtener los resultados paginados con los filtros aplicados
    $partidos = $query->paginate(15)->withQueryString(); 

    // 6. Enviar todas las variables a la vista
    return view('Usuario.listaPartidos', compact('partidos', 'municipios', 'torneos', 'admin'));
}

public function listaTorneos(Request $request)
    {
        $admin = Auth::user();
        // Iniciar la consulta del modelo Torneo
        $query = Torneos::query();

        // Aplicar filtro por nombre (si se ha introducido)
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        // Obtener los torneos paginados (incluyendo los parámetros de búsqueda)
        $torneos = $query->with('municipio') // Asegúrate de cargar la relación 'municipio'
                        ->orderBy('estado', 'asc') // Poner los activos primero
                        ->orderBy('fecha_inicio', 'desc')
                        ->paginate(12)
                        ->withQueryString();

        return view('Usuario.listaTorneos', compact('torneos','admin'));
    }

    public function listaTorneosShow($id)
{$admin = Auth::user();
    $torneo = Torneos::findOrFail($id);

    $partidos = Partido::where('id_torneo', $id)
        ->with(['partido_equipos.equipo'])
        ->orderBy('fase') // ordenar por fase: Octavos, Cuartos, Semis, Final
        ->get();

    $clasificacion = null;

    if ($torneo->tipo === 'liga' || $torneo->tipo === 'grupos') {
        $clasificacion = Clasificacion::where('id_torneo', $id)
            ->with('equipo')
            ->get();
    }

    return view('Usuario.listaTorneosShow', compact('torneo', 'partidos', 'clasificacion','admin'));
}

}
