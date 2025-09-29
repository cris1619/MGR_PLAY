<?php

namespace App\Http\Controllers;

use App\Models\Canchas;
use App\Models\municipios;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipios = municipios::all();
        $canchas = Canchas::all();
        return view('Municipios.index', compact('municipios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(municipios $municipios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(municipios $municipios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, municipios $municipios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(municipios $municipios)
    {
        //
    }
}
