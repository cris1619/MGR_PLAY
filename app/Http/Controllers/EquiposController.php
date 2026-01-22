<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use App\Models\municipios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return view('Equipos.index', compact('equipos', 'municipios', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipos::all();
        $municipios = Municipios::all();
        return view('Equipos.create', compact('equipos', 'municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar primero
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'entrenador' => 'required|string|max:255',
        'idMunicipio' => 'required|exists:municipios,id',
        'estado' => 'required|in:activo,inactivo',
        'escudo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Guardar archivo
    if ($request->hasFile('escudo')) {
        $file = $request->file('escudo');
        $filename = time() . '_' . $file->getClientOriginalName();


        // Guardar en storage/app/public/escudos
        Storage::putFileAs('public/escudos', $file, $filename);

        $validated['escudo'] = $filename; // Guardar nombre en la BD
    }

    // Crear equipo
    Equipos::create($validated);

    return redirect()->route('equipos.index')->with('success', 'Equipo creado con éxito');
}

    /**
     * Display the specified resource.
     */
public function show($id)
{
    $admin = $admin = Auth::user();;
    $equipo = Equipos::with('municipio')
        ->withCount(['partidos', 'jugadores'])
        ->findOrFail($id);
    
    return view('Equipos.show', compact('equipo','admin'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipos = Equipos::find($id);
        $municipios = Municipios::all();
        return view('Equipos.edit', compact('equipos', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $equipo = Equipos::findOrFail($id);
    $data = $request->all();



   // Guardar archivo
    if ($request->hasFile('escudo')) {
        $file = $request->file('escudo');
        $filename = time() . '_' . $file->getClientOriginalName();


        // Guardar en storage/app/public/escudos
        Storage::putFileAs('public/escudos', $file, $filename);

        $data['escudo'] = $filename; // Guardar nombre en la BD

        // Eliminar el escudo antiguo si existe
        if ($equipo->escudo && Storage::exists('public/escudos/' . $equipo->escudo)) {
            Storage::delete('public/escudos/' . $equipo->escudo);
        }


    }

    $equipo->update($data);

    return redirect()->route('equipos.index')
        ->with('success', 'Equipo actualizado con éxito');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $equipos = Equipos::findOrFail($id);

        // Validar si el equipo tiene jugadores asociados
        if ($equipos->jugadores()->count() > 0) {
            return redirect()->route('Equipos.index')
                ->with('error', 'No puedes eliminar este equipo porque tiene jugadores asociados.');
        }


        // Eliminar el escudo 
        if ($equipos->escudo && Storage::exists('public/escudos/' . $equipos->escudo)) {
            Storage::delete('public/escudos/' . $equipos->escudo);
        }


        $equipos->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }


}

