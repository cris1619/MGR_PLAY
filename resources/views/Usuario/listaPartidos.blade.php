@extends('layouts.app')

@section('title', 'Partidos | MGR PLAY')

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
    --amarillo-warning: #ffd93d;
    --naranja-pendiente: #f59e0b;
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
.hero-section {
    background: linear-gradient(135deg, rgba(0, 255, 136, 0.15) 0%, rgba(0, 204, 106, 0.05) 100%);
    border-radius: 25px;
    padding: 50px 30px;
    margin-bottom: 40px;
    border: 2px solid rgba(0, 255, 136, 0.3);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
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

.hero-section h1 {
    font-size: 3rem;
    font-weight: 900;
    color: var(--verde-neon);
    text-shadow: 0 0 30px rgba(0, 255, 136, 0.5);
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.hero-section p {
    color: #dce0e6ff;
    font-size: 1.2rem;
    position: relative;
    z-index: 1;
}

/* === FILTROS === */
.filter-box {
    background: linear-gradient(145deg, var(--gris-medio) 0%, var(--gris-claro) 100%);
    border: 2px solid rgba(0, 255, 136, 0.2);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    display: flex;
    gap: 20px;
    align-items: flex-end;
}

.filter-group {
    flex: 1;
}

.filter-group label {
    display: block;
    color: var(--verde-neon);
    margin-bottom: 10px;
    font-weight: 700;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-group select {
    width: 100%;
    padding: 12px 15px;
    border-radius: 10px;
    border: 2px solid rgba(255, 255, 255, 0.1);
    background-color: var(--gris-oscuro);
    color: var(--blanco);
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-group select:focus {
    border-color: var(--verde-neon);
    outline: none;
    box-shadow: 0 0 15px rgba(0, 255, 136, 0.3);
}

.filter-group select:hover {
    border-color: var(--verde-neon);
}

.btn-filter {
    background: #00cc6a; /* Color sólido solicitado */
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 255, 136, 0.3); /* sombra adaptada */
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-filter:hover {
    background: #00e67a; /* Un tono más oscuro */
    transform: scale(1.03);
}

/* === GRID DE PARTIDOS (DISEÑO DE TARJETAS) === */
.partidos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.partido-card {
    background: linear-gradient(145deg, var(--gris-medio) 0%, var(--gris-claro) 100%);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
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
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid var(--verde-neon);
}

.partido-fecha {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.partido-fecha strong {
    color: var(--blanco);
    font-size: 1rem;
}

.partido-fecha small {
    color: #9ca3af;
    font-size: 0.85rem;
}

.fase-badge {
    background: #00ff88a6;
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
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
    margin-bottom: 10px;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    transition: transform 0.3s ease;
}

.partido-card:hover .escudo-equipo {
    transform: scale(1.1);
}

.nombre-equipo {
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--blanco);
    margin: 0;
}

.marcador-container {
    text-align: center;
    padding: 0 15px;
}

.marcador {
    font-size: 2.2rem;
    font-weight: 900;
    color: var(--verde-neon);
    margin-bottom: 8px;
    text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
}

.vs-text {
    color: #dce0e6ff;
    font-size: 1rem;
    font-weight: 700;
    margin: 0 8px;
}

.goles-badge {
    background: var(--verde-neon);
    color: #000;
    padding: 6px 12px;
    border-radius: 15px;
    font-weight: 800;
    font-size: 1.1rem;
    min-width: 40px;
    display: inline-block;
}

/* === BADGES DE ESTADO === */
.estado-container {
    text-align: center;
    margin-bottom: 15px;
}

.badge-jugado {
    background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
    color: #000;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9rem;
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
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

/* === INFO ADICIONAL === */
.partido-info {
    padding-top: 15px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
    gap: 15px;
}

.btn-ver-detalles {
    background:#00cc6a;
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(99, 254, 79, 0.3);
}

.btn-ver-detalles:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(79, 254, 123, 0.5);
    color: white;
}

/* === ESTADO VACÍO === */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: linear-gradient(145deg, var(--gris-medio) 0%, var(--gris-claro) 100%);
    border-radius: 20px;
    border: 2px solid rgba(255, 255, 255, 0.1);
}

.empty-icon {
    font-size: 5rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-message {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--blanco);
    margin-bottom: 10px;
}

.empty-state p {
    color: #9ca3af;
    font-size: 1.1rem;
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


/* === PAGINACIÓN === */
.pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 30px;
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
    .hero-section h1 {
        font-size: 2rem;
    }
    
    .hero-section p {
        font-size: 1rem;
    }
    
    .filter-box {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-primary{
        width: 100%;
    }
    .btn-outline-light{
        width: 100%;
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
    <div class="hero-section slide-up">
        <h1>Partidos del Torneo</h1>
        <p>Consulta la programación, resultados y estado de cada partido</p>
    </div>

    {{-- FILTROS --}}
   <form method="GET" action="{{ route(Route::currentRouteName()) }}" class="slide-up" style="animation-delay: 0.1s;">
    <div class="filter-box">

        <!-- Grupo 1: Torneos -->
        <div class="filter-group">
            <label for="torneo_id">Filtrar por Torneo:</label>
            <select name="torneo_id" id="torneo_id">
                <option value="">-- Todos los Torneos --</option>
                @foreach ($torneos as $torneo)
                    <option value="{{ $torneo->id }}" 
                        {{ request('torneo_id') == $torneo->id ? 'selected' : '' }}>
                        {{ $torneo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Grupo 2: Municipios -->
        <div class="filter-group">
            <label for="municipio_id">Filtrar por Municipio:</label>
            <select name="municipio_id" id="municipio_id">
                <option value="">-- Todos los Municipios --</option>
                @foreach ($municipios as $municipio)
                    <option value="{{ $municipio->id }}" 
                        {{ request('municipio_id') == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-filter"> 
            <i class="bi bi-search"></i> 
            Buscar </button>
    </div>
</form>


    {{-- GRID DE PARTIDOS --}}
    @if($partidos->count() > 0)
        <div class="partidos-grid slide-up" style="animation-delay: 0.2s;">
            @foreach($partidos as $partido)
                <div class="partido-card">
                    {{-- HEADER --}}
                    <div class="partido-header">
                        <div class="partido-fecha">
                            <strong><i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</strong>
                            <small><i class="bi bi-clock"></i>{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }} hrs</small>
                        </div>
                        <span class="fase-badge">{{ ucfirst($partido->fase) }}</span>
                    </div>

                    {{-- BODY --}}
                    <div class="partido-body">
                        {{-- EQUIPOS Y MARCADOR --}}
                        <div class="equipos-container">
                            @php
                                $equipos = $partido->equipos->take(2);
                            @endphp
                            
                            @if($equipos->count() >= 2)
                                {{-- Equipo 1 --}}
                                <div class="equipo-info">
                                    @if($equipos[0]->escudo)
                                        <img src="{{ asset('storage/public/escudos/' . $equipos[0]->escudo) }}" 
                                             class="escudo-equipo" 
                                             alt="{{ $equipos[0]->nombre }}">
                                    @endif
                                    <p class="nombre-equipo">{{ $equipos[0]->nombre }}</p>
                                </div>

                                {{-- Marcador --}}
                                <div class="marcador-container">
                                    <div class="marcador">
                                        <span class="goles-badge">{{ $equipos[0]->pivot->goles ?? 0 }}</span>
                                        <span class="vs-text">vs</span>
                                        <span class="goles-badge">{{ $equipos[1]->pivot->goles ?? 0 }}</span>
                                    </div>
                                </div>

                                {{-- Equipo 2 --}}
                                <div class="equipo-info">
                                    @if($equipos[1]->escudo)
                                        <img src="{{ asset('storage/public/escudos/' . $equipos[1]->escudo) }}" 
                                             class="escudo-equipo" 
                                             alt="{{ $equipos[1]->nombre }}">
                                    @endif
                                    <p class="nombre-equipo">{{ $equipos[1]->nombre }}</p>
                                </div>
                            @endif
                        </div>

                        {{-- ESTADO --}}
                        <div class="estado-container">
                            @if($partido->jugado)
                                <span class="badge-jugado"><i class="bi bi-check-circle-fill"></i> Jugado</span>
                            @else
                                <span class="badge-pendiente"><i class="bi bi-hourglass"></i> Pendiente</span>
                            @endif
                        </div>

                        {{-- ACCIONES --}}
                        <div class="partido-info">
                            <a href="{{ route('partidos.show', $partido->id) }}" class="btn-ver-detalles">
                                <i class="bi bi-eye"></i>
                                
                                 Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- ESTADO VACÍO --}}
        <div class="empty-state slide-up" style="animation-delay: 0.2s;">
            <div class="empty-icon">⚽</div>
            <div class="empty-message">No hay partidos disponibles</div>
            <p>Los partidos aparecerán aquí cuando se programen según los filtros seleccionados</p>
        </div>
    @endif

    {{-- PAGINACIÓN --}}
    @if ($partidos->lastPage() > 1)
        <div class="d-flex justify-content-center mt-4">
            {{ $partidos->links() }}
        </div>
    @endif

    {{-- BOTÓN VOLVER --}}
    <div class="text-center mt-5">
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn-volver">
            <i class="bi bi-arrow-left-circle"></i>
             Volver al Menú Principal
        </a>
    </div>
</div>
@endsection