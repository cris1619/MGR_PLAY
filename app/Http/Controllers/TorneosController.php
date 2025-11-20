<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use App\Models\Equipos;
use App\Models\Grupo;
use App\Models\Grupo_Equipo;
use App\Models\municipios;
use App\Models\Partido;
use App\Models\Partido_Equipo;
use App\Models\Torneo_Equipo;
use App\Models\Torneos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TorneosController extends Controller
{
    public function index()
    {
        $torneos = Torneos::all();
        return view('torneos.index', compact('torneos'));
    }

    public function create()
    {
        $equipos = Equipos::where('estado', 'activo')->get();
        $municipios = municipios::all();
        return view('torneos.create', compact('equipos', 'municipios'));
    }

    public function store(Request $request)
    {

        // Validación de equipos pares
        if (count($request->equipos) % 2 !== 0) {
            return back()
                ->with('error', 'No se puede crear el torneo porque el número de equipos es impar. Selecciona un número par de equipos.')
                ->withInput();
        }

        $request->validate([
            'nombre' => 'required|string',
            'tipo' => 'required|in:Grupos,Liguilla,Eliminacion',
            'equipos' => 'required|array|min:2',
            'equipos.*' => 'integer|exists:equipos,id',
            'cantidad_grupos' => 'nullable|integer|min:1',
            'partidos_por_enfrentamiento' => 'nullable|in:1,2',
        ]);

        $totalEquipos = count($request->equipos);
        $numGrupos = $request->cantidad_grupos;

        // ✅ Validación para Eliminación Directa - Solo permite equipos PARES
        if ($request->tipo === 'Eliminacion') {
            if ($totalEquipos % 2 !== 0) {
                return back()->withErrors("El torneo de Eliminación Directa solo maneja equipos PARES. Tienes $totalEquipos equipos (impar). Selecciona " . ($totalEquipos + 1) . " o " . ($totalEquipos - 1) . " equipos.")->withInput();
            }
        }

        // ✅ Validación para torneos por grupos
        if ($request->tipo === 'Grupos') {
            if (!$numGrupos || $numGrupos == 0) {
                $numGrupos = ceil($totalEquipos / 4);
                $request->merge(['cantidad_grupos' => $numGrupos]);
            }

            if ($totalEquipos < $numGrupos) {
                return back()->withErrors("No puede haber más grupos que equipos")->withInput();
            }

            $equiposPorGrupo = floor($totalEquipos / $numGrupos);
        }

        // ✅ Crear Torneo
        $torneo = Torneos::create([
            'idMunicipio' => $request->idMunicipio ?? null,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion ?? null,
            'tipo' => $request->tipo,
            'estado' => 'Pendiente',
            'fecha_inicio' => $request->fecha_inicio ?? null,
            'fecha_fin' => $request->fecha_fin ?? null,
            'num_equipos' => $totalEquipos,
            'cantidad_grupos' => $numGrupos ?? null,
            'equipos_por_grupo' => $equiposPorGrupo ?? null,
            'clasificados_por_grupo' => $request->clasificados_por_grupo ?? null,
            'partidos_por_enfrentamiento' => $request->partidos_por_enfrentamiento ?? 1,
            'premio' => $request->premio ?? null,
        ]);

        // ✅ Guardar equipos del torneo
        foreach ($request->equipos as $idEquipo) {
            Torneo_Equipo::create([
                'idTorneo' => $torneo->id,
                'idEquipo' => $idEquipo,
            ]);
        }

        // ✅ Generar torneo según tipo
        if ($request->tipo === 'Grupos') {
            $this->generarGrupos($torneo, $request->equipos, $numGrupos);
        } elseif ($request->tipo === 'Liguilla') {
            $this->generarLiguilla($torneo, $request->equipos, $request->partidos_por_enfrentamiento ?? 1);
        } elseif ($request->tipo === 'Eliminacion') {
            $this->generarEliminacion($torneo, $request->equipos);
        }

        return redirect()->route('torneos.index')->with('success', 'Torneo creado correctamente');
    }

    public function show($id)
    {
        $torneo = Torneos::with(['municipio', 'equipos'])->findOrFail($id);
        return view('torneos.show', compact('torneo'));
    }

    public function edit($id)
    {
        $torneos = Torneos::with('equipos')->findOrFail($id);
        $equipos = Equipos::where('estado', 'activo')->get();
        $municipios = municipios::all();

        return view('torneos.edit', compact('torneos', 'equipos', 'municipios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'tipo' => 'required|in:Grupos,Liguilla,Eliminacion',
            'equipos' => 'required|array|min:2',
            'equipos.*' => 'integer|exists:equipos,id',
            'cantidad_grupos' => 'nullable|integer|min:1',
            'partidos_por_enfrentamiento' => 'nullable|in:1,2',
        ]);

        $torneo = Torneos::findOrFail($id);

        $torneo->update([
            'idMunicipio' => $request->idMunicipio ?? null,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion ?? null,
            'tipo' => $request->tipo,
            'estado' => $request->estado ?? $torneo->estado,
            'fecha_inicio' => $request->fecha_inicio ?? null,
            'fecha_fin' => $request->fecha_fin ?? null,
            'num_equipos' => count($request->equipos),
            'cantidad_grupos' => $request->cantidad_grupos ?? null,
            'equipos_por_grupo' => $request->equipos_por_grupo ?? null,
            'clasificados_por_grupo' => $request->clasificados_por_grupo ?? null,
            'partidos_por_enfrentamiento' => $request->partidos_por_enfrentamiento ?? 1,
            'premio' => $request->premio ?? null,
        ]);

        Torneo_Equipo::where('idTorneo', $torneo->id)->delete();

        foreach ($request->equipos as $idEquipo) {
            Torneo_Equipo::create([
                'idTorneo' => $torneo->id,
                'idEquipo' => $idEquipo,
            ]);
        }

        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado correctamente');
    }

    public function destroy($id)
    {
        $torneo = Torneos::findOrFail($id);

        Torneo_Equipo::where('idTorneo', $torneo->id)->delete();
        Grupo::where('idTorneo', $torneo->id)->delete();

        Partido_Equipo::whereIn('id_partido', function($query) use ($torneo) {
            $query->select('id')->from('partidos')->where('id_torneo', $torneo->id);
        })->delete();

        Partido::where('id_torneo', $torneo->id)->delete();

        $torneo->delete();

        return redirect()->route('torneos.index')->with('success', 'Torneo eliminado correctamente');
    }

    // ==========================
    // GENERAR GRUPOS
    // ==========================

    private function generarGrupos($torneo, $equipos, $num_grupos)
    {
        $equiposMezclados = collect($equipos)->shuffle();
        $grupos = [];

        for ($i = 0; $i < $num_grupos; $i++) {
            $grupo = Grupo::create([
                'nombre' => 'Grupo ' . chr(65 + $i),
                'idTorneo' => $torneo->id
            ]);
            $grupos[] = $grupo;
        }

        $index = 0;
        foreach ($equiposMezclados as $equipo) {
            $grupoIndex = $index % $num_grupos;

            Grupo_Equipo::create([
                'idGrupo' => $grupos[$grupoIndex]->id,
                'idEquipo' => $equipo,
            ]);
            $index++;
        }

        $this->generarPartidosGrupos($torneo);
    }

    private function generarPartidosGrupos($torneo)
    {
        $grupos = Grupo::where('idTorneo', $torneo->id)->with('equipos')->get();

        foreach ($grupos as $grupo) {
            $equipos = $grupo->equipos;

            for ($i = 0; $i < count($equipos); $i++) {
                for ($j = $i + 1; $j < count($equipos); $j++) {

                    $partido = Partido::create([
                        'id_torneo' => $torneo->id,
                        'id_grupo' => $grupo->id,
                        'fase' => 'Grupos'
                    ]);

                    Partido_Equipo::create([
                        'id_partido' => $partido->id,
                        'id_equipo' => $equipos[$i]->id,
                        'rol' => 'Local'
                    ]);

                    Partido_Equipo::create([
                        'id_partido' => $partido->id,
                        'id_equipo' => $equipos[$j]->id,
                        'rol' => 'Visitante'
                    ]);
                }
            }
        }
    }

    private function generarCrucesSiguienteRonda($torneo)
{
    $grupos = Grupo::where('idTorneo', $torneo->id)->with('equipos')->get();

    // Obtener los primeros y segundos de cada grupo (simulado si no hay resultados aún)
    $puestosPorGrupo = [];
    foreach ($grupos as $grupo) {
        // Ordenar por puntos, goles, etc. Aquí simulamos que el primer equipo es 1er lugar, segundo es 2do
        $equiposOrdenados = $grupo->equipos->sortByDesc('puntos')->values(); 
        $puestosPorGrupo[$grupo->nombre] = [
            '1' => $equiposOrdenados[0] ?? null,
            '2' => $equiposOrdenados[1] ?? null,
        ];
    }

    $cruces = [];
    $grupoNombres = $grupos->pluck('nombre')->toArray();

    // Cruces tipo A1 vs B2, B1 vs A2, C1 vs D2...
    for ($i = 0; $i < count($grupoNombres); $i += 2) {
        $g1 = $grupoNombres[$i];
        $g2 = $grupoNombres[$i + 1] ?? null;

        if ($g2) {
            $cruces[] = [
                'local' => $puestosPorGrupo[$g1]['1']?->nombre ?? 'Pendiente',
                'visitante' => $puestosPorGrupo[$g2]['2']?->nombre ?? 'Pendiente',
            ];
            $cruces[] = [
                'local' => $puestosPorGrupo[$g2]['1']?->nombre ?? 'Pendiente',
                'visitante' => $puestosPorGrupo[$g1]['2']?->nombre ?? 'Pendiente',
            ];
        }
    }

    return $cruces;
}



    // ==========================
    // LIGUILLA
    // ==========================

private function generarLiguilla($torneo, $equipos, $idaVuelta = 1)
{
    // Convertir a enteros por seguridad
    $equipos = array_map('intval', $equipos);

    // Mezclar los equipos para aleatoriedad
    shuffle($equipos);

    $numEquipos = count($equipos);
    $jornada = 1;

    // Iniciamos transacción para mayor seguridad
    DB::beginTransaction();

    // Crear clasificación inicial de la liguilla
foreach ($equipos as $idEquipo) {
    Clasificacion::firstOrCreate(
        [
            'id_torneo' => $torneo->id,
            'id_equipo' => $idEquipo,
        ],
        [
            'grupo'            => null,
            'puntos'           => 0,
            'partidos_jugados' => 0,
            'ganados'          => 0,
            'empatados'        => 0,
            'perdidos'         => 0,
            'goles_favor'      => 0,
            'goles_contra'     => 0,
        ]
    );
}


    try {
        for ($i = 0; $i < $numEquipos; $i++) {
            for ($j = $i + 1; $j < $numEquipos; $j++) {

                // --- PARTIDO IDA ---
                $partido = Partido::create([
                    'id_torneo' => $torneo->id,
                    'fase' => "Jornada $jornada",
                    'jugado' => 0,
                    'fecha' => null,
                    'hora' => null,
                ]);

                // Crear relaciones con equipos
                if ($equipos[$i] > 0 && $equipos[$j] > 0) {
                    Partido_Equipo::create([
                        'id_partido' => $partido->id,
                        'id_equipo' => $equipos[$i],
                        'rol' => 'Local'
                    ]);

                    Partido_Equipo::create([
                        'id_partido' => $partido->id,
                        'id_equipo' => $equipos[$j],
                        'rol' => 'Visitante'
                    ]);
                }

                // --- PARTIDO VUELTA (si aplica) ---
                if ($idaVuelta == 2) {
                    $partidoVuelta = Partido::create([
                        'id_torneo' => $torneo->id,
                        'fase' => "Jornada $jornada",
                        'jugado' => 0,
                        'fecha' => null,
                        'hora' => null,
                    ]);

                    if ($equipos[$i] > 0 && $equipos[$j] > 0) {
                        Partido_Equipo::create([
                            'id_partido' => $partidoVuelta->id,
                            'id_equipo' => $equipos[$j],
                            'rol' => 'Local'
                        ]);

                        Partido_Equipo::create([
                            'id_partido' => $partidoVuelta->id,
                            'id_equipo' => $equipos[$i],
                            'rol' => 'Visitante'
                        ]);
                    }
                }

                $jornada++;
            }
        }

        DB::commit(); // Confirmamos la transacción
    } catch (\Exception $e) {
        DB::rollBack(); // Revertimos en caso de error
        dd("Error al generar la liguilla: " . $e->getMessage());
    }
}

public function clasificacionLiguilla($idTorneo)
{
    $torneo = Torneos::findOrFail($idTorneo);

    // Traer clasificación ordenada
    $clasificacion = Clasificacion::where('id_torneo', $idTorneo)
        ->orderBy('puntos', 'desc')
        ->orderByRaw('(goles_favor - goles_contra) DESC') // diferencia de goles
        ->orderBy('goles_favor', 'desc')
        ->get();

    return view('torneos.clasificacion_liguilla', compact('torneo', 'clasificacion'));
}

public function clasificacion($id)
{
    $torneo = Torneos::findOrFail($id);

    $clasificacion = Clasificacion::with('equipo')
        ->where('id_torneo', $id)
        ->orderBy('puntos', 'desc')
        ->orderByRaw('(goles_favor - goles_contra) DESC') // DG
        ->orderBy('goles_favor', 'desc')
        ->get();

    return view('torneos.clasificacion', compact('torneo', 'clasificacion'));
}


    // ==========================
    // ELIMINACIÓN DIRECTA
    // ==========================

    private function generarEliminacion($torneo, $equipos)
{
    $cantidadEquipos = count($equipos);

    // Si la cantidad no es potencia de 2, agregar BYEs
    $potencias = [2, 4, 8, 16, 32, 64];
    $objetivo = null;

    foreach ($potencias as $p) {
        if ($cantidadEquipos <= $p) {
            $objetivo = $p;
            break;
        }
    }

    // Rellenar con null (BYEs)
    while (count($equipos) < $objetivo) {
        $equipos[] = null;
    }

    // Ronda 1
    $ronda = 1;
    $partidos = [];

    for ($i = 0; $i < count($equipos); $i += 2) {

        if ($equipos[$i] == null && $equipos[$i+1] == null) {
            continue;
        }

        $partido = Partido::create([
            'id_torneo' => $torneo->id,
            'fase' => "Ronda $ronda",
        ]);

        // Solo insertar si existe equipo
        if ($equipos[$i] !== null) {
            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => $equipos[$i],
                'rol' => 'Local'
            ]);
        }

        if ($equipos[$i+1] !== null) {
            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => $equipos[$i+1],
                'rol' => 'Visitante'
            ]);
        }

        // Guardamos solo elementos que pasan
        if ($equipos[$i] !== null && $equipos[$i+1] !== null) {

            // Ambos juegan → pasa el partido para la siguiente ronda
            $partidos[] = $partido;

        } elseif ($equipos[$i] !== null) {

            // Solo existe el primero → pasa automáticamente
            $partidos[] = $equipos[$i];

        } else {

            // Solo existe el segundo
            $partidos[] = $equipos[$i+1];
        }
    }

    $this->generarSiguientesRondas($torneo, $partidos, $ronda + 1);
}


