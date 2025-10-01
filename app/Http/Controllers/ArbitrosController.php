<?php

namespace App\Http\Controllers;

use App\Models\arbitros;
use Illuminate\Http\Request;

class ArbitrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $arbitros = arbitros::all();
        return view('Arbitros.index', compact('arbitros'));
    }

    // GET: formulario para crear
    public function create()
    {
        return view('Arbitros.create');
    }

    // POST: guardar nuevo municipio
    public function store(Request $request)
    {
        arbitros::create($request->all());
        return redirect()->route('Arbitros.index')
                         ->with('success', 'Arbitro registrado correctamente');
    }

    // GET: mostrar un municipio
    public function show()
    {
        //
    }

    // GET: formulario editar
    public function edit($id)
    {
        $arbitros = arbitros::findOrFail($id);
        return view('Arbitros.edit', compact('arbitros'));
    }

    // POST: actualizar municipio (sin PUT)
    public function update(Request $request, $id)
    {        
        $arbitros = arbitros::findOrFail($id);
        $arbitros->update($request->all());
        return redirect()->route('Arbitros.index')
                         ->with('success', 'Arbitro actualizado correctamente');
    }

    // POST: eliminar municipio (sin DELETE)
    public function destroy($id)
    {
        $arbitros = arbitros::findorFail($id);
        $arbitros->delete();
        return redirect()->route('Arbitros.index')
                         ->with('success', 'Arbitro eliminado correctamente');
    }
}
