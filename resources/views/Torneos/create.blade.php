@extends('layouts.app')

@section('title')
 Crear Torneo | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('torneos.index') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🏆 CREAR TORNEO
        </a>
    </div>
</nav>
@endsection

@section('content')
<style>
    /* ==== NAVBAR ==== */
    .navbar {
        background-color: #1B1F23;
        padding: 0 20px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }
    .navbar-left { display: flex; align-items: center; gap: 40px; }
    .logo { display: flex; align-items: center; color: white; font-size: 18px; font-weight: bold; text-decoration: none; transition: transform 0.3s ease; }
    .logo:hover { transform: scale(1.05); color: white; }
    .logo img { height: 50px; margin-right: 30px; }

    /* ==== ANIMACIONES ==== */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes glowIn { 0% { box-shadow: 0 0 0 rgba(255,215,0,0); } 100% { box-shadow: 0 0 20px rgba(255,215,0,0.4); } }

    /* ==== TARJETA DEL FORMULARIO ==== */
    .edit-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 36px;
        max-width: 1400px;
        margin: 72px auto;
        color: #fff;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards, glowIn 1.5s ease 0.3s forwards;
    }

    .edit-card h2 {
        color: #ffd700;
        font-weight: 700;
        margin-bottom: 24px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: fadeInUp 0.8s ease 0.2s forwards;
    }

    /* ==== SECCIONES ==== */
    .section-title {
        color: #ffd700;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #444;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .section-divider {
        margin: 30px 0;
        border-bottom: 1px solid #444;
    }

    /* ==== CAMPOS ==== */
    .form-label {
        color: #ffd700 !important;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    input.form-control,
    select.form-select,
    textarea.form-control {
        background-color: #2a2e33;
        border: 1px solid #444;
        color: white;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 1rem;
        transition: all 0.28s ease;
        width: 100%;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    input.form-control:focus,
    select.form-select:focus,
    textarea.form-control:focus {
        border-color: #ffd700;
        box-shadow: 0 0 10px rgba(255,215,0,0.35);
        background-color: #2f3339;
        transform: translateY(-1px);
        outline: none;
    }

    select.form-select option {
        background-color: #1B1F23;
        color: #fff;
    }

    input::placeholder,
    select.form-select::placeholder,
    textarea::placeholder {
        color: #999;
        opacity: 0.6;
    }

    /* Selectpicker custom */
    .bootstrap-select .dropdown-toggle {
        background-color: #2a2e33 !important;
        border: 1px solid #444 !important;
        color: white !important;
        border-radius: 10px !important;
        padding: 12px 14px !important;
    }

    .bootstrap-select .dropdown-toggle:focus {
        border-color: #ffd700 !important;
        box-shadow: 0 0 10px rgba(255,215,0,0.35) !important;
    }

    .bootstrap-select .dropdown-menu {
        background-color: #2a2e33 !important;
        border: 1px solid #444 !important;
    }

    .bootstrap-select .dropdown-menu li a {
        color: white !important;
    }

    .bootstrap-select .dropdown-menu li a:hover {
        background-color: #ffd700 !important;
        color: #1B1F23 !important;
    }

    /* ==== ALERT CUSTOM ==== */
    .alert-info-custom {
        background: linear-gradient(135deg, #2a2e33 0%, #1B1F23 100%);
        border: 1px solid #ffd700;
        border-radius: 10px;
        padding: 12px;
        color: #ffd700;
        font-size: 0.9rem;
    }

    .alert-success-custom {
        background: linear-gradient(135deg, #2a2e33 0%, #1B1F23 100%);
        border: 1px solid #00ff88;
        border-radius: 10px;
        padding: 12px;
        color: #00ff88;
        font-size: 0.9rem;
    }

    .alert-danger {
        background: linear-gradient(135deg, #2a2e33 0%, #1B1F23 100%);
        border: 1px solid #ff6b6b;
        border-radius: 10px;
        padding: 12px;
        color: #ff6b6b;
        font-size: 0.9rem;
    }

    /* ==== CONFIGURACIONES ESPECÍFICAS ==== */
    .config-box {
        background: linear-gradient(145deg, #252a2f 0%, #1B1F23 100%);
        border: 2px solid #444;
        border-radius: 15px;
        padding: 24px;
        margin-top: 20px;
    }

    .config-box h5 {
        color: #ffd700;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ==== BOTONES ==== */
    .form-actions { 
        display: flex; 
        gap: 12px; 
        justify-content: center; 
        margin-top: 30px; 
        flex-wrap: wrap; 
    }

    .btn-guardar,
    .btn-cancelar,
    .btn-crear-equipo {
        border: none;
        padding: 14px 32px;
        border-radius: 25px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.28s ease;
        transform-origin: center;
        color: #1B1F23;
        cursor: pointer;
    }

    .btn-guardar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }
    .btn-guardar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        box-shadow: 0 6px 14px rgba(255,215,0,0.55);
        color: #1B1F23;
    }

    .btn-cancelar {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        box-shadow: 0 4px 8px rgba(0, 255, 136, 0.35);
    }
    .btn-cancelar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        box-shadow: 0 6px 14px rgba(0,255,136,0.55);
        color: #1B1F23;
    }

    .btn-crear-equipo {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        box-shadow: 0 4px 8px rgba(0, 255, 136, 0.35);
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    .btn-crear-equipo:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        box-shadow: 0 6px 14px rgba(0,255,136,0.55);
        color: #1B1F23;
    }

    /* ==== MODAL CUSTOM ==== */
    .modal-content {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        color: #fff;
    }

    .modal-header {
        background-color: #1B1F23;
        border-bottom: 2px solid #444;
        border-radius: 20px 20px 0 0;
    }

    .modal-title {
        color: #ffd700;
        font-weight: 700;
    }

    .modal-footer {
        border-top: 2px solid #444;
        background-color: #1B1F23;
    }

    .btn-close-white {
        filter: brightness(0) invert(1);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .col-5col { flex: 0 0 50%; max-width: 50%; }
    }

    @media (max-width: 768px) {
        .col-5col { flex: 0 0 100%; max-width: 100%; }
        .edit-card { padding: 20px; margin: 36px 12px; }
        .form-actions { flex-direction: column; }
        .btn-guardar, .btn-cancelar { width: 100%; text-align: center; }
    }

    /* Custom 5 columns */
    .col-5col {
        flex: 0 0 20%;
        max-width: 20%;
        padding: 0 12px;
    }

    .row-5cols {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -12px;
    }
</style>

<div class="edit-card">
    <h2>🏆 Crear Torneo</h2>

    <form action="{{ route('torneos.store') }}" method="POST">
        @csrf

        {{-- SECCIÓN 1: INFORMACIÓN BÁSICA --}}
        <div class="section-title">
            <i class="fas fa-info-circle me-2"></i>Información Básica
        </div>

        <div class="row-5cols mb-3">
            <div class="col-5col mb-3">
                <label for="nombre" class="form-label">🏆 Nombre del Torneo</label>
                <input type="text" name="nombre" id="nombre" class="form-control" 
                       placeholder="Ej: Copa Málaga 2025" value="{{ old('nombre') }}" required>
            </div>

            <div class="col-5col mb-3">
                <label for="idMunicipio" class="form-label">🌍 Municipio</label>
                <select name="idMunicipio" id="idMunicipio" class="form-select">
                    <option value="">Seleccione un municipio</option>
                    @foreach ($municipios as $mun)
                        <option value="{{ $mun->id }}" {{ old('idMunicipio') == $mun->id ? 'selected' : '' }}>
                            {{ $mun->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-5col mb-3">
                <label for="premio" class="form-label">💰 Premio</label>
                <input type="text" name="premio" id="premio" class="form-control" 
                       placeholder="Ej: Trofeo y medallas" value="{{ old('premio') }}">
            </div>

            <div class="col-5col mb-3">
                <label for="estado" class="form-label">📅 Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="Pendiente" selected>Pendiente</option>
                    <option value="En curso" {{ old('estado') == 'En curso' ? 'selected' : '' }}>En curso</option>
                </select>
            </div>

            <div class="col-5col mb-3">
                <label for="tipo_torneo" class="form-label">⚙️ Tipo de Torneo</label>
                <select name="tipo" id="tipo_torneo" class="form-select" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Eliminacion" {{ old('tipo') == 'Eliminacion' ? 'selected' : '' }}>Eliminación Directa</option>
                    <option value="Liguilla" {{ old('tipo') == 'Liguilla' ? 'selected' : '' }}>Liguilla</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="descripcion" class="form-label">📝 Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" 
                          placeholder="Breve descripción del torneo...">{{ old('descripcion') }}</textarea>
            </div>
        </div>

        <div class="section-divider"></div>

        {{-- SECCIÓN 2: FECHAS Y EQUIPOS --}}
        <div class="section-title">
            <i class="fas fa-calendar-alt me-2"></i>Fechas
        </div>

        <div class="row-5cols mb-3">
            <div class="col-5col mb-3">
                <label for="fecha_inicio" class="form-label">📆 Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
            </div>

            <div class="col-5col mb-3">
                <label for="fecha_fin" class="form-label">📅 Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
            </div>

            <div class="col-5col mb-3 d-flex align-items-end">
                <button type="button" class="btn-crear-equipo w-100" data-bs-toggle="modal" data-bs-target="#modalCrearEquipo">
                    <i class="fas fa-plus"></i> Crear Nuevo Equipo
                </button>
            </div>
        </div>

        <div class="section-divider"></div>

        {{-- SECCIÓN 3: EQUIPOS PARTICIPANTES --}}
        <div class="section-title">
            <i class="fas fa-users me-2"></i>Equipos Participantes
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="equipos" class="form-label">👥 Selecciona los Equipos</label>
                <select name="equipos[]" id="equipos" class="selectpicker w-100" data-style="btn-dark" 
                        multiple data-live-search="true" required>
                    @foreach ($equipos as $eq)
                        <option value="{{ $eq->id }}" {{ collect(old('equipos'))->contains($eq->id) ? 'selected' : '' }}>
                            {{ $eq->nombre }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Seleccione los equipos que participarán en el torneo.</small>
            </div>
        </div>

        {{-- CONFIGURACIONES ESPECÍFICAS --}}
        {{-- Config Grupos --}}
        <div id="config_grupos" class="config-box d-none">
            <h5><i class="fas fa-layer-group me-2"></i>Configuración de Grupos</h5>
            <div class="row-5cols">
                <div class="col-5col mb-3">
                    <label for="num_grupos" class="form-label">N° de Grupos</label>
                    <input type="number" min="1" name="cantidad_grupos" id="num_grupos" class="form-control">
                </div>
                <div class="col-5col mb-3">
                    <label for="equipos_por_grupo" class="form-label">Equipos por Grupo</label>
                    <input type="number" id="equipos_por_grupo" name="equipos_por_grupo" class="form-control" readonly>
                </div>
                <div class="col-5col mb-3">
                    <label for="clasifican_por_grupo" class="form-label">Clasifican por Grupo</label>
                    <input type="number" min="1" name="clasificados_por_grupo" id="clasifican_por_grupo" class="form-control">
                </div>
                <div class="col-5col mb-3 d-flex align-items-end">
                    <div class="alert-info-custom w-100">
                        <i class="fas fa-info-circle me-2"></i>
                        <span id="info_grupos"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Config Liguilla --}}
        <div id="config_liguilla" class="config-box d-none">
            <h5><i class="fas fa-sync-alt me-2"></i>Configuración Liguilla</h5>
            <div class="row-5cols">
                <div class="col-5col mb-3">
                    <label for="partidos_por_enfrentamiento" class="form-label">¿Ida y Vuelta?</label>
                    <select name="partidos_por_enfrentamiento" id="partidos_por_enfrentamiento" class="form-select">
                        <option value="1">Solo Ida</option>
                        <option value="2">Ida y Vuelta</option>
                    </select>
                </div>
                <div class="col-5col mb-3 d-flex align-items-end">
                    <div class="alert-success-custom w-100">
                        <i class="fas fa-check-circle me-2"></i>
                        Todos los equipos jugarán entre sí
                    </div>
                </div>
            </div>
        </div>

        {{-- Config Eliminación --}}
        <div id="config_eliminacion" class="config-box d-none">
            <h5><i class="fas fa-times-circle me-2"></i>Eliminación Directa</h5>
            <div id="alerta_equipos_impares" class="alert alert-danger d-none" style="display: none;">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>⚠️ EQUIPOS IMPARES NO PERMITIDOS</strong>
                <br>El torneo de <strong>Eliminación Directa</strong> solo maneja equipos <strong>PARES</strong>.
                <br><small>Ajusta la cantidad de equipos seleccionados para continuar.</small>
            </div>
            <div id="alerta_equipos_pares" class="alert-success-custom d-none">
                <i class="fas fa-check-circle me-2"></i>
                ✔️ Cantidad de equipos válida. Las llaves se generarán automáticamente.
            </div>
            <div id="alerta_sin_equipos" class="alert-info-custom d-none">
                <i class="fas fa-info-circle me-2"></i>
                Selecciona equipos para visualizar la validación.
            </div>
        </div>

        {{-- BOTONES DE ACCIÓN --}}
        <div class="form-actions">
            <button type="submit" id="btnGuardarTorneo" class="btn-guardar">
                <i class="fas fa-check-circle me-2"></i>Guardar Torneo
            </button>
            <a href="{{ route('torneos.index') }}" class="btn-cancelar">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
        </div>
    </form>
</div>

{{-- Modal Crear Equipo --}}
<div class="modal fade" id="modalCrearEquipo" tabindex="-1" aria-labelledby="modalCrearEquipoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formCrearEquipo" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-futbol me-2"></i>Crear Nuevo Equipo</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre del Equipo</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Entrenador</label>
                    <input type="text" name="entrenador" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Municipio</label>
                    <select name="idMunicipio" class="form-select" required>
                        <option value="">Seleccione un municipio</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Escudo del Equipo</label>
                <input type="file" name="escudo" class="form-control" accept="image/*" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn-guardar">
                <i class="fas fa-save me-2"></i>Guardar Equipo
            </button>
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

    // Validar formulario antes de enviar
    $('form').on('submit', function(e) {
        let tipo = $('#tipo_torneo').val();
        let selectedEquipos = $('select[name="equipos[]"]').val() || [];
        let numEquipos = selectedEquipos.length;

        // Si no hay tipo de torneo seleccionado
        if (!tipo) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Tipo de Torneo',
                text: 'Por favor selecciona un tipo de torneo.'
            });
            return false;
        }

        // Si no hay equipos seleccionados
        if (numEquipos === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Sin Equipos',
                text: 'Debes seleccionar al menos 2 equipos para crear un torneo.'
            });
            return false;
        }

        // Validación específica para Eliminación Directa
        if (tipo === 'Eliminacion') {
            if (numEquipos % 2 !== 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '❌ Equipos Impares No Permitidos',
                    html: '<p style="font-size: 1.1rem; margin: 15px 0;">El torneo de <strong>Eliminación Directa</strong> solo maneja equipos <strong>PARES</strong>.</p>' +
                          '<p style="margin: 15px 0;">Actualmente tienes: <strong style="color: #ff6b6b;">' + numEquipos + ' equipos</strong></p>' +
                          '<p>Selecciona <strong style="color: #00ff88;">' + (numEquipos + 1) + '</strong> o <strong style="color: #00ff88;">' + (numEquipos - 1) + '</strong> equipos.</p>',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#ffd700'
                });
                return false;
            }
        }
    });

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
                mostrarConfig();
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