private function generarSiguientesRondas($torneo, $participantes, $ronda)
{
    if (count($participantes) == 1) {
        return;
    }

    $nuevaRonda = [];

    for ($i = 0; $i < count($participantes); $i += 2) {

        $equipo1 = $participantes[$i];
        $equipo2 = $participantes[$i+1] ?? null;

        // Si no hay rival, guardamos el equipo para enfrentarlo en la siguiente ronda
        if (!$equipo2) {
            $nuevaRonda[] = $equipo1;
            continue;
        }

        // Crear partido normal
        $partido = Partido::create([
            'id_torneo' => $torneo->id,
            'fase' => "Ronda $ronda",
        ]);

        // Equipo 1
        if ($equipo1 instanceof Partido) {
            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => null,
                'rol' => 'Ganador Ronda Anterior'
            ]);
        } else {
            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => $equipo1,
                'rol' => 'Local'
            ]);
        }

        // Equipo 2
        if ($equipo2 instanceof Partido) {
            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => null,
                'rol' => 'Ganador Ronda Anterior'
            ]);
        } else {
            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => $equipo2,
                'rol' => 'Visitante'
            ]);
        }

        // El ganador de este partido pasa a la siguiente ronda
        $nuevaRonda[] = $partido;
    }

    // Siguiente ronda
    $this->generarSiguientesRondas($torneo, $nuevaRonda, $ronda + 1);
}


}
