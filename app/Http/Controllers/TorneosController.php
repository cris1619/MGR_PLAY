<?php

namespace App\Http\Controllers;


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
    $request->validate([
        'nombre' => 'required|string',
        'tipo' => 'required|in:Grupos,Liguilla,Eliminacion',
        'equipos' => 'required|array|min:2',
        'equipos.*' => 'integer|exists:equipos,id',
        'cantidad_grupos' => 'nullable|integer|min:1',
        'partidos_por_enfrentamiento' => 'nullable|in:1,2',
    ]);

    $torneo = Torneos::create([
        'idMunicipio' => $request->idMunicipio ?? null,
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion ?? null,
        'tipo' => $request->tipo,
        'estado' => 'Pendiente',
        'fecha_inicio' => $request->fecha_inicio ?? null,
        'fecha_fin' => $request->fecha_fin ?? null,
        'num_equipos' => count($request->equipos),
        'cantidad_grupos' => $request->cantidad_grupos ?? null,
        'equipos_por_grupo' => $request->equipos_por_grupo ?? null,
        'clasificados_por_grupo' => $request->clasificados_por_grupo ?? null,
        'partidos_por_enfrentamiento' => $request->partidos_por_enfrentamiento ?? 1,
        'premio' => $request->premio ?? null,
    ]);

    // Asociar equipos (usa tu modelo Torneo_Equipo)
    foreach ($request->equipos as $idEquipo) {
        Torneo_Equipo::create([
            'idTorneo' => $torneo->id,
            'idEquipo' => $idEquipo,
        ]);
    }

    // Generar partidos según tipo
    if ($request->tipo === 'Grupos') {
        $this->generarGrupos($torneo, $request->equipos, $request->cantidad_grupos ?? 1);
    } elseif ($request->tipo === 'Liguilla') {
        $this->generarLiguilla($torneo, $request->equipos, $request->partidos_por_enfrentamiento ?? 1);
    } elseif ($request->tipo === 'Eliminacion') {
        $this->generarEliminacion($torneo, $request->equipos);
    }

    return redirect()->route('torneos.index')->with('success', 'Torneo creado correctamente');
}




    // ==========================
    // GENERAR GRUPOS
    // ==========================

    private function generarGrupos($torneo, $equipos, $num_grupos)
    {
        $equiposMezclados = collect($equipos)->shuffle();
        $grupos = [];

        // Crear grupos A, B, C...
        for ($i = 0; $i < $num_grupos; $i++) {
            $grupo = Grupo::create([
                'nombre' => 'Grupo ' . chr(65 + $i),
                'idTorneo' => $torneo->id
            ]);
            $grupos[] = $grupo;
        }

        // Asignar equipos a grupos
        $index = 0;
        foreach ($equiposMezclados as $equipo) {
            Grupo_Equipo::create([
                'idGrupo' => $grupos[$index % $num_grupos]->id,
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


    // ==========================
    // LIGUILLA
    // ==========================

    private function generarLiguilla($torneo, $equipos, $ida_vuelta)
    {
        for ($i = 0; $i < count($equipos); $i++) {
            for ($j = $i + 1; $j < count($equipos); $j++) {

                // Partido ida
                $partido = Partido::create([
                    'id_torneo' => $torneo->id,
                    'fase' => 'Liguilla'
                ]);

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

                // Partido vuelta si aplica
                if ($ida_vuelta == 1) {
                    $partido2 = Partido::create([
                        'id_torneo' => $torneo->id,
                        'fase' => 'Liguilla'
                    ]);

                    Partido_Equipo::create([
                        'id_partido' => $partido2->id,
                        'id_equipo' => $equipos[$j],
                        'rol' => 'Local'
                    ]);

                    Partido_Equipo::create([
                        'id_partido' => $partido2->id,
                        'id_equipo' => $equipos[$i],
                        'rol' => 'Visitante'
                    ]);
                }
            }
        }
    }


    // ==========================
    // ELIMINACIÓN DIRECTA
    // ==========================

    private function generarEliminacion($torneo, $equipos)
    {
        shuffle($equipos);

        for ($i = 0; $i < count($equipos); $i += 2) {
            if (!isset($equipos[$i + 1])) break;

            $partido = Partido::create([
                'id_torneo' => $torneo->id,
                'fase' => 'Eliminación Ronda 1'
            ]);

            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => $equipos[$i],
                'rol' => 'Local'
            ]);

            Partido_Equipo::create([
                'id_partido' => $partido->id,
                'id_equipo' => $equipos[$i + 1],
                'rol' => 'Visitante'
            ]);
        }
    }
}
