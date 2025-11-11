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
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                {{-- Municipio --}}
                <div class="mb-3">
                    <label class="form-label">Municipio</label>
                    <select name="idMunicipio" class="form-control">
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
                
                {{-- Estado --}}
                <div class="mb-3">
                    <label class="form-label">Estado del Torneo</label>
                    <select name="estado" class="form-control" required>
                        <option value="Pendiente" selected>Pendiente</option>
                        <option value="En curso" {{ old('estado') == 'En curso' ? 'selected' : '' }}>En curso</option>
                        <option value="Finalizado" {{ old('estado') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                    </select>
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
                    <select name="equipos[]" 
                            class="selectpicker w-100" 
                            data-style="btn-dark"
                            multiple 
                            data-live-search="true" 
                            required>
                        @foreach ($equipos as $eq)
                            <option value="{{ $eq->id }}" {{ collect(old('equipos'))->contains($eq->id) ? 'selected' : '' }}>
                                {{ $eq->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <small class="text-muted">Seleccione los equipos participantes</small>
                </div>

                {{-- Botón Modal Crear Equipo --}}
                <button type="button" class="btn btn-sm btn-outline-success mt-2" data-bs-toggle="modal" data-bs-target="#modalCrearEquipo">
                    <i class="fas fa-plus"></i> Crear nuevo equipo
                </button>

                {{-- Configuración Grupos --}}
                <div id="config_grupos" class="mt-3 border rounded p-3 d-none">
                    <h5 class="text-primary"><i class="fas fa-layer-group"></i> Configuración de Grupos</h5>

                    <div id="grupos_manual" class="mt-3">
                        <h6>Distribución manual de grupos</h6>
                        <div id="contenedor_grupos"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Número de Grupos</label>
                            <input type="number" min="1" name="cantidad_grupos" id="num_grupos" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Equipos por Grupo</label>
                            <input type="number" id="equipos_por_grupo" name="equipos_por_grupo" class="form-control" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Clasifican por Grupo</label>
                            <input type="number" min="1" name="clasificados_por_grupo" id="clasifican_por_grupo" class="form-control">
                        </div>
                    </div>

                    <p class="text-muted" id="info_grupos"></p>
                </div>

                {{-- Configuración Liguilla --}}
                <div id="config_liguilla" class="mt-3 border rounded p-3 d-none">
                    <h5 class="text-primary"><i class="fas fa-sync-alt"></i> Configuración Liguilla</h5>
                    <label class="form-label">¿Ida y Vuelta?</label>
                    <select name="partidos_por_enfrentamiento" class="form-control">
                        <option value="1">Solo Ida</option>
                        <option value="2">Ida y Vuelta</option>
                    </select>
                </div>

                {{-- Configuración Eliminación --}}
                <div id="config_eliminacion" class="mt-3 border rounded p-3 d-none">
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

{{-- Modal Crear Equipo --}}
<div class="modal fade" id="modalCrearEquipo" tabindex="-1" aria-labelledby="modalCrearEquipoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formCrearEquipo" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalCrearEquipoLabel">Crear Nuevo Equipo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Nombre del equipo</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre del equipo" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Escudo del equipo</label>
                <input type="file" name="escudo" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Entrenador</label>
                <input type="text" name="entrenador" class="form-control" placeholder="Ingrese nombre del entrenador" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Municipio</label>
                <select name="idMunicipio" class="form-select" required>
                    <option value="">Seleccione un municipio</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
    // Inicializar bootstrap select
    $('.selectpicker').selectpicker();

    // Mostrar configuración según tipo de torneo
    $('#tipo_torneo').on('change', mostrarConfig);

    // Ejecutar una vez al cargar (por si hay old() o validación)
    mostrarConfig();


    // Autocalcular equipos y grupos
    actualizarGrupos();
    $('select[name="equipos[]"]').on('changed.bs.select', actualizarGrupos);
    $('#num_grupos').on('keyup change', actualizarGrupos);


    // Guardar equipo con AJAX
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

                // Cerrar modal
                $('#modalCrearEquipo').modal('hide');

                // Limpiar formulario
                $('#formCrearEquipo')[0].reset();

                // Agregar al select
                let newOption = new Option(response.nombre, response.id, true, true);
                $('select[name="equipos[]"]').append(newOption).trigger('change');
                $('.selectpicker').selectpicker('refresh');

                Swal.fire({
                    icon: 'success',
                    title: '¡Equipo creado!',
                    text: response.nombre + ' se ha agregado correctamente.',
                    timer: 2000,
                    showConfirmButton: false
                });

                actualizarGrupos();
                mostrarConfig();  // <<< ✅ Aquí sí se puede llamar también
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorText = '';
                $.each(errors, function(key, value) {
                    errorText += value + '\n';
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorText
                });
            }
        });
    });
});


function actualizarGrupos() {
    let equiposSeleccionados = $('select[name="equipos[]"]').val()?.length || 0;

    $('#num_equipos_form').val(equiposSeleccionados);

    let grupos = $('#num_grupos').val();

    if (grupos > 0 && equiposSeleccionados > 0) {

        let equiposPorGrupo = Math.floor(equiposSeleccionados / grupos);
        $('#equipos_por_grupo').val(equiposPorGrupo);

        if (equiposSeleccionados % grupos !== 0) {
            $('#info_grupos').html(
                `<span class="text-danger">⚠ Algunos grupos tendrán un equipo más que otros</span>`
            );
        } else {
            $('#info_grupos').html(
                `<span class="text-success">✔ Reparto equitativo entre grupos</span>`
            );
        }
    } else {
        $('#equipos_por_grupo').val('');
        $('#info_grupos').html('');
    }
}


function mostrarConfig() {
    let tipo = $('#tipo_torneo').val();

    $('#config_grupos').addClass('d-none');
    $('#config_liguilla').addClass('d-none');
    $('#config_eliminacion').addClass('d-none');

    if (tipo === 'Grupos') {
        $('#config_grupos').removeClass('d-none');
    } 
    else if (tipo === 'Liguilla') {
        $('#config_liguilla').removeClass('d-none');
    }
    else if (tipo === 'Eliminacion') {
        $('#config_eliminacion').removeClass('d-none');
    }
}



</script>
@endsection
