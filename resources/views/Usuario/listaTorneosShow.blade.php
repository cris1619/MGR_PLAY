@extends('layouts.app')

@section('title')
{{ $torneo->nombre }} | MGR PLAY
@endsection

@section('content')

<style>
:root {
    --verde-neon: #00ff88;
    --verde-oscuro: #00cc6a;
    --gris-oscuro: #0a0e12;
    --gris-medio: #1a1f24;
    --gris-claro: #2a2e33;
    --blanco: #f2f2f2;
    --azul-info: #4facfe;
    --rojo-peligro: #f5576c;
    --amarillo-warning: #ffd93d;
}

body {
    background-color: var(--gris-oscuro);
    color: var(--blanco);
}

/* === HERO HEADER === */
.torneo-hero {
    background: linear-gradient(135deg, rgba(0, 255, 136, 0.15) 0%, rgba(0, 204, 106, 0.05) 100%);
    border-radius: 25px;
    padding: 50px 30px;
    margin-bottom: 40px;
    border: 2px solid rgba(0, 255, 136, 0.3);
    position: relative;
    overflow: hidden;
    text-align: center;
}

.torneo-hero::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(0, 255, 136, 0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-20px) translateX(20px); }
}

.torneo-titulo {
    font-size: 3rem;
    font-weight: 900;
    color: var(--verde-neon);
    text-shadow: 0 0 30px rgba(0, 255, 136, 0.5);
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
}

.torneo-trofeo {
    font-size: 4rem;
    margin-bottom: 20px;
    display: inline-block;
    animation: bounce 2s ease-in-out infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* === STATS CARDS === */
.info-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-item {
    background: linear-gradient(135deg, var(--gris-medio) 0%, var(--gris-claro) 100%);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-item::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--verde-neon), var(--azul-info));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.stat-item:hover::before {
    transform: scaleX(1);
}

.stat-item:hover {
    transform: translateY(-5px);
    border-color: var(--verde-neon);
    box-shadow: 0 10px 30px rgba(0, 255, 136, 0.2);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
    display: block;
}

.stat-label {
    font-size: 0.85rem;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--verde-neon);
}

/* === ESTADO BADGE === */
.estado-badge {
    display: inline-block;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 15px;
}

