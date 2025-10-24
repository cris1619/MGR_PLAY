<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use App\Models\Jugadores;
use Illuminate\Http\Request;

class JugadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    // Obtener equipos para el select
    $equipos = Equipos::all();

    // Lista de posiciones (puedes cambiarla si usas tabla de posiciones en BD)
    $posiciones = [
        'portero', 'mediocentro', 'delantero',
        'lateral izquierdo', 'lateral derecho', 'defensa central',
        'extremo izquierdo', 'extremo derecho'
    ];

    // Query base
    $query = Jugadores::with('equipos');

    // 🧩 Hashtable (arreglo asociativo) de filtros
    $filtros = [
        'posicion' => $request->posicion,
        'idEquipo' => $request->idEquipo,
    ];

    // 🔍 Filtro por nombre o apellido
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nombre', 'like', '%' . $request->search . '%')
              ->orWhere('apellido', 'like', '%' . $request->search . '%');
        });
    }

    // 🔁 Aplicar automáticamente los filtros del hashtable
    foreach ($filtros as $campo => $valor) {
        if (!empty($valor)) {
            $query->where($campo, $valor);
        }
    }

    // 📌 Paginación
    $jugadores = $query->paginate(10)->appends($request->all());

    // Retornar vista
    return view('jugadores.index', compact('equipos', 'jugadores', 'posiciones', 'filtros'));
}



    public function buscar(Request $request)
{
    $query = Jugadores::with('equipos');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nombre', 'like', '%' . $request->search . '%')
              ->orWhere('apellido', 'like', '%' . $request->search . '%');
        });
    }

    $jugadores = $query->limit(10)->get(); // muestra los primeros 10 resultados

    return response()->json($jugadores);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipos::all();
        $posiciones = [
            'portero',
            'defensa central',
            'lateral izquierdo',
            'lateral derecho',
            'mediocentro',
            'extremo izquierdo',
            'extremo derecho',
            'delantero centro'
        ];
        return view('jugadores.create', compact('equipos', 'posiciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Jugadores::create($request->all());
        return redirect()->route('jugadores.index')->with('success', 'Jugador creado correctamente ✅');
    }


    /**
     * Display the specified resource.
     */
    public function show(Jugadores $jugadores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jugadores = Jugadores::find($id);
        $equipos = Equipos::all();
        $posiciones = [
            'portero',
            'defensa central',
            'lateral izquierdo',
            'lateral derecho',
            'mediocentro',
            'extremo izquierdo',
            'extremo derecho',
            'delantero centro'
        ];
        return view('jugadores.edit', compact('equipos', 'jugadores', 'posiciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jugadores = Jugadores::find($id);
        $jugadores->update($request->all());
        return redirect()->route('jugadores.index')->with('success', 'Jugador actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jugadores = Jugadores::findorFail($id);
        $jugadores->delete();
        return redirect()->route('jugadores.index')
            ->with('success', 'Jugador eliminado correctamente');
    }
}

