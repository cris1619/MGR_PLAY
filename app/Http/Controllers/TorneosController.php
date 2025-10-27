<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Equipo;
use App\Models\Grupo;
use App\Models\GrupoEquipo;
use App\Models\Partido;
use App\Models\Clasificacion;
use App\Models\Equipos;
use App\Models\Grupo_Equipo;
use App\Models\Torneos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TorneosController extends Controller
{
    /**
     * Muestra todos los torneos
     */
    public function index()
    {
        $torneos = Torneos::with('municipio')->get();
        return view('torneos.index', compact('torneos'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        $equipos = Equipos::where('estado', 'activo')->get();
        return view('torneos.create', compact('equipos'));
    }

    /**
     * Guarda un nuevo torneo
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:Grupos,Liguilla,Eliminacion',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'num_equipos' => 'nullable|integer|min:2',
        ]);

        $torneo = Torneos::create($request->all());

        // Si seleccionó equipos en el formulario
        if ($request->has('equipos')) {
            foreach ($request->equipos as $idEquipo) {
                DB::table('torneo_equipo')->insert([
                    'idTorneo' => $torneo->id,
                    'idEquipo' => $idEquipo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Generar automáticamente según tipo
        switch ($torneo->tipo) {
            case 'Grupos':
                $this->generarGrupos($torneo->id);
                $this->generarPartidosGrupos($torneo->id);
                break;

            case 'Liguilla':
                $this->generarLiguilla($torneo->id);
                break;

            case 'Eliminacion':
                $this->generarEliminacion($torneo->id);
                break;
        }

        return redirect()->route('torneos.index')->with('success', 'Torneo creado correctamente.');
    }

    /**
     * Mostrar detalles del torneo
     */
    public function show($id)
    {
        $torneo = Torneos::with(['equipos', 'grupos.equipos', 'clasificacion'])->findOrFail($id);
        return view('torneos.show', compact('torneo'));
    }

    /**
     * Editar torneo
     */
    public function edit($id)
    {
        $torneo = Torneos::findOrFail($id);
        $equipos = Equipos::where('estado', 'activo')->get();
        return view('torneos.edit', compact('torneo', 'equipos'));
    }

    /**
     * Actualizar torneo
     */
    public function update(Request $request, $id)
    {
        $torneo = Torneos::findOrFail($id);
        $torneo->update($request->all());
        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado correctamente.');
    }

    /**
     * Eliminar torneo
     */
    public function destroy($id)
    {
        Torneos::findOrFail($id)->delete();
        return back()->with('success', 'Torneo eliminado correctamente.');
    }

    /* ================================================================
     *                  LÓGICA DEL TORNEO
     * ================================================================*/

    /**
     * Generar grupos según número de equipos
     */
    private function generarGrupos($idTorneo)
    {
        $torneo = Torneos::with('equipos')->findOrFail($idTorneo);
        $equipos = $torneo->equipos;

        if ($equipos->count() < 4) return;

        $numGrupos = $torneo->cantidad_grupos ?? 2;
        $equiposPorGrupo = ceil($equipos->count() / $numGrupos);
        $equiposAleatorios = $equipos->shuffle()->values();

        Grupo::where('idTorneo', $torneo->id)->delete();

        for ($i = 0; $i < $numGrupos; $i++) {
            $grupo = Grupo::create([
                'nombre' => 'Grupo ' . chr(65 + $i),
                'idTorneo' => $torneo->id,
            ]);

            $subset = $equiposAleatorios->slice($i * $equiposPorGrupo, $equiposPorGrupo);

            foreach ($subset as $equipo) {
                Grupo_Equipo::create([
                    'idGrupo' => $grupo->id,
                    'idEquipo' => $equipo->id,
                ]);
            }
        }
    }

    /**
     * Generar partidos de fase de grupos (Round Robin)
     */
    private function generarPartidosGrupos($idTorneo)
    {
        $torneo = Torneos::with('grupos.equipos')->findOrFail($idTorneo);

        foreach ($torneo->grupos as $grupo) {
            $equipos = $grupo->equipos;

            for ($i = 0; $i < $equipos->count(); $i++) {
                for ($j = $i + 1; $j < $equipos->count(); $j++) {
                    $partido = Partido::create([
                        'id_torneo' => $torneo->id,
                        'id_grupo' => $grupo->id,
                        'fase' => 'Grupos',
                        'fecha' => now()->addDays(rand(1, 10)),
                        'hora' => '15:00:00',
                    ]);

                    DB::table('partido_equipos')->insert([
                        [
                            'id_partido' => $partido->id,
                            'id_equipo' => $equipos[$i]->id,
                            'rol' => 'Local',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'id_partido' => $partido->id,
                            'id_equipo' => $equipos[$j]->id,
                            'rol' => 'Visitante',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    ]);
                }
            }
        }
    }

    /**
     * Generar liguilla (todos contra todos)
     */
    private function generarLiguilla($idTorneo)
    {
        $torneo = Torneos::with('equipos')->findOrFail($idTorneo);
        $equipos = $torneo->equipos;

        for ($i = 0; $i < $equipos->count(); $i++) {
            for ($j = $i + 1; $j < $equipos->count(); $j++) {
                $partido = Partido::create([
                    'id_torneo' => $torneo->id,
                    'fase' => 'Liguilla',
                    'fecha' => now()->addDays(rand(1, 10)),
                    'hora' => '16:00:00',
                ]);

                DB::table('partido_equipos')->insert([
                    ['id_partido' => $partido->id, 'id_equipo' => $equipos[$i]->id, 'rol' => 'Local', 'created_at' => now(), 'updated_at' => now()],
                    ['id_partido' => $partido->id, 'id_equipo' => $equipos[$j]->id, 'rol' => 'Visitante', 'created_at' => now(), 'updated_at' => now()],
                ]);
            }
        }
    }

    /**
     * Generar torneo de eliminación directa
     */
    private function generarEliminacion($idTorneo)
    {
        $torneo = Torneos::with('equipos')->findOrFail($idTorneo);
        $equipos = $torneo->equipos->shuffle();

        if ($equipos->count() % 2 != 0) return;

        for ($i = 0; $i < $equipos->count(); $i += 2) {
            $partido = Partido::create([
                'id_torneo' => $torneo->id,
                'fase' => 'Eliminación directa',
                'fecha' => now()->addDays(rand(1, 5)),
                'hora' => '18:00:00',
            ]);

            DB::table('partido_equipos')->insert([
                ['id_partido' => $partido->id, 'id_equipo' => $equipos[$i]->id, 'rol' => 'Local', 'created_at' => now(), 'updated_at' => now()],
                ['id_partido' => $partido->id, 'id_equipo' => $equipos[$i + 1]->id, 'rol' => 'Visitante', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
