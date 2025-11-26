@extends('layouts.app')

@section('title', $torneo->nombre . ' | MGR PLAY')

<nav class="navbar d-flex justify-content-between align-items-center">
    <div class="navbar-left">
        <a href="{{ route('usuario.vistaUsuario') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            MALAGA GARCÍA ROVIRA PLAY
        </a>
        <ul class="nav-menu">
            <li><a href="{{ route('usuario.listaTorneos') }}">Torneos</a></li>
            <li><a href="{{ route('usuario.listaEquipos') }}">Equipos</a></li>
            <li><a href="{{ route('usuario.listaJugadores') }}">Jugadores</a></li>
            <li><a href="{{ route('usuario.listaPartidos') }}">Partidos</a></li>
        </ul>
    </div>

    <div class="navbar-right">
        <a href="" class="icon-btn admin-btn" title="Usuario">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12c2.67 0 8 1.34 8 4v3H4v-3c0-2.66 5.33-4 8-4zm0-2c-1.1 0-2-.9-2-2s.9-2 2-2 
                2 .9 2 2-.9 2-2 2z"/>
            </svg>
            <span>{{ $admin->nombre }}</span>
        </a>
        <a href="{{ route('logout') }}">Cerrar sesión</a>
    </div>
</nav>

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

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: "Play", sans-serif;
    background-image: url("{{ asset('img/2713.jpg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    color: var(--blanco);
    min-height: 100vh;
}

