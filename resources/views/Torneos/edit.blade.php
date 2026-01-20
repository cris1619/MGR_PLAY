@extends('layouts.app')

@section('title', 'Editar Torneo | MGR PLAY')

@section('content')
<div class="container my-5">

    {{-- ENCABEZADO --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold text-white">
            <i class="fas fa-edit text-success"></i> Editar Torneo
        </h2>
        <p class="text-light opacity-75">Modifica la información del torneo según corresponda</p>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card border-0 shadow-lg rounded-4 bg-dark text-light animate__animated animate__fadeInUp">
        <div class="card-body p-4">

            <form action="{{ route('torneos.update', $torneos->id) }}" method="POST">
                @csrf
               

                {{-- Nombre --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-warning">🏆 Nombre del Torneo</label>
                    <input type="text" name="nombre" class="form-control bg-dark text-light border-secondary rounded-3"
                           value="{{ old('nombre', $torneos->nombre) }}" required>
                </div>

                {{-- Municipio --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-warning">🌍 Municipio</label>
                    <select name="idMunicipio" class="form-select bg-dark text-light border-secondary rounded-3">
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
                    <label class="form-label fw-semibold text-warning">📝 Descripción</label>
                    <textarea name="descripcion" rows="3"
                              class="form-control bg-dark text-light border-secondary rounded-3">{{ old('descripcion', $torneos->descripcion) }}</textarea>
                </div>

                {{-- Premio --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-warning">💰 Premio</label>
                    <input type="text" name="premio" class="form-control bg-dark text-light border-secondary rounded-3"
                           value="{{ old('premio', $torneos->premio) }}">
                </div>

                {{-- Estado --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-warning">📊 Estado del Torneo</label>
                    <select name="estado" class="form-select bg-dark text-light border-secondary rounded-3" required>
                        <option value="Pendiente" {{ old('estado', $torneos->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En curso" {{ old('estado', $torneos->estado) == 'En curso' ? 'selected' : '' }}>En curso</option>
                        <option value="Finalizado" {{ old('estado', $torneos->estado) == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                </div>

                {{-- Tipo --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-warning">⚙️ Tipo de Torneo</label>
                    <select name="tipo" id="tipo_torneo" class="form-select bg-dark text-light border-secondary rounded-3" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Grupos" {{ old('tipo', $torneos->tipo) == 'Grupos' ? 'selected' : '' }}>Fase de Grupos</option>
                        <option value="Eliminacion" {{ old('tipo', $torneos->tipo) == 'Eliminacion' ? 'selected' : '' }}>Eliminación Directa</option>
                        <option value="Liguilla" {{ old('tipo', $torneos->tipo) == 'Liguilla' ? 'selected' : '' }}>Liguilla (Todos contra todos)</option>
                    </select>
                </div>

                {{-- Fechas --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-warning">📅 Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control bg-dark text-light border-secondary rounded-3"
                               value="{{ old('fecha_inicio', $torneos->fecha_inicio) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-warning">📅 Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control bg-dark text-light border-secondary rounded-3"
                               value="{{ old('fecha_fin', $torneos->fecha_fin) }}">
                    </div>
                </div>

                {{-- Equipos --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-warning">👥 Equipos Participantes</label>
                    <select name="equipos[]" class="selectpicker w-100" data-style="btn-dark" multiple data-live-search="true" required>
                        @foreach ($equipos as $eq)
                            <option value="{{ $eq->id }}" {{ $torneos->equipos->contains($eq->id) ? 'selected' : '' }}>
                                {{ $eq->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-secondary">Seleccione los equipos participantes</small>
                </div>

                {{-- Número de equipos --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-warning">🔢 Número de Equipos</label>
                    <input type="number" name="num_equipos" id="num_equipos_form"
                           class="form-control bg-dark text-light border-secondary rounded-3"
                           value="{{ $torneos->num_equipos }}" readonly>
                </div>

                {{-- Configuración de grupos --}}
                <div id="config_grupos" class="mt-4 bg-black bg-opacity-25 p-3 rounded-4 border border-success d-none">
                    <h5 class="text-success"><i class="fas fa-layer-group"></i> Configuración de Grupos</h5>
                    <div class="row mt-2">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de Grupos</label>
                            <input type="number" min="1" name="cantidad_grupos" id="num_grupos"
                                   class="form-control bg-dark text-light border-secondary rounded-3"
                                   value="{{ $torneos->cantidad_grupos }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Equipos por Grupo</label>
                            <input type="number" id="equipos_por_grupo" name="equipos_por_grupo"
                                   class="form-control bg-dark text-light border-secondary rounded-3"
                                   readonly value="{{ $torneos->equipos_por_grupo }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Clasifican por Grupo</label>
                            <input type="number" min="1" name="clasificados_por_grupo" id="clasifican_por_grupo"
                                   class="form-control bg-dark text-light border-secondary rounded-3"
                                   value="{{ $torneos->clasificados_por_grupo }}">
                        </div>
                    </div>
                </div>

                {{-- Liguilla --}}
                <div id="config_liguilla" class="mt-4 bg-black bg-opacity-25 p-3 rounded-4 border border-warning d-none">
                    <h5 class="text-warning"><i class="fas fa-sync-alt"></i> Configuración Liguilla</h5>
                    <label class="form-label">¿Ida y Vuelta?</label>
                    <select name="partidos_por_enfrentamiento" class="form-select bg-dark text-light border-secondary rounded-3">
                        <option value="1" {{ $torneos->partidos_por_enfrentamiento == 1 ? 'selected' : '' }}>Solo Ida</option>
                        <option value="2" {{ $torneos->partidos_por_enfrentamiento == 2 ? 'selected' : '' }}>Ida y Vuelta</option>
                    </select>
                </div>

                {{-- Eliminación --}}
                <div id="config_eliminacion" class="mt-4 bg-black bg-opacity-25 p-3 rounded-4 border border-danger d-none">
                    <h5 class="text-danger"><i class="fas fa-times-circle"></i> Eliminación Directa</h5>
                    <p class="text-secondary">Las llaves se generarán automáticamente según el número de equipos.</p>
                </div>

                {{-- Botones --}}
                <div class="mt-5 d-flex flex-column flex-md-row gap-3">
                    <button class="btn btn-actualizar flex-fill">
                        <i class="fas fa-check me-2"></i> Actualizar Torneo
                    </button>

                    <a href="{{ route('torneos.index') }}" class="btn btn-volver flex-fill">
                        <i class="fas fa-arrow-left me-2"></i> Volver
                    </a>
                </div>

            </form>
            
        </div>
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

function mostrarConfig() {
    let tipo = $('#tipo_torneo').val();
    $('#config_grupos, #config_liguilla, #config_eliminacion').addClass('d-none');
    if (tipo === 'Grupos') $('#config_grupos').removeClass('d-none');
    else if (tipo === 'Liguilla') $('#config_liguilla').removeClass('d-none');
    else if (tipo === 'Eliminacion') $('#config_eliminacion').removeClass('d-none');
    actualizarGrupos();
}

function actualizarGrupos() {
    let selectedEquipos = $('select[name="equipos[]"]').val() || [];
    let numEquipos = selectedEquipos.length;
    $('#num_equipos_form').val(numEquipos);
    let numGrupos = parseInt($('#num_grupos').val()) || 0;
    if (numGrupos > 0 && numEquipos > 0) {
        let porGrupo = Math.floor(numEquipos / numGrupos);
        $('#equipos_por_grupo').val(porGrupo);
    } else {
        $('#equipos_por_grupo').val('');
    }
}
</script>

<style>
/* --- BOTÓN ACTUALIZAR --- */
.btn-actualizar {
    background: linear-gradient(135deg, #16A34A, #22C55E);
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    transition: all 0.35s ease;
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
}
.btn-actualizar:hover {
    background: linear-gradient(135deg, #22C55E, #16A34A);
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 22px rgba(22, 163, 74, 0.6);
}

/* --- BOTÓN VOLVER --- */
.btn-volver {
    background: linear-gradient(135deg, #1E293B, #334155);
    color: #fff;
    font-weight: 600;
    border: 2px solid #22C55E;
    border-radius: 12px;
    padding: 12px 20px;
    transition: all 0.35s ease;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.25);
}
.btn-volver:hover {
    background: linear-gradient(135deg, #22C55E, #16A34A);
    color: #fff;
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 22px rgba(22, 163, 74, 0.6);
}
</style>
@endsection
