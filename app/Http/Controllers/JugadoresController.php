<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use App\Models\Jugadores;
use App\Models\Municipios;
use Illuminate\Http\Request;

class JugadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
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

    return view('Jugadores.index', compact('equipos', 'municipios', 'jugadores', 'posiciones'));
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
        return view('Jugadores.create', compact('equipos', 'posiciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Jugadores::create($request->all());
        return redirect()->route('jugadores.index')->with('success', 'Jugador creado correctamente');
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
        return view('Jugadores.edit', compact('equipos', 'jugadores', 'posiciones'));
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
        return redirect()->route('Jugadores.index')
            ->with('success', 'Jugador eliminado correctamente');
    }
}

