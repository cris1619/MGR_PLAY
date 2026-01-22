<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;
use App\Models\Clasificacion;
use App\Models\Torneos;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Retorna Illuminate\Pagination\LengthAwarePaginator (que tiene lastPage())
    $partidos = Partido::paginate(15); // Cambia 15 por la cantidad que desees por página
    return view('partidos.index', compact('partidos'));
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
    public function show($id)
{
    $partido = Partido::with(['equipos', 'arbitro', 'cancha', 'municipio', 'torneo'])
        ->findOrFail($id);

    return view('partidos.show', compact('partido'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partido = Partido::with('equipos')->findOrFail($id);
        $municipios = \App\Models\Municipios::all();
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
            $empate = false;

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
                }else {
                    // También empatan en penales
                    $empate = true;
                }

            }
            // Llamar actualización de clasificación
            $this->actualizarClasificacionPartido(
                $partido,
                $equipo1->id,
                $equipo2->id,
                $goles1,
                $goles2,
                $ganador_id,
                $empate
            );

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

    private function actualizarClasificacionPartido(
        $partido,
        int $idEquipo1,
        int $idEquipo2,
        int $goles1,
        int $goles2,
        ?int $ganador_id,
        bool $empate
    ) {
        // 1. Obtener torneo y grupo desde el partido
        $idTorneo = $partido->id_torneo;

        // Ajusta esto según tu modelo de Partido:
        // puede ser $partido->grupo (string),
        // o $partido->grupo->nombre, etc.
        $grupo = $partido->grupo ?? null;

        // 2. Actualizar clasificación para ambos equipos
        $this->actualizarFilaClasificacionEquipo(
            $idTorneo,
            $grupo,
            $idEquipo1,
            $goles1,
            $goles2,
            $ganador_id,
            $empate
        );

        $this->actualizarFilaClasificacionEquipo(
            $idTorneo,
            $grupo,
            $idEquipo2,
            $goles2,
            $goles1,
            $ganador_id,
            $empate
        );
    }

    /**
     * Actualiza o crea la fila de clasificación para UN equipo,
     * usando exactamente los campos de tu tabla `clasificacion`.
     */
    private function actualizarFilaClasificacionEquipo(
        int $idTorneo,
        ?string $grupo,
        int $idEquipo,
        int $gf,
        int $gc,
        ?int $ganador_id,
        bool $empate
    ) {
        // Buscar registro existente de este equipo en este torneo y grupo
        $clasificacion = Clasificacion::where('id_torneo', $idTorneo)
            ->where('id_equipo', $idEquipo)
            ->when($grupo !== null, fn($q) => $q->where('grupo', $grupo))
            ->first();

        if (!$clasificacion) {
            // Crear registro inicializado con ceros
            $clasificacion = new Clasificacion([
                'id_torneo'        => $idTorneo,
                'id_equipo'        => $idEquipo,
                'grupo'            => $grupo,
                'puntos'           => 0,
                'partidos_jugados' => 0,
                'ganados'          => 0,
                'empatados'        => 0,
                'perdidos'         => 0,
                'goles_favor'      => 0,
                'goles_contra'     => 0,
            ]);
        }

        // Partidos jugados
        $clasificacion->partidos_jugados += 1;

        // Goles
        $clasificacion->goles_favor  += $gf;
        $clasificacion->goles_contra += $gc;

        // Resultado
        if ($empate) {
            $clasificacion->empatados += 1;
            $clasificacion->puntos    += 1; // 1 punto por empate
        } else {
            if ($ganador_id === $idEquipo) {
                $clasificacion->ganados += 1;
                $clasificacion->puntos  += 3; // 3 puntos por victoria
            } else {
                $clasificacion->perdidos += 1;
                // 0 puntos por derrota
            }
        }

        $clasificacion->save();
    }
public function registrarResultado(Request $request, $idPartido)
{
    $partido = Partido::findOrFail($idPartido);

    // Validación
    $request->validate([
        'goles_local' => 'required|integer|min:0',
        'goles_visita' => 'required|integer|min:0',
    ]);

    // Guardamos los goles en Partido_Equipo
    $local = $partido->equipos()->where('rol', 'Local')->first();
    $visitante = $partido->equipos()->where('rol', 'Visitante')->first();

    $golesLocal = $request->goles_local;
    $golesVisita = $request->goles_visita;

    $local->pivot->goles = $golesLocal;
    $local->pivot->save();

    $visitante->pivot->goles = $golesVisita;
    $visitante->pivot->save();

    // Actualizar bandera
    $partido->jugado = 1;
    $partido->save();

    // Lógica para clasificación
    $empate = $golesLocal == $golesVisita;
    $ganador = null;

    if (!$empate) {
        $ganador = $golesLocal > $golesVisita ? $local->id : $visitante->id;
    }

    $this->actualizarFilaClasificacionEquipo(
        $partido->id_torneo,
        null,
        $local->id,
        $golesLocal,
        $golesVisita,
        $ganador,
        $empate
    );

    $this->actualizarFilaClasificacionEquipo(
        $partido->id_torneo,
        null,
        $visitante->id,
        $golesVisita,
        $golesLocal,
        $ganador,
        $empate
    );

    return back()->with('success', 'Resultado registrado correctamente.');
}


}
