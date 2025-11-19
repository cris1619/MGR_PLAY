@extends('layouts.app')

@section('title', 'Editar Partido')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Editar Partido</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>Paso 1:</strong> Primero guarda la fecha, hora y ubicación (municipio y cancha). Luego podrás ingresar el marcador.
            </div>
            
            <!-- Botón para abrir Modal de Información Básica -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInfoPartido">
                <i class="fas fa-calendar-alt"></i> Editar Información del Partido
            </button>
            
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalMarcador">
                <i class="fas fa-futbol"></i> Ingresar Marcador
            </button>
        </div>
    </div>
</div>

<!-- MODAL 1: Información del Partido -->
<div class="modal fade" id="modalInfoPartido" tabindex="-1" aria-labelledby="modalInfoPartidoLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                    <div class="mb-3">
                        <label for="fecha" class="form-label"><strong>Fecha</strong></label>
                        <input type="date" id="fecha" name="fecha" class="form-control" 
                               value="{{ $partido->fecha }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="hora" class="form-label"><strong>Hora</strong></label>
                        <input type="time" id="hora" name="hora" class="form-control" 
                               value="{{ $partido->hora }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="fase" class="form-label"><strong>Fase</strong></label>
                        <input type="text" id="fase" name="fase" class="form-control" 
                               value="{{ $partido->fase }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="municipio" class="form-label"><strong>Municipio</strong></label>
                        <select id="municipio" name="id_municipio" class="form-select">
                            <option value="">Seleccionar municipio...</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}" {{ $partido->id_municipio == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cancha" class="form-label"><strong>Cancha</strong></label>
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

                    <div class="mb-3">
                        <label for="arbitro" class="form-label"><strong>Árbitro</strong></label>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMarcadorLabel">
                    <i class="fas fa-futbol"></i> Marcador
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formMarcador" action="{{ route('partidos.update', $partido->id) }}" method="POST" onsubmit="return validarMarcador()">
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
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $equipos[0]['nombre'] }}</h6>
                                        <input type="number" name="goles[{{ $equipos[0]['id'] }}]" 
                                               class="form-control form-control-lg text-center goles-input" 
                                               min="0" value="{{ $equipos[0]['pivot']['goles'] ?? 0 }}"
                                               data-equipo-id="{{ $equipos[0]['id'] }}"
                                               data-equipo-nombre="{{ $equipos[0]['nombre'] }}"
                                               style="font-size: 36px; font-weight: bold;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                <h4 class="text-muted">VS</h4>
                            </div>
                            
                            <div class="col-md-5">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $equipos[1]['nombre'] }}</h6>
                                        <input type="number" name="goles[{{ $equipos[1]['id'] }}]" 
                                               class="form-control form-control-lg text-center goles-input" 
                                               min="0" value="{{ $equipos[1]['pivot']['goles'] ?? 0 }}"
                                               data-equipo-id="{{ $equipos[1]['id'] }}"
                                               data-equipo-nombre="{{ $equipos[1]['nombre'] }}"
                                               style="font-size: 36px; font-weight: bold;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PENALES (solo si hay empate) -->
                        <div id="seccionPenales" style="display: none;" class="mt-4 p-3 border border-warning rounded bg-light">
                            <div style="text-align: center; margin-bottom: 15px;">
                                <span class="badge bg-warning" style="font-size: 14px; padding: 8px 12px;">⚠️ REQUERIDO: Ingresa los penales</span>
                            </div>
                            <div class="alert alert-warning mb-3">
                                <strong>Empate</strong> — El que más penales anote será el ganador
                            </div>
                            
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label"><strong>Penales {{ $equipos[0]['nombre'] }}</strong></label>
                                    <input type="number" name="penales[{{ $equipos[0]['id'] }}]" 
                                           class="form-control penales-input" min="0" value="0"
                                           style="font-size: 24px; font-weight: bold; text-align: center;">
                                </div>
                                <div class="col-md-2 d-flex align-items-end justify-content-center pb-2">
                                    <h5 class="text-muted">VS</h5>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label"><strong>Penales {{ $equipos[1]['nombre'] }}</strong></label>
                                    <input type="number" name="penales[{{ $equipos[1]['id'] }}]" 
                                           class="form-control penales-input" min="0" value="0"
                                           style="font-size: 24px; font-weight: bold; text-align: center;">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            ❌ No hay 2 equipos disponibles para ingresar marcador.
                        </div>
                    @endif
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Marcador
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ESTILOS -->
<style>
    .goles-input {
        border: 2px solid #dee2e6;
    }
    .penales-input {
        border: 2px solid #ffc107;
    }
</style>

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

    // Agregar listeners cuando el DOM esté listo
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
    window.validarMarcador = function() {
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

            // Si los penales también son iguales
            if (penales1 === penales2) {
                alertaDiv.innerHTML = '❌ <strong>Penales iguales</strong> — Ingresa marcador de penales diferentes.';
                alertaDiv.style.display = 'block';
                alertaDiv.scrollIntoView({ behavior: 'smooth' });
                return false;
            }

            // Si no hay penales (ambos en 0)
            if (penales1 === 0 && penales2 === 0) {
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
