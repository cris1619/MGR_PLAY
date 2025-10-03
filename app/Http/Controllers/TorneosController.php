<?php

namespace App\Http\Controllers;

use App\Models\municipios;
use App\Models\Torneos;
use Illuminate\Http\Request;

class TorneosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 🔍 Capturar filtros desde la request
        $search      = $request->input('search');
        $idMunicipio = $request->input('idMunicipio');
        $estado      = $request->input('estado');
        $tipoDeporte = $request->input('tipoDeporte');

        // 📌 Consulta base
        $query = Torneos::with('municipios');

        // Filtro por nombre
        if (!empty($search)) {
            $query->where('nombre', 'LIKE', "%{$search}%");
        }

        // Filtro por municipio
        if (!empty($idMunicipio)) {
            $query->where('idMunicipio', $idMunicipio);
        }

        // Filtro por estado
        if (!empty($estado)) {
            $query->where('estado', $estado);
        }

        // Filtro por tipo de deporte
        if (!empty($tipoDeporte)) {
            $query->where('tipoDeporte', $tipoDeporte);
        }

        // 📌 Paginación (10 por página)
        $torneos = $query->orderBy('fechaInicio', 'desc')->paginate(10);

        // 📌 Municipios para el filtro
        $municipios = municipios::all();

        return view('torneos.index', compact('torneos', 'municipios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Necesitamos municipios para el <select>
        $municipios = municipios::all();

        return view('torneos.create', compact('municipios'));
    }

    /**
     * Guardar un nuevo torneo en la BD
     */
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'idMunicipio'   => 'required|exists:municipios,id',
            'descripcion'   => 'required|string',
            'numeroEquipos' => 'required|integer|min:2',
            'estado'        => 'required|in:activo,inactivo',
            'tipoDeporte'   => 'required|string',
            'formato'       => 'required|string',
            'fechaInicio'   => 'required|date',
            'fechaFin'      => 'required|date|after_or_equal:fechaInicio',
            'premio'        => 'nullable|numeric|min:0',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Guardar logo si existe
        $data = $request->all();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('torneos', 'public');
        }

        // Crear torneo
        Torneos::create($data);

        return redirect()->route('torneos.index')
            ->with('success', '🏆 Torneo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Torneos $torneos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $torneos = Torneos::findOrFail($id);
        return view('torneos.edit', compact('torneos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $torneos = Torneos::findOrFail($id);
        $torneos->update($request->all());

        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $torneos = Torneos::findOrFail($id);
        $torneos->delete();

        return redirect()->route('torneos.index')->with('success', 'Torneo eliminado exitosamente.');
    }
}
