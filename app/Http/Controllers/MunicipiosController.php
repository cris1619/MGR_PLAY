<?php

namespace App\Http\Controllers;

use App\Models\Municipios;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{
    // GET: lista de municipios
    public function index()
    {
        $municipios = Municipios::all();
        return view('municipios.index', compact('municipios'));
    }

    // GET: formulario para crear
    public function create()
    {
        return view('municipios.create');
    }

    // POST: guardar nuevo municipio
    public function store(Request $request)
    {
        Municipios::create($request->all());
        return redirect()->route('municipios.index')
                         ->with('success', 'Municipio creado correctamente');
    }

    // GET: mostrar un municipio
    public function show()
    {
        //
    }

    // GET: formulario editar
    public function edit($id)
    {
        $municipio = Municipios::findOrFail($id);
        return view('municipios.edit', compact('municipio'));
    }

    // POST: actualizar municipio (sin PUT)
    public function update(Request $request, $id)
    {        
        $municipio = Municipios::findOrFail($id);
        $municipio->update($request->all());
        return redirect()->route('municipios.index')
                         ->with('success', 'Municipio actualizado correctamente');
    }

    // POST: eliminar municipio (sin DELETE)
    public function destroy($id)
    {
        $municipio = Municipios::findOrFail($id);

        // Validar si el municipio tiene canchas asociadas
        if ($municipio->canchas()->count() > 0) {
            return redirect()->route('municipios.index')
                ->with('error', 'No puedes eliminar este municipio porque tiene canchas asociadas.');
        }

        $municipio->delete();

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio eliminado correctamente.');
    }
}