.estado-pendiente {
    background: linear-gradient(135deg, #ffd93d 0%, #ff9f1c 100%);
    color: #000;
}

.estado-en-curso {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: #000;
}

.estado-finalizado {
    background: linear-gradient(135deg, #a8a8a8 0%, #6c757d 100%);
    color: #fff;
}

/* === BOTÓN VER CLASIFICACIÓN === */
.btn-clasificacion {
    background: linear-gradient(135deg, #ffd93d 0%, #ff9f1c 100%);
    color: #000;
    border: none;
    border-radius: 30px;
    padding: 18px 40px;
    font-size: 1.2rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(255, 217, 61, 0.3);
    display: inline-block;
    text-decoration: none;
}

.btn-clasificacion:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 10px 30px rgba(255, 217, 61, 0.5);
    color: #000;
}

/* === TABLA DE CLASIFICACIÓN === */
.clasificacion-card {
    background: linear-gradient(145deg, #141719 0%, #1a1f24 100%);
    border: 2px solid rgba(0, 255, 136, 0.3);
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 40px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
}

.clasificacion-header {
    background: linear-gradient(90deg, var(--verde-neon) 0%, var(--verde-oscuro) 100%);
    color: #000;
    padding: 20px;
    font-weight: 800;
    font-size: 1.3rem;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.tabla-clasificacion {
    width: 100%;
    margin: 0;
}

.tabla-clasificacion thead {
    background: var(--gris-claro);
}

.tabla-clasificacion thead th {
    color: var(--verde-neon);
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.9rem;
    padding: 18px 15px;
    border: none;
}

.tabla-clasificacion tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.tabla-clasificacion tbody tr:hover {
    background: rgba(0, 255, 136, 0.05);
    transform: scale(1.01);
}

.tabla-clasificacion tbody td {
    padding: 18px 15px;
    vertical-align: middle;
    border: none;
}

.posicion-destacada {
    background: linear-gradient(90deg, rgba(255, 215, 0, 0.2) 0%, transparent 100%);
    border-left: 4px solid #ffd700;
}

.equipo-nombre {
    font-weight: 700;
    color: var(--blanco);
    font-size: 1.05rem;
}

.dg-positiva {
    color: #4ade80;
    font-weight: 700;
}

.dg-negativa {
    color: #f87171;
    font-weight: 700;
}

.dg-neutral {
    color: #9ca3af;
    font-weight: 700;
}

/* === SECCIÓN PARTIDOS === */
.partidos-section {
    margin-top: 50px;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--verde-neon);
    margin-bottom: 40px;
    text-shadow: 0 0 20px rgba(0, 255, 136, 0.3);
}

.fase-title {
    color: var(--amarillo-warning);
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 3px solid var(--amarillo-warning);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* === TARJETAS DE PARTIDO === */
.partido-card {
    background: linear-gradient(145deg, var(--gris-medio) 0%, var(--gris-claro) 100%);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
}

.partido-card:hover {
    transform: translateY(-8px);
    border-color: var(--verde-neon);
    box-shadow: 0 15px 40px rgba(0, 255, 136, 0.2);
}

.partido-header {
    background: linear-gradient(90deg, #000 0%, var(--gris-oscuro) 100%);
    color: var(--blanco);
    padding: 15px;
    text-align: center;
    font-weight: 700;
    font-size: 0.95rem;
    border-bottom: 2px solid var(--verde-neon);
}

.partido-body {
    padding: 25px;
}

.equipos-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.equipo-info {
    flex: 1;
    text-align: center;
}

.escudo-equipo {
    width: 60px;
    height: 60px;
    object-fit: contain;
    margin-bottom: 12px;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    transition: transform 0.3s ease;
}

.partido-card:hover .escudo-equipo {
    transform: scale(1.1);
}

.nombre-equipo {
    font-weight: 700;
    font-size: 1rem;
    color: var(--blanco);
    margin: 0;
}

.marcador-container {
    text-align: center;
    padding: 0 15px;
}

.marcador {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--verde-neon);
    margin-bottom: 10px;
    text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
}

.vs-text {
    color: var(--azul-info);
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 7px;
}

/* === BADGES DE ESTADO === */
.badge-jugado {
    background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
    color: #000;
    padding: 4px 8px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-pendiente {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: #000;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* === INFO ADICIONAL === */
.partido-info {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.info-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: #9ca3af;
    font-size: 0.95rem;
    margin-bottom: 8px;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-icon {
    font-size: 1.2rem;
}

/* === ELIMINACIÓN DIRECTA === */
.eliminacion-container {
    margin-bottom: 50px;
}

/* === ANIMACIONES === */
.fade-in {
    animation: fadeIn 0.8s ease forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.slide-up {
    animation: slideUp 0.6s ease forwards;
    opacity: 0;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .torneo-titulo {
        font-size: 2rem;
    }
    
    .torneo-trofeo {
        font-size: 3rem;
    }
    
    .info-stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .stat-item {
        padding: 20px 15px;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .equipos-container {
        flex-direction: column;
        gap: 20px;
    }
    
    .marcador-container {
        order: -1;
    }
    
    .escudo-equipo {
        width: 60px;
        height: 60px;
    }
    
    .marcador {
        font-size: 2rem;
    }
}

/* === ESTADO VACÍO === */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-message {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
}
</style>

<div class="container py-4 fade-in">

    {{-- HERO HEADER --}}
    <div class="torneo-hero slide-up">
        <div class="torneo-trofeo">🏆</div>
        <h1 class="torneo-titulo">{{ $torneo->nombre }}</h1>
        <div class="estado-badge 
            @if($torneo->estado == 'Pendiente') estado-pendiente
            @elseif($torneo->estado == 'En curso') estado-en-curso
            @else estado-finalizado @endif">
            {{ ucfirst($torneo->estado) }}
        </div>
    </div>

    {{-- INFORMACIÓN GENERAL EN CARDS --}}
    <div class="info-stats slide-up" style="animation-delay: 0.2s;">
        <div class="stat-item">
            <span class="stat-icon">⚽</span>
            <div class="stat-label">Tipo</div>
            <div class="stat-value">{{ $torneo->tipo }}</div>
        </div>

        <div class="stat-item">
            <span class="stat-icon">📍</span>
            <div class="stat-label">Municipio</div>
            <div class="stat-value">{{ $torneo->municipio->nombre ?? '-' }}</div>
        </div>

        <div class="stat-item">
            <span class="stat-icon">🔵</span>
            <div class="stat-label">Fecha Inicio</div>
            <div class="stat-value">{{ $torneo->fecha_inicio ? \Carbon\Carbon::parse($torneo->fecha_inicio)->format('d/m/Y') : '-' }}</div>
        </div>

        <div class="stat-item">
            <span class="stat-icon">🔴</span>
            <div class="stat-label">Fecha Fin</div>
            <div class="stat-value">{{ $torneo->fecha_fin ? \Carbon\Carbon::parse($torneo->fecha_fin)->format('d/m/Y') : '-' }}</div>
        </div>

        @if($torneo->premio)
        <div class="stat-item">
            <span class="stat-icon">💰</span>
            <div class="stat-label">Premio</div>
            <div class="stat-value">{{ $torneo->premio }}</div>
        </div>
        @endif

        <div class="stat-item">
            <span class="stat-icon">👥</span>
            <div class="stat-label">Equipos</div>
            <div class="stat-value">{{ $torneo->num_equipos ?? 0 }}</div>
        </div>
    </div>

    {{-- BOTÓN VER CLASIFICACIÓN --}}
    @if($torneo->tipo === 'Liguilla' || $torneo->tipo === 'Grupos')
        <div class="text-center my-5 slide-up" style="animation-delay: 0.3s;">
            <a href="{{ route('torneo.clasificacion.liguilla', $torneo->id) }}" class="btn-clasificacion">
                🏆 Ver Clasificación Completa
            </a>
        </div>
    @endif

    {{-- TABLA DE CLASIFICACIÓN --}}
    @if(isset($clasificacion) && $clasificacion->count() > 0)
        <div class="clasificacion-card slide-up" style="animation-delay: 0.4s;">
            <div class="clasificacion-header">
                📊 Tabla de Clasificación
            </div>
            <div class="table-responsive">
                <table class="tabla-clasificacion">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Pos</th>
                            <th>Equipo</th>
                            <th style="width: 100px;">PJ</th>
                            <th style="width: 100px;">PTS</th>
                            <th style="width: 100px;">GF</th>
                            <th style="width: 100px;">GC</th>
                            <th style="width: 100px;">DIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clasificacion as $index => $fila)
                            <tr class="{{ $index < 4 ? 'posicion-destacada' : '' }}">
                                <td class="text-center">
                                    <strong style="font-size: 1.2rem; color: var(--verde-neon);">{{ $index + 1 }}</strong>
                                </td>
                                <td>
                                    <div class="equipo-nombre">{{ $fila->equipo->nombre }}</div>
                                </td>
                                <td class="text-center">{{ $fila->partidos_jugados ?? 0 }}</td>
                                <td class="text-center">
                                    <strong style="color: var(--verde-neon); font-size: 1.1rem;">{{ $fila->puntos }}</strong>
                                </td>
                                <td class="text-center">{{ $fila->goles_favor }}</td>
                                <td class="text-center">{{ $fila->goles_contra }}</td>
                                <td class="text-center">
                                    @php
                                        $dg = $fila->goles_favor - $fila->goles_contra;
                                    @endphp
                                    <span class="{{ $dg > 0 ? 'dg-positiva' : ($dg < 0 ? 'dg-negativa' : 'dg-neutral') }}">
                                        {{ $dg > 0 ? '+' : '' }}{{ $dg }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- PARTIDOS --}}
    <div class="partidos-section slide-up" style="animation-delay: 0.5s;">
        <h2 class="section-title">⚽ Partidos del Torneo</h2>

        @if($torneo->tipo == 'eliminacion')
            {{-- ELIMINACIÓN DIRECTA --}}
            @php
                $partidosPorFase = $partidos->groupBy('fase');
            @endphp

            @foreach($partidosPorFase as $fase => $partidosFase)
                <div class="eliminacion-container">
                    <h3 class="fase-title">{{ $fase }}</h3>
                    <div class="row g-4">
                        @foreach($partidosFase as $partido)
                            @php
                                $equipos = $partido->partido_equipos;
                                $local = $equipos->where('rol', 'Local')->first();
                                $visitante = $equipos->where('rol', 'Visitante')->first();
                            @endphp
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="partido-card">
                                    <div class="partido-header">
                                        📅 {{ \Carbon\Carbon::parse($partido->fecha)->format('d M Y') }}
                                        @if($partido->hora) • ⏰ {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}@endif
                                    </div>
                                    <div class="partido-body">
                                        <div class="equipos-container">
                                            {{-- Local --}}
                                            <div class="equipo-info">
                                                <img src="{{ asset('storage/public/escudos/' . $local->equipo->escudo) }}" 
                                                     class="escudo-equipo" 
                                                     alt="{{ $local->equipo->nombre }}">
                                                <p class="nombre-equipo">{{ $local->equipo->nombre }}</p>
                                            </div>

                                            {{-- Marcador --}}
                                            <div class="marcador-container">
                                                <div class="marcador">
                                                    {{ $local->goles ?? '-' }}
                                                    <span class="vs-text">vs</span>
                                                    {{ $visitante->goles ?? '-' }}
                                                </div>
                                                @if(!is_null($local->goles) && !is_null($visitante->goles))
                                                    <span class="badge-jugado">✓ Jugado</span>
                                                @else
                                                    <span class="badge-pendiente">⏳ Pendiente</span>
                                                @endif
                                            </div>

                                            {{-- Visitante --}}
                                            <div class="equipo-info">
                                                <img src="{{ asset('storage/public/escudos/' . $visitante->equipo->escudo) }}" 
                                                     class="escudo-equipo" 
                                                     alt="{{ $visitante->equipo->nombre }}">
                                                <p class="nombre-equipo">{{ $visitante->equipo->nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="partido-info">
                                            <div class="info-item">
                                                <span class="info-icon">📍</span>
                                                <span>{{ $partido->municipio->nombre ?? 'Sin municipio' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            {{-- LIGUILLA O GRUPOS --}}
            @if($partidos->count() > 0)
                <div class="row g-4">
                    @foreach($partidos as $partido)
                        @php
                            $equiposPartido = $partido->partido_equipos;
                        @endphp
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="partido-card">
                                <div class="partido-header">
                                    📅 {{ \Carbon\Carbon::parse($partido->fecha)->format('d M Y') }} 
                                    • ⏰ {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}
                                </div>
                                <div class="partido-body">
                                    @if(count($equiposPartido) === 2)
                                        <div class="equipos-container">
                                            {{-- Equipo 1 --}}
                                            <div class="equipo-info">
                                                <img src="{{ asset('storage/public/escudos/' . $equiposPartido[0]->equipo->escudo) }}"
                                                     class="escudo-equipo"
                                                     alt="{{ $equiposPartido[0]->equipo->nombre }}">
                                                <p class="nombre-equipo">{{ $equiposPartido[0]->equipo->nombre }}</p>
                                            </div>

                                            {{-- Marcador --}}
                                            <div class="marcador-container">
                                                <div class="marcador">
                                                    {{ $equiposPartido[0]->goles ?? '-' }}
                                                    <span class="vs-text">vs</span>
                                                    {{ $equiposPartido[1]->goles ?? '-' }}
                                                </div>
                                                @if(!is_null($equiposPartido[0]->goles) && !is_null($equiposPartido[1]->goles))
                                                    <span class="badge-jugado">✓ Jugado</span>
                                                @else
                                                    <span class="badge-pendiente">⏳ Pendiente</span>
                                                @endif
                                            </div>

                                            {{-- Equipo 2 --}}
                                            <div class="equipo-info">
                                                <img src="{{ asset('storage/public/escudos/' . $equiposPartido[1]->equipo->escudo) }}"
                                                     class="escudo-equipo"
                                                     alt="{{ $equiposPartido[1]->equipo->nombre }}">
                                                <p class="nombre-equipo">{{ $equiposPartido[1]->equipo->nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="partido-info">
                                            <div class="info-item">
                                                <span class="info-icon">📍</span>
                                                <span>{{ $partido->municipio->nombre ?? 'Sin municipio' }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">⚽</div>
                    <div class="empty-message">No hay partidos programados aún</div>
                    <p>Los partidos aparecerán aquí una vez sean programados</p>
                </div>
            @endif
        @endif
    </div>

</div>

@endsection