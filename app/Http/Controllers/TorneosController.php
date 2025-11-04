<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Equipo;
use App\Models\Equipos;
use App\Models\Grupo;
use App\Models\Grupo_Equipo;
use App\Models\GrupoEquipo;
use App\Models\Partido;
use App\Models\Partido_Equipo;
use App\Models\PartidoEquipo;
use App\Models\Torneo_Equipo;
use App\Models\TorneoEquipo;
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
        return view('torneos.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'tipo_torneo' => 'required',
            'equipos' => 'required|array|min:2',
        ]);

        // Crear torneo
        $torneo = Torneos::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo_torneo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'num_equipos' => count($request->equipos),
            'cantidad_grupos' => $request->num_grupos ?? null,
            'clasificados_por_grupo' => $request->clasifican_por_grupo ?? null,
            'partidos_por_enfrentamiento' => $request->ida_vuelta ?? 1,
        ]);

        // Asociar equipos a torneo
        foreach ($request->equipos as $idEquipo) {
            Torneo_Equipo::create([
                'idTorneo' => $torneo->id,
                'idEquipo' => $idEquipo,
            ]);
        }

        // Tipos de torneo
        if ($request->tipo_torneo == 'grupos') {
            $this->generarGrupos($torneo, $request->equipos, $request->num_grupos);
        }
        elseif ($request->tipo_torneo == 'liguilla') {
            $this->generarLiguilla($torneo, $request->equipos, $request->ida_vuelta);
        }
        elseif ($request->tipo_torneo == 'eliminacion') {
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
