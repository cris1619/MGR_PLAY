@extends('layouts.app')

@section('title', 'Editar Torneo')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white">
            <h4><i class="fas fa-edit"></i> Editar Torneo</h4>
        </div>

        <form action="{{ route('torneos.update', $torneos->id) }}" method="POST">
            @csrf
            <div class="card-body">

                {{-- Nombre --}}
                <div class="mb-3">
                    <label class="form-label">Nombre del Torneo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $torneos->nombre) }}" required>
                </div>

                {{-- Municipio --}}
                <div class="mb-3">
                    <label class="form-label">Municipio</label>
                    <select name="idMunicipio" class="form-control">
                        <option value="">Seleccione un municipio</option>
                        @foreach ($municipios as $mun)
                            <option value="{{ $mun->id }}" {{ old('idMunicipio', $torneos->idMunicipio) == $mun->id ? 'selected' : '' }}>
                                {{ $mun->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $torneos->descripcion) }}</textarea>
                </div>

                {{-- Premio --}}
                <div class="mb-3">
                    <label class="form-label">Premio</label>
                    <input type="text" name="premio" class="form-control" value="{{ old('premio', $torneos->premio) }}">
                </div>
                
                {{-- Estado --}}
                <div class="mb-3">
                    <label class="form-label">Estado del Torneo</label>
                    <select name="estado" class="form-control" required>
                        <option value="Pendiente" {{ old('estado', $torneos->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En curso" {{ old('estado', $torneos->estado) == 'En curso' ? 'selected' : '' }}>En curso</option>
                        <option value="Finalizado" {{ old('estado', $torneos->estado) == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                </div>

                {{-- Tipo de torneo --}}
                <div class="mb-3">
                    <label class="form-label">Tipo de Torneo</label>
                    <select name="tipo" id="tipo_torneo" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Grupos" {{ old('tipo', $torneos->tipo) == 'Grupos' ? 'selected' : '' }}>Fase de Grupos</option>
                        <option value="Eliminacion" {{ old('tipo', $torneos->tipo) == 'Eliminacion' ? 'selected' : '' }}>Eliminación Directa</option>
                        <option value="Liguilla" {{ old('tipo', $torneos->tipo) == 'Liguilla' ? 'selected' : '' }}>Liguilla (todos contra todos)</option>
                    </select>
                </div>

                {{-- Fechas --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $torneos->fecha_inicio) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $torneos->fecha_fin) }}">
                    </div>
                </div>

                {{-- Número de Equipos --}}
                <div class="mb-3">
                    <label class="form-label">Número de Equipos</label>
                    <input type="number" min="1" name="num_equipos" id="num_equipos_form" class="form-control"
                           value="{{ $torneos->num_equipos }}" required readonly>
                </div>

                {{-- Equipos Participantes --}}
                <div class="mb-3">
                    <label class="form-label">Equipos Participantes</label>
                    <select name="equipos[]" 
                            class="selectpicker w-100" 
                            data-style="btn-dark"
                            multiple 
                            data-live-search="true" 
                            required>
                        @foreach ($equipos as $eq)
                            <option value="{{ $eq->id }}" {{ $torneos->equipos->contains($eq->id) ? 'selected' : '' }}>
                                {{ $eq->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <small class="text-muted">Seleccione los equipos participantes</small>
                </div>

                {{-- Configuración Grupos --}}
                <div id="config_grupos" class="mt-3 border rounded p-3 d-none">
                    <h5 class="text-primary"><i class="fas fa-layer-group"></i> Configuración de Grupos</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de Grupos</label>
                            <input type="number" min="1" name="cantidad_grupos" id="num_grupos" class="form-control" value="{{ $torneos->cantidad_grupos }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Equipos por Grupo</label>
                            <input type="number" id="equipos_por_grupo" name="equipos_por_grupo" class="form-control" readonly value="{{ $torneos->equipos_por_grupo }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Clasifican por Grupo</label>
                            <input type="number" min="1" name="clasificados_por_grupo" id="clasifican_por_grupo" class="form-control" value="{{ $torneos->clasificados_por_grupo }}">
                        </div>
                    </div>
                </div>

                {{-- Configuración Liguilla --}}
                <div id="config_liguilla" class="mt-3 border rounded p-3 d-none">
                    <h5 class="text-primary"><i class="fas fa-sync-alt"></i> Configuración Liguilla</h5>
                    <label class="form-label">¿Ida y Vuelta?</label>
                    <select name="partidos_por_enfrentamiento" class="form-control">
                        <option value="1" {{ $torneos->partidos_por_enfrentamiento == 1 ? 'selected' : '' }}>Solo Ida</option>
                        <option value="2" {{ $torneos->partidos_por_enfrentamiento == 2 ? 'selected' : '' }}>Ida y Vuelta</option>
                    </select>
                </div>

                {{-- Configuración Eliminación --}}
                <div id="config_eliminacion" class="mt-3 border rounded p-3 d-none">
                    <h5 class="text-primary"><i class="fas fa-times-circle"></i> Eliminación Directa</h5>
                    <p class="text-muted">Las llaves se generarán automáticamente según el número de equipos.</p>
                </div>

                <button class="btn btn-success w-100 mt-3">
                    <i class="fas fa-check"></i> Actualizar Torneo
                </button>

            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.selectpicker').selectpicker();
    $('#tipo_torneo').on('change', mostrarConfig);

    actualizarGrupos();
    $('select[name="equipos[]"]').on('changed.bs.select', actualizarGrupos);
    $('#num_grupos').on('keyup change', actualizarGrupos);
});

// Mantener la misma lógica de mostrar configuración y cálculo de grupos que en creación
function mostrarConfig() {
    let tipo = $('#tipo_torneo').val();
    $('#config_grupos, #config_liguilla, #config_eliminacion').addClass('d-none');

    if (tipo === 'Grupos') {
        $('#config_grupos').removeClass('d-none');
    } else if (tipo === 'Liguilla') {
        $('#config_liguilla').removeClass('d-none');
    } else if (tipo === 'Eliminacion') {
        $('#config_eliminacion').removeClass('d-none');
    }

    actualizarGrupos();
}

function actualizarGrupos() {
    let selectedEquipos = $('select[name="equipos[]"]').val() || [];
    let numEquipos = selectedEquipos.length;
    $('#num_equipos_form').val(numEquipos);

    let numGrupos = parseInt($('#num_grupos').val()) || 0;
    if (numGrupos > 0 && numEquipos > 0) {
        let porGrupo = Math.floor(numEquipos / numGrupos);
        let sobrantes = numEquipos % numGrupos;

        $('#equipos_por_grupo').val(porGrupo);

        $('#info_grupos').text(
            `Con ${numEquipos} equipos: ${numGrupos} grupos de ${porGrupo} equipos` +
            (sobrantes > 0 ? ` y ${sobrantes} grupo(s) con 1 extra` : ``)
        );
    } else {
        $('#equipos_por_grupo').val('');
        $('#info_grupos').text('');
    }
}
</script>
@endsection