function actualizarGrupos() {
    let selectedEquipos = $('select[name="equipos[]"]').val() || [];
    let numEquipos = selectedEquipos.length;

    let numGrupos = parseInt($('#num_grupos').val()) || 0;

    if (numGrupos > 0 && numEquipos > 0) {
        let porGrupo = Math.floor(numEquipos / numGrupos);
        let sobrantes = numEquipos % numGrupos;
        $('#equipos_por_grupo').val(porGrupo);
        
        if (sobrantes === 0) {
            $('#info_grupos').html('✔ Reparto equitativo: ' + numGrupos + ' grupos de ' + porGrupo + ' equipos');
        } else {
            $('#info_grupos').html('⚠ ' + numGrupos + ' grupos de ' + porGrupo + ' equipos y ' + sobrantes + ' con 1 extra');
        }
    } else {
        $('#equipos_por_grupo').val('');
        $('#info_grupos').html('');
    }
}

function mostrarConfig() {
    let tipo = $('#tipo_torneo').val();
    let selectedEquipos = $('select[name="equipos[]"]').val() || [];
    let numEquipos = selectedEquipos.length;
    let btnGuardar = $('#btnGuardarTorneo');

    $('#config_grupos, #config_liguilla, #config_eliminacion').addClass('d-none');

    if (tipo === 'Grupos') $('#config_grupos').removeClass('d-none');
    if (tipo === 'Liguilla') $('#config_liguilla').removeClass('d-none');
    
    if (tipo === 'Eliminacion') {
        $('#config_eliminacion').removeClass('d-none');
        
        // Validar equipos pares para eliminación directa
        if (numEquipos === 0) {
            $('#alerta_sin_equipos').removeClass('d-none');
            $('#alerta_equipos_impares').addClass('d-none');
            $('#alerta_equipos_pares').addClass('d-none');
            btnGuardar.prop('disabled', true);
            btnGuardar.css('opacity', '0.5');
            btnGuardar.css('cursor', 'not-allowed');
        } else if (numEquipos % 2 !== 0) {
            $('#alerta_equipos_impares').removeClass('d-none');
            $('#alerta_equipos_pares').addClass('d-none');
            $('#alerta_sin_equipos').addClass('d-none');
            btnGuardar.prop('disabled', true);
            btnGuardar.css('opacity', '0.5');
            btnGuardar.css('cursor', 'not-allowed');
        } else {
            $('#alerta_equipos_impares').addClass('d-none');
            $('#alerta_equipos_pares').removeClass('d-none');
            $('#alerta_sin_equipos').addClass('d-none');
            btnGuardar.prop('disabled', false);
            btnGuardar.css('opacity', '1');
            btnGuardar.css('cursor', 'pointer');
        }
    } else {
        btnGuardar.prop('disabled', false);
        btnGuardar.css('opacity', '1');
        btnGuardar.css('cursor', 'pointer');
    }
    
    actualizarGrupos();
}
</script>
@endsection