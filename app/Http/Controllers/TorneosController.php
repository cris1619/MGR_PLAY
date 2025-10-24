<?php

namespace App\Http\Controllers;

use App\Models\Torneos;
use Illuminate\Http\Request;

class TorneosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $torneos = Torneos::all();
        return view('Torneos.index', compact('torneos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Torneos.create');
    }

    /**
     * Store a newly created resource in storage.
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
    public function show(Torneos $torneos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
