@extends('layouts.app')

@section('title', 'Crear Torneo | MGR PLAY')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white rounded-top-4">
            <h4 class="mb-0">
                <i class="fas fa-trophy me-2 text-warning"></i> Crear Torneo
            </h4>
            <a href="{{ route('torneos.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <form action="{{ route('torneos.store') }}" method="POST" class="p-3">
            @csrf
            <div class="card-body">

                {{-- Nombre --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">🏆 Nombre del Torneo</label>
                    <input type="text" name="nombre" class="form-control border-dark-subtle shadow-sm" value="{{ old('nombre') }}" placeholder="Ej: Copa Málaga 2025" required>
                </div>

                {{-- Municipio --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">🌍 Municipio</label>
                    <select name="idMunicipio" class="form-select border-dark-subtle shadow-sm">
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
                    <label class="form-label fw-semibold">📝 Descripción</label>
                    <textarea name="descripcion" class="form-control border-dark-subtle shadow-sm" rows="3" placeholder="Breve descripción del torneo...">{{ old('descripcion') }}</textarea>
                </div>

                {{-- Premio --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">💰 Premio</label>
                    <input type="text" name="premio" class="form-control border-dark-subtle shadow-sm" value="{{ old('premio') }}" placeholder="Ej: Trofeo y medallas">
                </div>

                {{-- Estado --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">📅 Estado del Torneo</label>
                    <select name="estado" class="form-select border-dark-subtle shadow-sm" required>
                        <option value="Pendiente" selected>Pendiente</option>
                        <option value="En curso" {{ old('estado') == 'En curso' ? 'selected' : '' }}>En curso</option>
                        <option value="Finalizado" {{ old('estado') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                </div>

                {{-- Tipo --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">⚙️ Tipo de Torneo</label>
                    <select name="tipo" id="tipo_torneo" class="form-select border-dark-subtle shadow-sm" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Grupos" {{ old('tipo') == 'Grupos' ? 'selected' : '' }}>Fase de Grupos</option>
                        <option value="Eliminacion" {{ old('tipo') == 'Eliminacion' ? 'selected' : '' }}>Eliminación Directa</option>
                        <option value="Liguilla" {{ old('tipo') == 'Liguilla' ? 'selected' : '' }}>Liguilla (todos contra todos)</option>
                    </select>
                </div>

                {{-- Fechas --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">📆 Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control border-dark-subtle shadow-sm" value="{{ old('fecha_inicio') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">📅 Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="form-control border-dark-subtle shadow-sm" value="{{ old('fecha_fin') }}">
                    </div>
                </div>

                {{-- Equipos --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">👥 Equipos Participantes</label>
                    <select name="equipos[]" class="selectpicker w-100" data-style="btn-dark" multiple data-live-search="true" required>
                        @foreach ($equipos as $eq)
                            <option value="{{ $eq->id }}" {{ collect(old('equipos'))->contains($eq->id) ? 'selected' : '' }}>
                                {{ $eq->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Seleccione los equipos que participarán.</small>
                </div>

                {{-- Número de equipos --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">🔢 Número de Equipos</label>
                    <input type="number" min="1" name="num_equipos" id="num_equipos_form" class="form-control border-dark-subtle shadow-sm" value="{{ old('num_equipos') }}" readonly>
                </div>

                {{-- Botón crear equipo --}}
                <button type="button" class="btn btn-outline-success btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#modalCrearEquipo">
                    <i class="fas fa-plus"></i> Crear nuevo equipo
                </button>

                {{-- Config Grupos --}}
                <div id="config_grupos" class="mt-4 p-3 border rounded-3 bg-light d-none">
                    <h5 class="text-primary"><i class="fas fa-layer-group me-1"></i> Configuración de Grupos</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">N° de Grupos</label>
                            <input type="number" min="1" name="cantidad_grupos" id="num_grupos" class="form-control shadow-sm border-dark-subtle">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Equipos por Grupo</label>
                            <input type="number" id="equipos_por_grupo" name="equipos_por_grupo" class="form-control shadow-sm border-dark-subtle" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Clasifican por Grupo</label>
                            <input type="number" min="1" name="clasificados_por_grupo" id="clasifican_por_grupo" class="form-control shadow-sm border-dark-subtle">
                        </div>
                    </div>
                    <p class="text-muted" id="info_grupos"></p>
                </div>

                {{-- Config Liguilla --}}
                <div id="config_liguilla" class="mt-4 p-3 border rounded-3 bg-light d-none">
                    <h5 class="text-primary"><i class="fas fa-sync-alt me-1"></i> Configuración Liguilla</h5>
                    <label class="form-label fw-semibold">¿Ida y Vuelta?</label>
                    <select name="partidos_por_enfrentamiento" class="form-select shadow-sm border-dark-subtle">
                        <option value="1">Solo Ida</option>
                        <option value="2">Ida y Vuelta</option>
                    </select>
                </div>

                {{-- Config Eliminación --}}
                <div id="config_eliminacion" class="mt-4 p-3 border rounded-3 bg-light d-none">
                    <h5 class="text-primary"><i class="fas fa-times-circle me-1"></i> Eliminación Directa</h5>
                    <p class="text-muted">Las llaves se generarán automáticamente según el número de equipos seleccionados.</p>
                </div>

                <button class="btn btn-success w-100 mt-4 shadow-sm">
                    <i class="fas fa-check-circle"></i> Guardar Torneo
                </button>

            </div>
        </form>
    </div>
</div>

{{-- Modal Crear Equipo --}}
<div class="modal fade" id="modalCrearEquipo" tabindex="-1" aria-labelledby="modalCrearEquipoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <form id="formCrearEquipo" enctype="multipart/form-data">
          @csrf
          <div class="modal-header bg-dark text-white rounded-top-4">
            <h5 class="modal-title"><i class="fas fa-futbol me-2"></i> Crear Nuevo Equipo</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre del Equipo</label>
                <input type="text" name="nombre" class="form-control border-dark-subtle shadow-sm" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Escudo del Equipo</label>
                <input type="file" name="escudo" class="form-control border-dark-subtle shadow-sm" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Entrenador</label>
                <input type="text" name="entrenador" class="form-control border-dark-subtle shadow-sm" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Municipio</label>
                <select name="idMunicipio" class="form-select border-dark-subtle shadow-sm" required>
                    <option value="">Seleccione un municipio</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Estado</label>
                <select name="estado" class="form-select border-dark-subtle shadow-sm" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">💾 Guardar Equipo</button>
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

    // AJAX crear equipo
    $('#formCrearEquipo').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('equipos.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#modalCrearEquipo').modal('hide');
                $('#formCrearEquipo')[0].reset();

                let newOption = new Option(response.nombre, response.id, true, true);
                $('select[name="equipos[]"]').append(newOption).trigger('change');
                $('.selectpicker').selectpicker('refresh');

                Swal.fire({
                    icon: 'success',
                    title: '¡Equipo creado!',
                    text: `${response.nombre} se ha agregado correctamente.`,
                    timer: 2000,
                    showConfirmButton: false
                });

                actualizarGrupos();
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo crear el equipo. Verifique los datos ingresados.'
                });
            }
        });
    });
});

function mostrarConfig() {
    let tipo = $('#tipo_torneo').val();
    $('#config_grupos, #config_liguilla, #config_eliminacion').addClass('d-none');

    if (tipo === 'Grupos') $('#config_grupos').removeClass('d-none');
    if (tipo === 'Liguilla') $('#config_liguilla').removeClass('d-none');
    if (tipo === 'Eliminacion') $('#config_eliminacion').removeClass('d-none');
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
        $('#info_grupos').text(`Con ${numEquipos} equipos: ${numGrupos} grupos de ${porGrupo}` + (sobrantes ? ` y ${sobrantes} grupo(s) con 1 extra` : ''));
    } else {
        $('#equipos_por_grupo').val('');
        $('#info_grupos').text('');
    }
}
</script>
@endsection
