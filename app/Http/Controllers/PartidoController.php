<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partidos = Partido::with(['equipos', 'cancha', 'arbitro'])->get();
        return view('Partidos.index', compact('partidos'));
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
    public function show(Partido $partido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partido = Partido::with('equipos')->findOrFail($id);
        $municipios = \App\Models\municipios::all();
        $canchas = \App\Models\Canchas::all();
        $arbitros = \App\Models\arbitros::all();
        return view('Partidos.edit', compact('partido', 'municipios', 'canchas', 'arbitros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $partido = Partido::findOrFail($id);
        
        // Determinar si es actualización de información básica o marcador
        if ($request->has('is_marcador')) {
            // Actualizar solo marcador y penales
            $this->actualizarMarcador($request, $partido);
        } else {
            // Actualizar información básica (fecha, hora, fase, municipio, cancha, arbitro)
            $partido->update($request->only(['fecha', 'hora', 'fase', 'id_municipio', 'id_cancha', 'id_arbitro']));
        }

        return redirect()->route('torneos.show', $partido->id_torneo)->with('success', 'Partido actualizado correctamente');
    }

    /**
     * Actualizar marcador y detectar ganador (incluyendo penales)
     */
    private function actualizarMarcador(Request $request, $partido)
    {
        // Actualizar goles en la tabla pivote
        if ($request->has('goles')) {
            foreach ($request->goles as $equipo_id => $goles) {
                $partido->equipos()->updateExistingPivot($equipo_id, ['goles' => $goles]);
            }
        }

        // Actualizar penales si existen
        if ($request->has('penales')) {
            foreach ($request->penales as $equipo_id => $penales) {
                $partido->equipos()->updateExistingPivot($equipo_id, ['penales' => $penales]);
            }
        }

        // Marcar como jugado
        $partido->jugado = true;
        $partido->save();

        // Detectar ganador
        $equipos = $partido->equipos()->get();
        if ($equipos->count() == 2) {
            $equipo1 = $equipos[0];
            $equipo2 = $equipos[1];
            $goles1 = $equipo1->pivot->goles ?? 0;
            $goles2 = $equipo2->pivot->goles ?? 0;
            $penales1 = $equipo1->pivot->penales ?? 0;
            $penales2 = $equipo2->pivot->penales ?? 0;

            $ganador_id = null;

            // Primero comparar goles
            if ($goles1 > $goles2) {
                $ganador_id = $equipo1->id;
            } elseif ($goles2 > $goles1) {
                $ganador_id = $equipo2->id;
            } else {
                // Empate en goles, comparar penales
                if ($penales1 > $penales2) {
                    $ganador_id = $equipo1->id;
                } elseif ($penales2 > $penales1) {
                    $ganador_id = $equipo2->id;
                }
            }

            // Asignar el ganador al siguiente partido
            if ($ganador_id) {
                $rondaActual = $this->getRonda($partido->fase);
                $siguienteRonda = 'Ronda ' . ($rondaActual + 1);

                // Buscar todos los partidos de la siguiente ronda en este torneo
                $siguientesPartidos = Partido::where('id_torneo', $partido->id_torneo)
                    ->where('fase', $siguienteRonda)
                    ->get();

                // Asignar el ganador en el primer campo pivote libre con rol 'Ganador Ronda Anterior'
                foreach ($siguientesPartidos as $siguientePartido) {
                    $pivot = $siguientePartido->partido_equipos()
                        ->where('rol', 'Ganador Ronda Anterior')
                        ->whereNull('id_equipo')
                        ->first();

                    if ($pivot) {
                        $pivot->id_equipo = $ganador_id;
                        $pivot->save();
                        break; // Solo asigna una vez por partido jugado
                    }
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        //
    }

    // Helper para obtener el número de ronda
    private function getRonda($fase)
    {
        if (preg_match('/Ronda (\d+)/', $fase, $matches)) {
            return (int)$matches[1];
        }
        return 1;
    }
}
