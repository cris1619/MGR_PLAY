<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use App\Models\municipios;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipos::all();
        $municipios = municipios::all();
        return view('equipos.index', compact('equipos', 'municipios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipos::all();
        $municipios = municipios::all();
        return view('equipos.create', compact('equipos', 'municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $equipos = Equipos::create($request->all());
        return redirect()->route('equipos.index')->with('success', 'Equipo creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipos $equipos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipos = Equipos::find($id);
        $municipios = municipios::all();
        return view('equipos.edit', compact('equipos', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $equipos = Equipos::find($id);
        $equipos->update($request->all());
        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipos = Equipos::find($id);
        $equipos->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado con éxito');
    }
}
