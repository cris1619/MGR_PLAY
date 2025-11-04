@extends('layouts.app')

@section('title', 'Crear Torneo')

@section('content')
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
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                {{-- Tipo de torneo --}}
                <div class="mb-3">
                    <label class="form-label">Tipo de Torneo</label>
                    <select name="tipo_torneo" id="tipo_torneo" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <option value="grupos">Fase de Grupos</option>
                        <option value="eliminacion">Eliminación Directa</option>
                        <option value="liguilla">Liguilla (todos contra todos)</option>
                    </select>
                </div>

                {{-- Fechas --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="form-control">
                    </div>
                </div>

                {{-- Equipos --}}
                <div class="mb-3">
                    <label class="form-label">Equipos Participantes</label>
                    <select name="equipos[]" class="form-control select2" multiple required>
                        @foreach ($equipos as $eq)
                            <option value="{{ $eq->id }}">{{ $eq->nombre }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Seleccione los equipos que jugarán este torneo</small>
                </div>

                {{-- ✅ Config Fase de Grupos --}}
                <div id="config_grupos" class="mt-3 d-none">
                    <h5 class="text-primary"><i class="fas fa-layer-group"></i> Configuración de Grupos</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de Grupos</label>
                            <input type="number" min="1" name="num_grupos" id="num_grupos" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Equipos por Grupo</label>
                            <input type="number" min="1" id="equipos_por_grupo" class="form-control" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Clasifican por Grupo</label>
                            <input type="number" min="1" name="clasifican_por_grupo" id="clasifican_por_grupo" class="form-control">
                        </div>
                    </div>

                    <p class="text-muted" id="info_grupos"></p>
                </div>

                {{-- ✅ Config Liguilla --}}
                <div id="config_liguilla" class="mt-3 d-none">
                    <h5 class="text-primary"><i class="fas fa-sync-alt"></i> Configuración Liguilla</h5>

                    <label class="form-label">¿Ida y vuelta?</label>
                    <select name="ida_vuelta" class="form-control">
                        <option value="0">No, solo ida</option>
                        <option value="1">Sí, ida y vuelta</option>
                    </select>
                </div>

                {{-- ✅ Config Eliminación directa --}}
                <div id="config_eliminacion" class="mt-3 d-none">
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
<script>
function actualizarGrupos() {
    let equiposSeleccionados = document.querySelectorAll('select[name="equipos[]"] option:checked').length;
    let numGrupos = document.getElementById('num_grupos').value;

    if (numGrupos > 0 && equiposSeleccionados > 0) {
        let porGrupo = Math.floor(equiposSeleccionados / numGrupos);
        let sobrantes = equiposSeleccionados % numGrupos;

        document.getElementById('equipos_por_grupo').value = porGrupo;

        document.getElementById('info_grupos').innerText =
            `Con ${equiposSeleccionados} equipos: ${numGrupos} grupos de ${porGrupo} equipos`
            + (sobrantes > 0 ? ` y ${sobrantes} grupo(s) con un equipo adicional` : ``);
    }
}

function mostrarConfig() {
    let tipo = document.getElementById('tipo_torneo').value;

    document.getElementById('config_grupos').classList.add('d-none');
    document.getElementById('config_liguilla').classList.add('d-none');
    document.getElementById('config_eliminacion').classList.add('d-none');

    if (tipo === 'grupos') {
        document.getElementById('config_grupos').classList.remove('d-none');
        actualizarGrupos();
    } else if (tipo === 'liguilla') {
        document.getElementById('config_liguilla').classList.remove('d-none');
    } else if (tipo === 'eliminacion') {
        document.getElementById('config_eliminacion').classList.remove('d-none');
    }
}

// ✅ Detectar cambios
document.querySelector('select[name="equipos[]"]').addEventListener('change', actualizarGrupos);
document.getElementById('num_grupos').addEventListener('input', actualizarGrupos);
document.getElementById('tipo_torneo').addEventListener('change', mostrarConfig);
window.addEventListener('load', mostrarConfig);
</script>
@endsection
