<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Equipo;
use App\Models\Grupo;
use App\Models\GrupoEquipo;
use App\Models\Partido;
use App\Models\Clasificacion;
use App\Models\Equipos;
use App\Models\Grupo_Equipo;
use App\Models\Torneos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TorneosController extends Controller
{
    /**
     * Muestra todos los torneos
     */
    public function index()
    {
        $torneos = Torneos::all();
        return view('Torneos.index', compact('torneos'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('Torneos.create');
    }

    /**
     * Guarda un nuevo torneo
     */
    public function store(Request $request)
    {
        $torneos = new Torneos();
        $torneos->nombre = $request->input('nombre');
        $torneos->descripcion = $request->input('descripcion');
        $torneos->save();
        return redirect()->route('torneos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $torneo = Torneos::with(['equipos', 'grupos.equipos', 'clasificacion'])->findOrFail($id);
        return view('torneos.show', compact('torneo'));
    }

    /**
     * Editar torneo
     */
    public function edit($id)
    {
        $torneo = Torneos::findOrFail($id);
        $equipos = Equipos::where('estado', 'activo')->get();
        return view('torneos.edit', compact('torneo', 'equipos'));
    }

    /**
     * Actualizar torneo
     */
    public function update(Request $request, $id)
    {
        $torneo = Torneos::findOrFail($id);
        $torneo->update($request->all());
        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado correctamente.');
    }

    /**
     * Eliminar torneo
     */
    public function edit($id)
    {
        $torneos = Torneos::find($id);
        return view('Torneos.edit', compact('torneos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $torneos = Torneos::find($id);
        $torneos->nombre = $request->input('nombre');
        $torneos->descripcion = $request->input('descripcion');
        $torneos->save();
        return redirect()->route('torneos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $torneos = Torneos::find($id);
        $torneos->delete();
        return redirect()->route('torneos.index');
    }
}
