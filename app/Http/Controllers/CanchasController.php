<?php

namespace App\Http\Controllers;

use App\Models\Canchas;
use Illuminate\Http\Request;

class CanchasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $canchas = Canchas::all();
        return view('welcome', compact('canchas'));
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
    public function show(Canchas $canchas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Canchas $canchas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Canchas $canchas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Canchas $canchas)
    {
        //
    }
}