/* === NAVBAR === */
.navbar {
    background: linear-gradient(90deg, #0f0f0f, #1a1f24);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
    padding: 10px 30px;
}

.navbar-left {
    display: flex;
    align-items: center;
    gap: 25px;
}

.logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: var(--blanco);
    font-weight: bold;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.logo img {
    height: 50px;
    margin-right: 15px;
}

.logo:hover {
    color: var(--verde-neon);
    transform: scale(1.05);
}

.nav-menu {
    display: flex;
    list-style: none;
    gap: 20px;
}

.nav-menu li a {
    text-decoration: none;
    color: #ddd;
    padding: 8px 14px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.nav-menu li a:hover {
    color: var(--verde-neon);
    background-color: rgba(255, 255, 255, 0.08);
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

.navbar-right a {
    color: var(--blanco);
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.navbar-right a:hover {
    color: var(--verde-neon);
}

.icon-btn {
    display: flex;
    align-items: center;
    gap: 8px;
}

.icon-btn svg {
    width: 24px;
    height: 24px;
}

/* === CONTAINER === */
.container {
    max-width: 1400px;
    margin: 30px auto;
    padding: 0 20px;
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

.estado-Pendiente {
    background: linear-gradient(135deg, #ffd93d 0%, #ff9f1c 100%);
    color: #000;
}

.estado-en-curso, .estado-En.curso {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: #000;
}

.estado-Finalizado {
    background: linear-gradient(135deg, #a8a8a8 0%, #6c757d 100%);
    color: #fff;
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

.partidos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
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
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.goles-badge {
    background: var(--verde-neon);
    color: #000;
    padding: 8px 16px;
    border-radius: 15px;
    font-weight: 800;
    font-size: 1.3rem;
    min-width: 50px;
    display: inline-block;
}

.vs-text {
    color: var(--azul-info);
    font-size: 1.2rem;
    font-weight: 700;
}

/* === BADGES DE ESTADO === */
.badge-jugado {
    background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
    color: #000;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
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
    display: inline-block;
}

/* === INFO ADICIONAL === */
.partido-info {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
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

.info-icon {
    font-size: 1.2rem;
}

/* === ESTADO VACÍO === */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
    background: linear-gradient(145deg, var(--gris-medio) 0%, var(--gris-claro) 100%);
    border-radius: 20px;
    border: 2px solid rgba(255, 255, 255, 0.1);
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
    color: var(--blanco);
}

/* === BOTÓN VOLVER === */
.btn-volver {
    background: linear-gradient(135deg, var(--gris-claro) 0%, var(--gris-medio) 100%);
    color: var(--blanco);
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.btn-volver:hover {
    transform: translateY(-2px);
    border-color: var(--verde-neon);
    box-shadow: 0 8px 25px rgba(0, 255, 136, 0.2);
    color: var(--blanco);
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
    
    .partidos-grid {
        grid-template-columns: 1fr;
    }
    
    .equipos-container {
        flex-direction: column;
        gap: 20px;
    }
    
    .marcador-container {
        order: -1;
    }
    
    .marcador {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .logo img {
        height: 35px;
        margin-right: 8px;
    }
    
    .logo {
        font-size: 0.9rem;
    }
    
    .nav-menu {
        display: none;
    }
}
</style>

<div class="container fade-in">
    {{-- HERO HEADER --}}
    <div class="torneo-hero slide-up">
        <div class="torneo-trofeo">🏆</div>
        <h1 class="torneo-titulo">{{ $torneo->nombre }}</h1>
        <div class="estado-badge estado-{{ $torneo->estado }}">
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

    {{-- PARTIDOS --}}
    <div class="partidos-section slide-up" style="animation-delay: 0.4s;">
        <h2 class="section-title">⚽ Partidos del Torneo</h2>

        @if($torneo->partidos && $torneo->partidos->count() > 0)
            <div class="partidos-grid">
                @foreach($torneo->partidos as $partido)
                    @php
                        $equiposPartido = $partido->partido_equipos;
                    @endphp
                    
                    @if($equiposPartido && $equiposPartido->count() >= 2)
                        <div class="partido-card">
                            <div class="partido-header">
                                📅 {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }} 
                                @if($partido->hora)
                                    • ⏰ {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}
                                @endif
                            </div>
                            <div class="partido-body">
                                <div class="equipos-container">
                                    {{-- Equipo 1 --}}
                                    <div class="equipo-info">
                                        @if($equiposPartido[0]->equipo && $equiposPartido[0]->equipo->escudo)
                                            <img src="{{ asset('storage/public/escudos/' . $equiposPartido[0]->equipo->escudo) }}"
                                                 class="escudo-equipo"
                                                 alt="{{ $equiposPartido[0]->equipo->nombre }}">
                                        @endif
                                        <p class="nombre-equipo">{{ $equiposPartido[0]->equipo->nombre ?? 'Por definir' }}</p>
                                    </div>

                                    {{-- Marcador --}}
                                    <div class="marcador-container">
                                        <div class="marcador">
                                            <span class="goles-badge">{{ $equiposPartido[0]->goles ?? '-' }}</span>
                                            <span class="vs-text">vs</span>
                                            <span class="goles-badge">{{ $equiposPartido[1]->goles ?? '-' }}</span>
                                        </div>
                                        @if($partido->jugado)
                                            <span class="badge-jugado">✓ Jugado</span>
                                        @else
                                            <span class="badge-pendiente">⏳ Pendiente</span>
                                        @endif
                                    </div>

                                    {{-- Equipo 2 --}}
                                    <div class="equipo-info">
                                        @if($equiposPartido[1]->equipo && $equiposPartido[1]->equipo->escudo)
                                            <img src="{{ asset('storage/public/escudos/' . $equiposPartido[1]->equipo->escudo) }}"
                                                 class="escudo-equipo"
                                                 alt="{{ $equiposPartido[1]->equipo->nombre }}">
                                        @endif
                                        <p class="nombre-equipo">{{ $equiposPartido[1]->equipo->nombre ?? 'Por definir' }}</p>
                                    </div>
                                </div>

                                <div class="partido-info">
                                    @if($partido->municipio)
                                        <div class="info-item">
                                            <span class="info-icon">📍</span>
                                            <span>{{ $partido->municipio->nombre }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($partido->fase)
                                        <div class="info-item">
                                            <span class="info-icon">🏆</span>
                                            <span>{{ $partido->fase }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">⚽</div>
                <div class="empty-message">No hay partidos programados aún</div>
                <p>Los partidos aparecerán aquí una vez sean programados</p>
            </div>
        @endif
    </div>

    {{-- BOTÓN VOLVER --}}
    <div class="text-center mt-5">
        <a href="{{ route('usuario.listaTorneos') }}" class="btn-volver">
            ⬅️ Volver a Torneos
        </a>
    </div>
</div>

@endsection