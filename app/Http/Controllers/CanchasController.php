<?php

namespace App\Http\Controllers;

use App\Models\Municipios;
use App\Models\Canchas;
use Illuminate\Http\Request;

class CanchasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            // Obtener todos los municipios para llenar el select
            $municipios = \App\Models\Municipios::all();

            // Iniciar la consulta de canchas
            $query = \App\Models\Canchas::with('municipio');

            // Filtrar por municipio si se selecciona uno
            if ($request->filled('IdMunicipio')) {
                $query->where('IdMunicipio', $request->IdMunicipio);
            }

            // Ejecutar la consulta final
            $canchas = $query->get();

            // Retornar la vista con los datos
            return view('canchas.index', compact('canchas', 'municipios'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipios = Municipios::all();
        $canchas = Canchas::all();
        return view('canchas.create', compact('municipios', 'canchas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $canchas = new Canchas();
        $canchas->nombre = $request->input('nombre');
        $canchas->idMunicipio = $request->input('idMunicipio');
        $canchas->save();
        
        return redirect()->route('canchas.index')
        ->with('success', 'Cancha creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Canchas $canchas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $canchas = Canchas::find($id);
        $municipios = Municipios::all();
        return view('canchas.edit', compact('canchas', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $canchas  = Canchas::findOrFail($id);
        $canchas->update($request->all());
        return redirect()->route('canchas.index')
            ->with('success', 'Cancha actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $canchas = Canchas::findorFail($id);
        $canchas->delete();
        return redirect()->route('canchas.index')
            ->with('success', 'Cancha eliminada correctamente');
    }
}
