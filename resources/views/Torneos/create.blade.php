@extends('layouts.app')

@section('title', 'Crear Torneo')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white">
            <h4><i class="fas fa-plus"></i> Crear Torneo</h4>
        </div>

        <form action="{{ route('torneos.store') }}" method="POST">
            @csrf
            <div class="card-body">

                {{-- Nombre --}}
                <div class="mb-3">
                    <label class="form-label">Nombre del Torneo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                {{-- Municipio --}}
                <div class="mb-3">
                    <label class="form-label">Municipio</label>
                    <select name="idMunicipio" class="form-control" required>
                        <option value="">Seleccione un municipio</option>
                        @foreach ($municipios as $mun)
                            <option value="{{ $mun->id }}" {{ old('idMunicipio') == $mun->id ? 'selected' : '' }}>
                                {{ $mun->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                </div>

                {{-- Premio --}}
                <div class="mb-3">
                    <label class="form-label">Premio</label>
                    <input type="text" name="premio" class="form-control" value="{{ old('premio') }}">
                </div>

                {{-- Tipo de torneo --}}
                <div class="mb-3">
                    <label class="form-label">Tipo de Torneo</label>
                    <select name="tipo" id="tipo_torneo" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Grupos" {{ old('tipo') == 'Grupos' ? 'selected' : '' }}>Fase de Grupos</option>
                        <option value="Eliminacion" {{ old('tipo') == 'Eliminacion' ? 'selected' : '' }}>Eliminación Directa</option>
                        <option value="Liguilla" {{ old('tipo') == 'Liguilla' ? 'selected' : '' }}>Liguilla (todos contra todos)</option>
                    </select>
                </div>

                {{-- Fechas --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
                    </div>
                </div>

                {{-- Número de Equipos (calculado automáticamente) --}}
                <div class="mb-3">
                    <label class="form-label">Número de Equipos</label>
                    <input type="number" min="1" name="num_equipos" id="num_equipos_form" class="form-control"
                           value="{{ old('num_equipos') }}" required readonly>
                </div>

                {{-- Equipos Participantes --}}
                <div class="mb-3">
                    <label class="form-label">Equipos Participantes</label>
                    <select name="equipos[]" class="form-control select2" multiple required size="6">
                        @foreach ($equipos as $eq)
                            <option value="{{ $eq->id }}" {{ collect(old('equipos'))->contains($eq->id) ? 'selected' : '' }}>
                                {{ $eq->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Seleccione los equipos que jugarán este torneo</small><br>
                    <a href="{{ route('equipos.create') }}" class="btn btn-sm btn-outline-primary mt-2">
                        <i class="fas fa-plus"></i> Agregar nuevo equipo
                    </a>
                </div>

                {{-- Configuración Grupos --}}
                <div id="config_grupos" class="mt-3 border rounded p-3 {{ old('tipo') == 'Grupos' ? '' : 'd-none' }}">
                    <h5 class="text-primary"><i class="fas fa-layer-group"></i> Configuración de Grupos</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de Grupos</label>
                            <input type="number" min="1" name="cantidad_grupos" id="num_grupos" class="form-control" value="{{ old('cantidad_grupos') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Equipos por Grupo</label>
                            <input type="number" id="equipos_por_grupo" name="equipos_por_grupo" class="form-control" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Clasifican por Grupo</label>
                            <input type="number" min="1" name="clasificados_por_grupo" id="clasifican_por_grupo" class="form-control" value="{{ old('clasificados_por_grupo') }}">
                        </div>
                    </div>

                    <p class="text-muted" id="info_grupos"></p>
                </div>

                {{-- Configuración Liguilla --}}
                <div id="config_liguilla" class="mt-3 border rounded p-3 {{ old('tipo') == 'Liguilla' ? '' : 'd-none' }}">
                    <h5 class="text-primary"><i class="fas fa-sync-alt"></i> Configuración Liguilla</h5>

                    <label class="form-label">¿Ida y Vuelta?</label>
                    <select name="partidos_por_enfrentamiento" class="form-control">
                        <option value="1" {{ old('partidos_por_enfrentamiento') == '1' ? 'selected' : '' }}>Solo Ida</option>
                        <option value="2" {{ old('partidos_por_enfrentamiento') == '2' ? 'selected' : '' }}>Ida y Vuelta</option>
                    </select>
                </div>

                {{-- Configuración Eliminación --}}
                <div id="config_eliminacion" class="mt-3 border rounded p-3 {{ old('tipo') == 'Eliminacion' ? '' : 'd-none' }}">
                    <h5 class="text-primary"><i class="fas fa-times-circle"></i> Eliminación Directa</h5>
                    <p class="text-muted">Las llaves se generarán automáticamente según el número de equipos.</p>
                </div>

                <button class="btn btn-success w-100 mt-3">
                    <i class="fas fa-check"></i> Guardar Torneo
                </button>

            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Seleccione equipos",
        width: '100%'
    });

    mostrarConfig();
    actualizarGrupos();
});

// Mostrar/Ocultar configuración según tipo
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

// Calcular número de equipos y equipos por grupo
function actualizarGrupos() {
    let selectedEquipos = $('select[name="equipos[]"]').val() || [];
    let numEquipos = selectedEquipos.length;

    // Actualiza el campo Número de Equipos automáticamente
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

// Detectar cambios
$('select[name="equipos[]"]').on('change', actualizarGrupos);
$('#num_grupos').on('keyup change', actualizarGrupos);
$('#tipo_torneo').on('change', mostrarConfig);

</script>
@endsection
