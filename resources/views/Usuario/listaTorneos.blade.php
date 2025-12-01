@extends('layouts.app')

@section('title', 'Torneos | MGR PLAY')

<nav class="navbar">
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
        <a href="" class="icon-btn" title="Usuario">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12c2.67 0 8 1.34 8 4v3H4v-3c0-2.66 5.33-4 8-4zm0-2c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
            </svg>
            <span>{{ $admin->nombre }}</span>
        </a>
        <a href="{{ route('logout') }}">Cerrar sesión</a>
    </div>
</nav>

@section('content')

<style>
    /* ==== VARIABLES ==== */
    :root {
        --verde-neon: #00ff88;
        --verde-oscuro: #00cc6a;
        --gris-oscuro: #0a0e12;
        --gris-medio: #1a1f24;
        --gris-claro: #2a2e33;
        --blanco: #f2f2f2;
    }

    /* ==== ANIMACIONES ==== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glowIn {
        0% { box-shadow: 0 0 0 rgba(0,255,136,0); }
        100% { box-shadow: 0 0 20px rgba(0,255,136,0.4); }
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    /* ==== BODY ==== */
    body {
        font-family: "Play", sans-serif;
        background-image: url("{{ asset('img/2713.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative;
        color: var(--blanco);
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    /* ==== NAVBAR ==== */
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
        width: 28px;
        height: 28px;
        background: none;
        border: none;
        color: var(--blanco);
        cursor: pointer;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .icon-btn:hover {
        transform: scale(1.2);
        color: var(--verde-neon);
    }

    /* ==== CONTENEDOR PRINCIPAL ==== */
    .torneos-container {
        max-width: 1800px;
        margin: 0 auto;
        padding: 30px 20px;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards;
    }

    /* ==== HERO SECTION ==== */
    .hero-section {
        background: linear-gradient(135deg, rgba(0, 255, 136, 0.15) 0%, rgba(0, 204, 106, 0.05) 100%);
        border-radius: 20px;
        padding: 50px 30px;
        margin-bottom: 40px;
        border: 2px solid rgba(0, 255, 136, 0.3);
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 255, 136, 0.2);
        animation: glowIn 1.5s ease 0.3s forwards;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 255, 136, 0.15) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
        border-radius: 50%;
    }

    .hero-section h1 {
        font-size: 2.8rem;
        font-weight: 900;
        color: var(--verde-neon);
        text-shadow: 0 0 30px rgba(0, 255, 136, 0.5);
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .hero-section p {
        color: #dce0e6;
        font-size: 1.15rem;
        position: relative;
        z-index: 1;
        margin: 0;
    }

    /* ==== ESTADÍSTICAS ==== */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
        animation: slideInRight 0.6s ease forwards;
    }

    .stat-card {
        background: linear-gradient(145deg, rgba(27, 31, 35, 0.95) 0%, rgba(37, 42, 47, 0.95) 100%);
        border: 2px solid rgba(0, 255, 136, 0.2);
        border-radius: 18px;
        padding: 30px 25px;
        text-align: center;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 255, 136, 0.3);
        border-color: var(--verde-neon);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        animation: float 3s ease-in-out infinite;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--verde-neon);
        margin-bottom: 8px;
        text-shadow: 0 0 20px rgba(0, 255, 136, 0.5);
    }

    .stat-label {
        color: #9ca3af;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }

    /* ==== CARD CONTENEDOR ==== */
    .content-card {
        background: linear-gradient(145deg, rgba(27, 31, 35, 0.95) 0%, rgba(37, 42, 47, 0.95) 100%);
        border: 2px solid rgba(0, 255, 136, 0.2);
        border-radius: 20px;
        padding: 0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        overflow: hidden;
        animation: fadeInUp 0.8s ease 0.4s forwards;
        opacity: 0;
    }

    /* ==== TABLA ==== */
    .table-container {
        overflow-x: auto;
        border-radius: 20px;
    }

    .table-custom {
        width: 100%;
        margin: 0;
        color: #fff;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead {
        background: linear-gradient(90deg, var(--verde-neon) 0%, var(--verde-oscuro) 100%);
    }

    .table-custom thead th {
        color: #0f0f0f !important;
        font-weight: 800;
        text-transform: uppercase;
        padding: 20px 15px;
        border: none;
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-align: center;
        white-space: nowrap;
    }

    .table-custom thead th.col-acciones {
        position: sticky;
        right: 0;
        background: linear-gradient(90deg, var(--verde-neon) 0%, var(--verde-oscuro) 100%);
        z-index: 10;
        box-shadow: -4px 0 8px rgba(0,0,0,0.3);
    }

    .table-custom tbody tr {
        background-color: rgba(30, 34, 39, 0.8);
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .table-custom tbody tr:nth-of-type(even) {
        background-color: rgba(35, 40, 46, 0.8);
    }

    .table-custom tbody tr:hover {
        background: linear-gradient(90deg, rgba(0, 255, 136, 0.12) 0%, rgba(0, 255, 136, 0.05) 100%);
        transform: scale(1.002);
        box-shadow: 0 4px 15px rgba(0, 255, 136, 0.15);
    }

    .table-custom tbody td {
        padding: 18px 15px;
        border: none;
        color: #fff;
        font-weight: 500;
        vertical-align: middle;
        text-align: center;
        font-size: 0.9rem;
    }

    .table-custom tbody td.col-acciones {
        position: sticky;
        right: 0;
        background: linear-gradient(135deg, rgba(30, 34, 39, 0.95) 0%, rgba(35, 40, 46, 0.95) 100%);
        z-index: 5;
        box-shadow: -4px 0 8px rgba(0,0,0,0.3);
    }

    .table-custom tbody tr:nth-of-type(even) td.col-acciones {
        background: linear-gradient(135deg, rgba(35, 40, 46, 0.95) 0%, rgba(30, 34, 39, 0.95) 100%);
    }

    .table-custom tbody tr:hover td.col-acciones {
        background: linear-gradient(90deg, rgba(0, 255, 136, 0.12) 0%, rgba(0, 255, 136, 0.08) 100%);
    }

    .table-custom tbody td:first-child {
        color: var(--verde-neon);
        font-weight: 800;
        font-size: 1.05rem;
    }

    /* ==== NOMBRE TORNEO ==== */
    .torneo-nombre {
        font-weight: 700;
        color: var(--verde-neon);
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .torneo-nombre::before {
        content: "🏆";
        font-size: 1.3rem;
    }

    /* ==== BADGES ==== */
    .badge-custom {
        padding: 7px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        white-space: nowrap;
    }

    .badge-tipo {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        box-shadow: 0 2px 6px rgba(102, 126, 234, 0.3);
    }

    .badge-pendiente {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: #fff;
        box-shadow: 0 2px 6px rgba(240, 147, 251, 0.3);
    }

    .badge-en-curso {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: #0f0f0f;
        box-shadow: 0 2px 6px rgba(79, 172, 254, 0.3);
    }

    .badge-finalizado {
        background: linear-gradient(135deg, #a8a8a8 0%, #6c757d 100%);
        color: #fff;
        box-shadow: 0 2px 6px rgba(168, 168, 168, 0.3);
    }

    .badge-equipos {
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
        color: var(--verde-neon);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-weight: 700;
    }

    /* ==== FECHAS ==== */
    .fecha-cell {
        font-size: 0.85rem;
        line-height: 1.8;
    }

    .fecha-inicio {
        color: #4facfe;
        font-weight: 600;
    }

    .fecha-fin {
        color: #f5576c;
        font-weight: 600;
    }

    /* ==== PREMIO ==== */
    .premio-text {
        color: #ffd700;
        font-weight: 700;
        font-size: 1rem;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
    }

    /* ==== BOTÓN VER ==== */
    .btn-ver {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        border: 2px solid transparent;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .btn-ver:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        color: #fff;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.5);
        border-color: var(--verde-neon);
    }

    /* ==== ESTADO VACÍO ==== */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #999;
    }

    .empty-state-icon {
        font-size: 5rem;
        color: rgba(0, 255, 136, 0.3);
        margin-bottom: 25px;
        animation: float 3s ease-in-out infinite;
    }

    .empty-state h3 {
        color: var(--verde-neon);
        margin-bottom: 15px;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 1.1rem;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }

        .hero-section p {
            font-size: 1rem;
        }

        .stats-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .stat-card {
            padding: 20px 15px;
        }

        .stat-icon {
            font-size: 2.2rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-label {
            font-size: 0.8rem;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 12px 8px;
            font-size: 0.75rem;
        }

        .torneo-nombre {
            font-size: 0.9rem;
        }
    }
</style>

<div class="torneos-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <h1>🏆 Torneos Disponibles</h1>
        <p>Explora todos los torneos activos y encuentra tu próxima competición</p>
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">🏆</div>
            <div class="stat-value">{{ $torneos->count() }}</div>
            <div class="stat-label">Total Torneos</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⚡</div>
            <div class="stat-value">{{ $torneos->where('estado', 'En curso')->count() }}</div>
            <div class="stat-label">En Curso</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-value">{{ $torneos->where('estado', 'Pendiente')->count() }}</div>
            <div class="stat-label">Pendientes</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✓</div>
            <div class="stat-value">{{ $torneos->where('estado', 'Finalizado')->count() }}</div>
            <div class="stat-label">Finalizados</div>
        </div>
    </div>

    <!-- Tabla de Torneos -->
    <div class="content-card">
        <div class="table-container">
            @if($torneos->count() > 0)
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 18%;">Torneo</th>
                            <th style="width: 12%;">Municipio</th>
                            <th style="width: 10%;">Tipo</th>
                            <th style="width: 10%;">Estado</th>
                            <th style="width: 14%;">Fechas</th>
                            <th style="width: 8%;">Equipos</th>
                            <th style="width: 13%;">Premio</th>
                            <th class="col-acciones" style="width: 10%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($torneos as $torneo)
                            <tr>
                                <td><strong>#{{ $torneo->id }}</strong></td>
                                <td>
                                    <div class="torneo-nombre">{{ $torneo->nombre }}</div>
                                </td>
                                <td>
                                    <span style="color: #9ca3af;">
                                        📍 {{ $torneo->municipio ? $torneo->municipio->nombre : 'Sin municipio' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-custom badge-tipo">{{ $torneo->tipo }}</span>
                                </td>
                                <td>
                                    <span class="badge-custom 
                                        @if($torneo->estado == 'Pendiente') badge-pendiente
                                        @elseif($torneo->estado == 'En curso') badge-en-curso
                                        @else badge-finalizado 
                                        @endif">
                                        {{ $torneo->estado }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fecha-cell">
                                        <div class="fecha-inicio">
                                            🔵 {{ $torneo->fecha_inicio ? date('d/m/Y', strtotime($torneo->fecha_inicio)) : '-' }}
                                        </div>
                                        <div class="fecha-fin">
                                            🔴 {{ $torneo->fecha_fin ? date('d/m/Y', strtotime($torneo->fecha_fin)) : '-' }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-custom badge-equipos">
                                        👥 {{ $torneo->num_equipos ?? 0 }}
                                    </span>
                                </td>
                                <td>
                                    <span class="premio-text">
                                        {{ $torneo->premio ?? '-' }}
                                    </span>
                                </td>
                                <td class="col-acciones">
                                    <a href="{{ route('usuario.listaTorneosShow', $torneo->id) }}" class="btn-ver">
                                        Ver Más
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">🏆</div>
                    <h3>No hay torneos disponibles</h3>
                    <p>Por el momento no hay torneos registrados en el sistema</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Animación de entrada escalonada para las stats
    $('.stat-card').each(function(index) {
        $(this).css({
            'animation-delay': (index * 0.1) + 's',
            'animation': 'fadeInUp 0.6s ease forwards'
        });
    });
});
</script>
@endsection