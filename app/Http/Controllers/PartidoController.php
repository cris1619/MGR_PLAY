<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\arbitros; // <- modelo de árbitros
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partidos = Partido::with('equipos')->get();
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
        return view('Partidos.edit', compact('partido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $partido = Partido::findOrFail($id);
        $partido->update($request->only(['fecha', 'hora', 'fase', 'jugado']));

        // Actualizar goles en la tabla pivote
        foreach ($request->goles as $equipo_id => $goles) {
            $partido->equipos()->updateExistingPivot($equipo_id, ['goles' => $goles]);
        }

        // Marcar como jugado
        $partido->jugado = true;
        $partido->save();

        // Detectar ganador
        $equipos = $partido->equipos;
        if ($equipos->count() == 2) {
            $equipo1 = $equipos[0];
            $equipo2 = $equipos[1];
            $goles1 = $equipo1->pivot->goles;
            $goles2 = $equipo2->pivot->goles;

            if ($goles1 > $goles2) {
                $ganador_id = $equipo1->id;
            } elseif ($goles2 > $goles1) {
                $ganador_id = $equipo2->id;
            } else {
                $ganador_id = null; // Empate
            }

            // Buscar el siguiente partido en el mismo torneo y ronda siguiente
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

        return redirect()->route('torneos.show', $partido->id_torneo)->with('success', 'Partido actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        //
    }

    /**
     * Show the form for editing the schedule of the specified resource.
     */
    public function editSchedule($id)
    {
        $partido = Partido::with('partido_equipos.equipo')->findOrFail($id);
        $arbitros = arbitros::orderBy('nombre')->get();
        return view('Partidos.edit_schedule', compact('partido', 'arbitros'));
    }

    /**
     * Update the schedule of the specified resource in storage.
     */
    public function updateSchedule(Request $request, $id)
    {
        $p = Partido::findOrFail($id);

        $data = $request->validate([
            'fecha' => 'nullable|date',
            'hora' => 'nullable',
            'fase' => 'nullable|string|max:255',
            'lugar' => 'nullable|string|max:255',
            'cancha' => 'nullable|string|max:255',
            'arbitro_id' => 'nullable|exists:arbitros,id',
        ]);

        $p->update($data);

        return redirect()->route('torneos.show', $p->id_torneo)->with('success', 'Programación actualizada.');
    }

    /**
     * Show the form for editing the result of the specified resource.
     */
    public function editResult($id)
    {
        $partido = Partido::with('equipos')->findOrFail($id);
        return view('Partidos.edit_result', compact('partido'));
    }

    /**
     * Update the result of the specified resource in storage.
     */
    public function updateResult(Request $request, $id)
    {
        $request->validate([
            'goles' => 'required|array',
            'goles.*' => 'nullable|integer|min:0',
        ]);

        $partido = Partido::with('equipos')->findOrFail($id);

        // actualizar goles en pivote
        foreach ($request->goles as $equipo_id => $goles) {
            $partido->equipos()->updateExistingPivot($equipo_id, ['goles' => (int)$goles]);
        }

        // marcar jugado
        $partido->jugado = 1;
        $partido->save();

        // determinar ganador (si hay dos equipos)
        $equipos = $partido->equipos;
        if ($equipos->count() >= 2) {
            $e1 = $equipos[0];
            $e2 = $equipos[1];
            $g1 = (int) ($e1->pivot->goles ?? 0);
            $g2 = (int) ($e2->pivot->goles ?? 0);

            $ganador_id = null;
            if ($g1 > $g2) $ganador_id = $e1->id;
            elseif ($g2 > $g1) $ganador_id = $e2->id;

            if ($ganador_id) {
                // buscar partidos de siguiente ronda en este torneo
                $rondaActual = $this->getRonda($partido->fase);
                $siguienteRonda = 'Ronda ' . ($rondaActual + 1);

                $siguientes = Partido::where('id_torneo', $partido->id_torneo)
                    ->where('fase', $siguienteRonda)
                    ->get();

                foreach ($siguientes as $s) {
                    // Buscar pivote libre (acepta NULL o 0 por si quedó como 0)
                    $pivot = $s->partido_equipos()
                        ->where('rol', 'Ganador Ronda Anterior')
                        ->where(function($q){
                            $q->whereNull('id_equipo')->orWhere('id_equipo', 0);
                        })->first();

                    if ($pivot) {
                        // actualizar de forma segura
                        $pivot->id_equipo = $ganador_id;
                        $pivot->save();

                        // opcional: log para depuración
                        \Log::info('Asignado ganador a siguiente partido', [
                            'partido_origen' => $partido->id,
                            'partido_destino' => $s->id,
                            'ganador_id' => $ganador_id,
                            'pivot_id' => $pivot->id
                        ]);

                        break;
                    }
                }
            }
        }

        return redirect()->route('torneos.show', $partido->id_torneo)->with('success', 'Resultado registrado.');
    }

    // Helper para obtener el número de ronda
    private function getRonda($fase)
    {
        if (preg_match('/Ronda\s*(\d+)/i', $fase, $m)) return (int)$m[1];
        return 1;
    }
}
