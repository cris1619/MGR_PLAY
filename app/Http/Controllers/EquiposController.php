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
    public function index(Request $request)
    {
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

        return view('equipos.index', compact('equipos', 'municipios', 'perPage'));
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
