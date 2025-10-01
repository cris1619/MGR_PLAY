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
    public function index()
    {
        $equipos = Equipos::all();
        $jugadores = Jugadores::all();
        return view('jugadores.index', compact('equipos','jugadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jugadores = Jugadores::all();
        $equipos = Equipos::all();
        return view('jugadores.create', compact('equipos', 'jugadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jugadores = Jugadores::create($request->all());
        return redirect()->route('jugadores.index')->with('success', 'Jugador creado con éxito');
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
        $jugadores = Jugadores::findOrFail($id);
        $equipos = Equipos::all();
        return view('jugadores.edit', compact('equipos', 'jugadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jugadores $jugadores)
    {
        $jugadores->update($request->all());
        return redirect()->route('jugadores.index')->with('success', 'Jugador actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jugadores = Jugadores::findOrFail($id);
        $jugadores->delete();
        return redirect()->route('jugadores.index')->with('success', 'Jugador eliminado con éxito');
    }
}
