@extends('layouts.app')

@section('title', 'Editar Partido | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('torneos.index') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            ⚽ EDITAR PARTIDO
        </a>
    </div>
    <div class="d-flex gap-2">
        <a href="javascript:history.back()" class="btn btn-outline-light">← Volver</a>
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .logo {
        display: flex;
        align-items: center;
        color: white;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
        color: white;
    }

    /* ==== ANIMACIONES ==== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glowIn {
        0% { box-shadow: 0 0 0 rgba(0, 204, 255, 0); }
        100% { box-shadow: 0 0 20px rgba(0, 204, 255, 0.4); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* ==== CONTENEDOR PRINCIPAL ==== */
    .edit-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 25px;
        padding: 40px;
        max-width: 1200px;
        margin: 50px auto;
        color: #fff;
        animation: fadeInUp 0.8s ease forwards, glowIn 1.5s ease 0.3s forwards;
    }

    .edit-card h2 {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* ==== ALERT INFORMATIVO ==== */
    .alert-info-custom {
        background: linear-gradient(135deg, rgba(0, 204, 255, 0.15) 0%, rgba(0, 255, 136, 0.15) 100%);
        border: 2px solid #00ccff;
        border-radius: 15px;
        padding: 20px;
        color: #00ccff;
        font-size: 1rem;
        margin-bottom: 30px;
        animation: fadeInUp 0.8s ease 0.2s forwards;
    }

    .alert-info-custom strong {
        color: #00ff88;
        font-size: 1.1rem;
    }

    /* ==== BOTONES DE ACCIÓN PRINCIPALES ==== */
    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .btn-action {
        background: linear-gradient(145deg, #2a2e33 0%, #1a1f24 100%);
        border: 2px solid #3a3e43;
        border-radius: 20px;
        padding: 30px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .btn-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #00ccff, #00ff88, #00ccff);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .btn-action:hover {
        transform: translateY(-5px);
        border-color: #00ccff;
        box-shadow: 0 10px 30px rgba(0, 204, 255, 0.3);
    }

    .btn-action-primary::before {
        background: linear-gradient(90deg, #00ccff, #0088ff, #00ccff);
    }

    .btn-action-warning::before {
        background: linear-gradient(90deg, #ffd700, #ffed4e, #ffd700);
    }

    .btn-action i {
        font-size: 3rem;
        margin-bottom: 15px;
        display: block;
    }

    .btn-action-primary i {
        color: #00ccff;
    }

    .btn-action-warning i {
        color: #ffd700;
    }

    .btn-action-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-action-primary .btn-action-title {
        color: #00ccff;
    }

    .btn-action-warning .btn-action-title {
        color: #ffd700;
    }

    .btn-action-desc {
        font-size: 0.95rem;
        color: #aaa;
    }

    /* ==== MODAL ESTILO ==== */
    .modal-content {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        color: #fff;
    }

    .modal-header {
        background: linear-gradient(135deg, #1a1f24 0%, #2a2e33 100%);
        border-bottom: 2px solid #3a3e43;
        border-radius: 20px 20px 0 0;
        padding: 20px 25px;
    }

    .modal-title {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .modal-body {
        padding: 30px;
    }

    .modal-footer {
        border-top: 2px solid #3a3e43;
        background: linear-gradient(135deg, #1a1f24 0%, #2a2e33 100%);
        padding: 20px 25px;
        border-radius: 0 0 20px 20px;
    }

    .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .btn-close:hover {
        opacity: 1;
    }

    /* ==== CAMPOS DE FORMULARIO ==== */
    .form-label {
        color: #00ccff !important;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    input.form-control,
    select.form-select {
        background-color: #2a2e33;
        border: 2px solid #3a3e43;
        color: white;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 1.05rem;
        transition: all 0.3s ease;
    }

    input.form-control:focus,
    select.form-select:focus {
        border-color: #00ccff;
        box-shadow: 0 0 15px rgba(0, 204, 255, 0.4);
        background-color: #2f3339;
        transform: translateY(-2px);
        outline: none;
    }

    input.form-control[readonly] {
        background-color: #1a1f24;
        border-color: #2a2e33;
        color: #888;
        cursor: not-allowed;
    }

    select.form-select option {
        background-color: #1B1F23;
        color: #fff;
        padding: 10px;
    }

    /* ==== TARJETAS DE EQUIPOS ==== */
    .equipo-card {
        background: linear-gradient(145deg, #2a2e33 0%, #1a1f24 100%);
        border: 2px solid #3a3e43;
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .equipo-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #00ccff, #00ff88);
    }

    .equipo-card:hover {
        transform: translateY(-5px);
        border-color: #00ff88;
        box-shadow: 0 10px 25px rgba(0, 255, 136, 0.2);
    }

    .equipo-card .card-title {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .goles-input {
        font-size: 3rem !important;
        font-weight: 800 !important;
        text-align: center !important;
        border: 3px solid #ffd700 !important;
        background: linear-gradient(135deg, #2a2e33 0%, #1a1f24 100%) !important;
        color: #ffd700 !important;
        border-radius: 15px !important;
        padding: 20px !important;
        height: auto !important;
    }

    .goles-input:focus {
        border-color: #00ff88 !important;
        box-shadow: 0 0 25px rgba(0, 255, 136, 0.5) !important;
        color: #00ff88 !important;
    }

    /* ==== SECCIÓN DE PENALES ==== */
    #seccionPenales {
        background: linear-gradient(145deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 170, 0, 0.1) 100%);
        border: 2px solid #ffd700 !important;
        border-radius: 20px !important;
        padding: 30px !important;
        margin-top: 30px !important;
        animation: pulse 2s ease-in-out infinite;
    }

    .badge-warning-custom {
        background: linear-gradient(135deg, #ffd700 0%, #ffaa00 100%);
        color: #1a1f24;
        font-weight: 800;
        padding: 12px 24px;
        border-radius: 20px;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
    }

    .alert-warning-custom {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.15) 0%, rgba(255, 170, 0, 0.15) 100%);
        border: 2px solid #ffd700;
        border-radius: 15px;
        padding: 15px;
        color: #ffd700;
        font-size: 1rem;
    }

    .alert-warning-custom strong {
        color: #ffed4e;
    }

    .penales-input {
        font-size: 2rem !important;
        font-weight: 700 !important;
        text-align: center !important;
        border: 3px solid #ffd700 !important;
        background: linear-gradient(135deg, #2a2e33 0%, #1a1f24 100%) !important;
        color: #ffd700 !important;
        border-radius: 12px !important;
        padding: 15px !important;
    }

    .penales-input:focus {
        border-color: #ffed4e !important;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.5) !important;
    }

    /* ==== ALERTAS ==== */
    .alert-danger {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.15) 0%, rgba(255, 68, 68, 0.15) 100%);
        border: 2px solid #ff6b6b;
        border-radius: 15px;
        padding: 20px;
        color: #ff6b6b;
        font-size: 1rem;
        text-align: center;
        margin: 20px 0;
    }

    #alertaValidacion {
        animation: fadeInUp 0.5s ease;
    }

    /* ==== BOTONES ==== */
    .btn-secondary {
        background: linear-gradient(135deg, #666 0%, #444 100%);
        border: none;
        color: #fff;
        padding: 12px 30px;
        border-radius: 20px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #777 0%, #555 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        border: none;
        color: #1a1f24;
        padding: 12px 30px;
        border-radius: 20px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0, 255, 136, 0.4);
        color: #1a1f24;
    }

    /* ==== VS SEPARATOR ==== */
    .vs-separator {
        font-size: 2.5rem;
        font-weight: 800;
        color: #ffd700;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 768px) {
        .edit-card {
            padding: 25px;
            margin: 30px 15px;
        }

        .edit-card h2 {
            font-size: 2rem;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }

        .goles-input {
            font-size: 2.5rem !important;
        }

        .vs-separator {
            font-size: 2rem;
        }
    }
</style>

<div class="edit-card">
    <h2>⚽ Editar Partido</h2>

    <div class="alert-info-custom">
        <strong>📋 Paso 1:</strong> Primero guarda la fecha, hora y ubicación (municipio y cancha). Luego podrás ingresar el marcador.
    </div>

    <div class="action-buttons">
        <button type="button" class="btn-action btn-action-primary" data-bs-toggle="modal" data-bs-target="#modalInfoPartido">
            <i class="fas fa-calendar-alt"></i>
            <div class="btn-action-title">Información del Partido</div>
            <div class="btn-action-desc">Fecha, hora, ubicación y árbitro</div>
        </button>

        <button type="button" class="btn-action btn-action-warning" data-bs-toggle="modal" data-bs-target="#modalMarcador">
            <i class="fas fa-futbol"></i>
            <div class="btn-action-title">Ingresar Marcador</div>
            <div class="btn-action-desc">Registra el resultado del partido</div>
        </button>
    </div>
</div>

<!-- MODAL 1: Información del Partido -->
<div class="modal fade" id="modalInfoPartido" tabindex="-1" aria-labelledby="modalInfoPartidoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoPartidoLabel">
                    <i class="fas fa-calendar-alt"></i> Información del Partido
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formInfoPartido" action="{{ route('partidos.update', $partido->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">📅 Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control"
                                   value="{{ $partido->fecha }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="hora" class="form-label">⏰ Hora</label>
                            <input type="time" id="hora" name="hora" class="form-control"
                                   value="{{ $partido->hora }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fase" class="form-label">🏆 Fase</label>
                        <input type="text" id="fase" name="fase" class="form-control"
                               value="{{ $partido->fase }}" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="municipio" class="form-label">📍 Municipio</label>
                            <select id="municipio" name="id_municipio" class="form-select">
                                <option value="">Seleccionar municipio...</option>
                                @foreach($municipios as $municipio)
                                    <option value="{{ $municipio->id }}" {{ $partido->id_municipio == $municipio->id ? 'selected' : '' }}>
                                        {{ $municipio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cancha" class="form-label">🏟️ Cancha</label>
                            <select id="cancha" name="id_cancha" class="form-select">
                                <option value="">Seleccionar cancha...</option>
                                @foreach($canchas as $cancha)
                                    <option value="{{ $cancha->id }}" data-municipio="{{ $cancha->idMunicipio ?? $cancha->id_municipio ?? '' }}"
                                        {{ (isset($partido->id_cancha) && $partido->id_cancha == $cancha->id) ? 'selected' : '' }}>
                                        {{ $cancha->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="arbitro" class="form-label">👨‍⚖️ Árbitro</label>
                        <select id="arbitro" name="id_arbitro" class="form-select">
                            <option value="">Seleccionar árbitro...</option>
                            @foreach($arbitros as $arbitro)
                                <option value="{{ $arbitro->id }}" {{ (isset($partido->id_arbitro) && $partido->id_arbitro == $arbitro->id) ? 'selected' : '' }}>
                                    {{ $arbitro->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Información
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL 2: Ingreso de Marcador -->
<div class="modal fade" id="modalMarcador" tabindex="-1" aria-labelledby="modalMarcadorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMarcadorLabel">
                    <i class="fas fa-futbol"></i> Marcador del Partido
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formMarcador" action="{{ route('partidos.update', $partido->id) }}" method="POST" onsubmit="return validarMarcador('{{ $partido->torneo->tipo }}')">
                @csrf
                @method('PUT')
                <input type="hidden" name="is_marcador" value="1">

                <div id="alertaValidacion" class="alert alert-danger" style="display: none; margin: 15px;"></div>

                <div class="modal-body">
                    @php
                        $equipos = $partido->equipos->toArray();
                    @endphp

                    @if(count($equipos) === 2)
                        <!-- GOLES -->
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="equipo-card">
                                    <h6 class="card-title">{{ $equipos[0]['nombre'] }}</h6>
                                    <input type="number" name="goles[{{ $equipos[0]['id'] }}]"
                                           class="form-control goles-input"
                                           min="0" value="{{ $equipos[0]['pivot']['goles'] ?? 0 }}"
                                           data-equipo-id="{{ $equipos[0]['id'] }}"
                                           data-equipo-nombre="{{ $equipos[0]['nombre'] }}">
                                </div>
                            </div>

                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                <div class="vs-separator">VS</div>
                            </div>

                            <div class="col-md-5">
                                <div class="equipo-card">
                                    <h6 class="card-title">{{ $equipos[1]['nombre'] }}</h6>
                                    <input type="number" name="goles[{{ $equipos[1]['id'] }}]"
                                           class="form-control goles-input"
                                           min="0" value="{{ $equipos[1]['pivot']['goles'] ?? 0 }}"
                                           data-equipo-id="{{ $equipos[1]['id'] }}"
                                           data-equipo-nombre="{{ $equipos[1]['nombre'] }}">
                                </div>
                            </div>
                        </div>

                        @if($partido->torneo && $partido->torneo->tipo === 'Eliminacion')
                        <!-- PENALES (solo si hay empate) -->
                        <div id="seccionPenales" style="display: none;">
                            <div style="text-align: center; margin-bottom: 20px;">
                                <span class="badge-warning-custom">⚠️ DESEMPATE POR PENALES</span>
                            </div>
                            <div class="alert-warning-custom mb-4">
                                <strong>Empate detectado</strong> — Ingresa el marcador de penales para determinar al ganador
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label">⚽ Penales {{ $equipos[0]['nombre'] }}</label>
                                    <input type="number" name="penales[{{ $equipos[0]['id'] }}]"
                                           class="form-control penales-input" min="0" value="0">
                                </div>
                                <div class="col-md-2 d-flex align-items-end justify-content-center pb-2">
                                    <h5 class="vs-separator" style="font-size: 1.5rem;">VS</h5>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">⚽ Penales {{ $equipos[1]['nombre'] }}</label>
                                    <input type="number" name="penales[{{ $equipos[1]['id'] }}]"
                                           class="form-control penales-input" min="0" value="0">
                                </div>
                            </div>
                        </div>
                        @endif

                    @else
                        <div class="alert alert-danger">
                            ❌ No hay 2 equipos disponibles para ingresar marcador.
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Marcador
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== FILTRAR CANCHAS POR MUNICIPIO =====
    const municipioSelect = document.getElementById('municipio');
    const canchaSelect = document.getElementById('cancha');

    function filterCanchas() {
        const selectedMunicipio = municipioSelect.value;
        let anyVisible = false;

        Array.from(canchaSelect.options).forEach(option => {
            if (option.value === '') {
                option.style.display = '';
                option.disabled = false;
                return;
            }

            const optMunicipio = option.getAttribute('data-municipio') || '';
            if (!selectedMunicipio || optMunicipio == selectedMunicipio) {
                option.style.display = '';
                option.disabled = false;
                anyVisible = true;
            } else {
                option.style.display = 'none';
                option.disabled = true;
            }
        });

        if (canchaSelect.value) {
            const selOpt = canchaSelect.selectedOptions[0];
            if (selOpt && selOpt.style.display === 'none') {
                canchaSelect.value = '';
            }
        }

        const placeholder = canchaSelect.querySelector('option[value=""]');
        if (placeholder) {
            placeholder.text = !anyVisible ? 'No hay canchas en este municipio' : 'Seleccionar cancha...';
        }
    }

    municipioSelect.addEventListener('change', filterCanchas);
    filterCanchas();

    // ===== MOSTRAR PENALES SI HAY EMPATE =====
    function checkEmpate() {
        const golesInputs = document.querySelectorAll('.goles-input');
        const seccionPenales = document.getElementById('seccionPenales');

        if (!seccionPenales || golesInputs.length < 2) return;

        const gol1 = parseInt(golesInputs[0].value) || 0;
        const gol2 = parseInt(golesInputs[1].value) || 0;

        console.log('Goles:', gol1, gol2, 'Empate:', gol1 === gol2);

        if (gol1 === gol2) {
            seccionPenales.style.display = 'block';
        } else {
            seccionPenales.style.display = 'none';
        }
    }

    // Agregar listeners
    const golesInputs = document.querySelectorAll('.goles-input');
    golesInputs.forEach(input => {
        input.addEventListener('input', checkEmpate);
        input.addEventListener('change', checkEmpate);
        input.addEventListener('keyup', checkEmpate);
    });

    // También ejecutar al abrir el modal
    const modalMarcador = document.getElementById('modalMarcador');
    if (modalMarcador) {
        modalMarcador.addEventListener('show.bs.modal', function() {
            setTimeout(checkEmpate, 100);
        });
    }

    // ===== VALIDAR PENALES AL GUARDAR =====
    window.validarMarcador = function(tipoTorneo) {
        const golesInputs = document.querySelectorAll('.goles-input');
        const gol1 = parseInt(golesInputs[0]?.value) || 0;
        const gol2 = parseInt(golesInputs[1]?.value) || 0;
        const alertaDiv = document.getElementById('alertaValidacion');

        // Si hay empate en goles
        if (gol1 === gol2) {
            // Validar que se ingresaron penales
            const penalesInputs = document.querySelectorAll('.penales-input');
            const penales1 = parseInt(penalesInputs[0]?.value) || 0;
            const penales2 = parseInt(penalesInputs[1]?.value) || 0;

            console.log('Penales:', penales1, penales2);

            // Si los penales también son iguales y es Eliminacion
            if (penales1 === penales2 && tipoTorneo === 'Eliminacion') {
                alertaDiv.innerHTML = '❌ <strong>Penales iguales</strong> — Ingresa marcador de penales diferentes.';
                alertaDiv.style.display = 'block';
                alertaDiv.scrollIntoView({ behavior: 'smooth' });
                return false;
            }

            // Si no hay penales (ambos en 0) y es Eliminacion
            if (penales1 === 0 && penales2 === 0 && tipoTorneo === 'Eliminacion') {
                alertaDiv.innerHTML = '❌ <strong>Empate en goles</strong> — Debes ingresar el marcador de penales.';
                alertaDiv.style.display = 'block';
                alertaDiv.scrollIntoView({ behavior: 'smooth' });
                return false;
            }
        }

        alertaDiv.style.display = 'none';
        return true;
    };
});
</script>

@endsection