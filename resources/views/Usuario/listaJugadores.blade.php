@extends('layouts.app')

@section('title')
Jugadores | MGR PLAY
@endsection

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
        --gris-oscuro: #1a1f24;
        --gris-medio: #2a2e33;
        --gris-claro: #3a3e43;
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
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-20px) translateX(20px); }
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        padding: 12px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: var(--blanco);
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .logo img {
        height: 50px;
        margin-right: 15px;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        color: var(--verde-neon);
        transform: scale(1.03);
    }

    .logo:hover img {
        transform: rotate(-5deg) scale(1.05);
    }

    .nav-menu {
        display: flex;
        list-style: none;
        gap: 20px;
        margin: 0;
        padding: 0;
    }

    .nav-menu li a {
        text-decoration: none;
        color: #ddd;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .nav-menu li a:hover {
        color: var(--verde-neon);
        background-color: rgba(0, 255, 136, 0.1);
    }

    .navbar-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .icon-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--blanco);
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .icon-btn svg {
        width: 24px;
        height: 24px;
        transition: transform 0.3s ease;
    }

    .icon-btn:hover {
        color: var(--verde-neon);
        background-color: rgba(0, 255, 136, 0.1);
    }

    .icon-btn:hover svg {
        transform: scale(1.15);
    }

    .navbar-right > a:not(.icon-btn) {
        color: var(--blanco);
        text-decoration: none;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .navbar-right > a:not(.icon-btn):hover {
        color: var(--verde-neon);
        background-color: rgba(0, 255, 136, 0.1);
    }

    /* ==== CONTENEDOR PRINCIPAL ==== */
    .jugadores-container {
        max-width: 1600px;
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
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 255, 136, 0.15) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
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

    /* ==== CARD CONTENEDOR ==== */
    .content-card {
        background: linear-gradient(145deg, rgba(27, 31, 35, 0.95) 0%, rgba(37, 42, 47, 0.95) 100%);
        border: 2px solid rgba(0, 255, 136, 0.2);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        animation: slideInRight 0.6s ease forwards;
    }

    /* ==== FILTROS ==== */
    .filter-section {
        margin-bottom: 30px;
    }

    .filter-title {
        color: var(--verde-neon);
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-label {
        color: var(--verde-neon);
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: block;
    }

    .form-control,
    .form-select {
        background-color: rgba(16, 19, 23, 0.9);
        border: 2px solid rgba(0, 255, 136, 0.3);
        border-radius: 12px;
        color: #fff;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: rgba(21, 25, 29, 0.95);
        border-color: var(--verde-neon);
        box-shadow: 0 0 0 0.2rem rgba(0, 255, 136, 0.25);
        color: #fff;
    }

    .form-control::placeholder {
        color: #888;
    }

    .input-group-text {
        background: linear-gradient(135deg, var(--verde-neon) 0%, #00cc6a 100%);
        color: #0f0f0f;
        border: none;
        font-weight: 700;
        border-radius: 12px 0 0 12px;
        font-size: 1.1rem;
    }

    .input-group .form-control {
        border-radius: 0 12px 12px 0;
    }

    /* ==== BOTONES ==== */
    .btn-buscar,
    .btn-limpiar {
        border: none;
        padding: 12px 28px;
        border-radius: 25px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.28s ease;
        cursor: pointer;
        font-size: 0.95rem;
    }

    .btn-buscar {
        background: linear-gradient(135deg, var(--verde-neon) 0%, #00cc6a 100%);
        color: #0f0f0f;
        box-shadow: 0 4px 8px rgba(0, 255, 136, 0.3);
    }

    .btn-buscar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #00cc6a 0%, var(--verde-neon) 100%);
        box-shadow: 0 6px 14px rgba(0, 255, 136, 0.5);
        color: #0f0f0f;
    }

    .btn-limpiar {
        background: linear-gradient(135deg, rgba(42, 46, 51, 0.9) 0%, rgba(26, 31, 36, 0.9) 100%);
        color: var(--verde-neon);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(0, 255, 136, 0.3);
    }

    .btn-limpiar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, rgba(26, 31, 36, 0.9) 0%, rgba(42, 46, 51, 0.9) 100%);
        box-shadow: 0 6px 14px rgba(0, 255, 136, 0.4);
        color: var(--verde-neon);
        border-color: var(--verde-neon);
    }

    /* ==== TABLA ==== */
    .table-container {
        background: linear-gradient(145deg, rgba(37, 42, 47, 0.9) 0%, rgba(27, 31, 35, 0.9) 100%);
        border: 2px solid rgba(0, 255, 136, 0.2);
        border-radius: 15px;
        padding: 20px;
        overflow-x: auto;
        margin-top: 30px;
    }

    .table-custom {
        width: 100%;
        margin: 0;
        color: #fff;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead {
        background: linear-gradient(135deg, rgba(42, 46, 51, 0.95) 0%, rgba(27, 31, 35, 0.95) 100%);
    }

    .table-custom thead th {
        color: var(--verde-neon) !important;
        font-weight: 700;
        text-transform: uppercase;
        padding: 18px 15px;
        border-bottom: 2px solid var(--verde-neon);
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-align: center;
    }

    .table-custom tbody tr {
        background-color: rgba(30, 34, 39, 0.8);
        transition: all 0.3s ease;
    }

    .table-custom tbody tr:nth-of-type(even) {
        background-color: rgba(35, 40, 46, 0.8);
    }

    .table-custom tbody tr:hover {
        background-color: rgba(46, 53, 61, 0.9);
        transform: scale(1.005);
        box-shadow: 0 4px 12px rgba(0, 255, 136, 0.15);
    }

    .table-custom tbody td {
        padding: 16px 15px;
        border-bottom: 1px solid rgba(47, 52, 58, 0.8);
        color: #fff;
        font-weight: 500;
        vertical-align: middle;
        text-align: center;
    }

    .table-custom tbody td b {
        color: var(--verde-neon);
        font-weight: 700;
    }

    /* ==== BADGES ==== */
    .badge-estado {
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-activo {
        background: linear-gradient(135deg, var(--verde-neon) 0%, #00cc6a 100%);
        color: #0f0f0f;
        box-shadow: 0 2px 6px rgba(0, 255, 136, 0.3);
    }

    .badge-inactivo {
        background: linear-gradient(135deg, #ff5555 0%, #ff8888 100%);
        color: #fff;
        box-shadow: 0 2px 6px rgba(255, 85, 85, 0.3);
    }

    /* ==== ESTADO VACÍO ==== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state i {
        font-size: 4rem;
        color: rgba(0, 255, 136, 0.3);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--verde-neon);
        margin-bottom: 10px;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: #888;
        font-size: 1rem;
    }

    /* ==== PAGINACIÓN ==== */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 255, 136, 0.2);
    }

    .pagination .page-link {
        background-color: rgba(27, 31, 35, 0.9);
        border: 1px solid rgba(0, 255, 136, 0.3);
        color: var(--verde-neon);
        margin: 0 3px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background-color: rgba(0, 255, 136, 0.1);
        border-color: var(--verde-neon);
        color: var(--verde-neon);
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--verde-neon) 0%, #00cc6a 100%);
        color: #0f0f0f;
        border-color: var(--verde-neon);
        font-weight: bold;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

        .navbar-left {
            flex-direction: column;
            gap: 15px;
        }

        .nav-menu {
            flex-direction: column;
            gap: 10px;
            width: 100%;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 2rem;
        }

        .hero-section p {
            font-size: 1rem;
        }

        .content-card {
            padding: 20px;
        }

        .table-container {
            border-radius: 12px;
            padding: 15px;
        }

        .table-custom {
            font-size: 0.85rem;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 12px 8px;
            font-size: 0.75rem;
        }
    }
</style>

<div class="jugadores-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <h1>🎽 Jugadores Registrados</h1>
        <p>Consulta la información de los jugadores registrados en el sistema</p>
    </div>

    <!-- Contenido Principal -->
    <div class="content-card">
        <!-- Filtros -->
        <div class="filter-section">
            <div class="filter-title">
                <i class="fas fa-filter"></i>
                Filtros de Búsqueda
            </div>
            <form method="GET" action="{{ route('usuario.listaJugadores') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">
                        <i class="fas fa-search me-1"></i>Nombre
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            🔍
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Buscar jugador..."
                               value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt me-1"></i>Posición
                    </label>
                    <select name="posicion" class="form-select">
                        <option value="">-- Todas las posiciones --</option>
                        <option value="Portero" {{ request('posicion') == 'Portero' ? 'selected' : '' }}>Portero</option>
                        <option value="defensa central" {{ request('posicion') == 'defensa central' ? 'selected' : '' }}>Defensa central</option>
                        <option value="lateral izquierdo" {{ request('posicion') == 'lateral izquierdo' ? 'selected' : '' }}>Lateral izquierdo</option>
                        <option value="lateral derecho" {{ request('posicion') == 'lateral derecho' ? 'selected' : '' }}>Lateral derecho</option>
                        <option value="Mediocentro" {{ request('posicion') == 'Mediocentro' ? 'selected' : '' }}>Mediocentro</option>
                        <option value="extremo izquierdo" {{ request('posicion') == 'extremo izquierdo' ? 'selected' : '' }}>Extremo izquierdo</option>
                        <option value="extremo derecho" {{ request('posicion') == 'extremo derecho' ? 'selected' : '' }}>Extremo derecho</option>
                        <option value="delantero centro" {{ request('posicion') == 'delantero centro' ? 'selected' : '' }}>Delantero centro</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        <i class="fas fa-shield-alt me-1"></i>Equipo
                    </label>
                    <select name="idEquipo" class="form-select">
                        <option value="">-- Todos los equipos --</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ request('idEquipo') == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        <i class="fas fa-city me-1"></i>Municipio
                    </label>
                    <select name="idMunicipio" class="form-select">
                        <option value="">-- Todos los municipios --</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id }}" {{ request('idMunicipio') == $municipio->id ? 'selected' : '' }}>
                                {{ $municipio->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex gap-3 justify-content-end">
                    <button type="submit" class="btn-buscar">
                        <i class="fas fa-search me-2"></i>Buscar
                    </button>
                    <a href="{{ route('usuario.listaJugadores') }}" class="btn-limpiar">
                        <i class="fas fa-eraser me-2"></i>Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Tabla -->
        <div class="table-container">
            @if($jugadores->count() > 0)
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Posición</th>
                            <th>F. Nacimiento</th>
                            <th>Altura</th>
                            <th>Peso</th>
                            <th>Equipo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jugadores as $jugador)
                            <tr>
                                <td><b>{{ $jugador->nombre }}</b></td>
                                <td>{{ $jugador->apellido }}</td>
                                <td>{{ ucfirst($jugador->posicion) }}</td>
                                <td>{{ \Carbon\Carbon::parse($jugador->fechaNacimiento)->format('d/m/Y') }}</td>
                                <td>{{ number_format($jugador->altura, 2) }} m</td>
                                <td>{{ number_format($jugador->peso, 2) }} kg</td>
                                <td>{{ $jugador->equipos->nombre ?? 'Sin equipo' }}</td>
                                <td>
                                    <span class="badge-estado {{ $jugador->estado === 'activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                        {{ ucfirst($jugador->estado) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(request('per_page') !== 'all')
                    <div class="pagination-container">
                        {{ $jugadores->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-user-slash"></i>
                    <h3>No hay jugadores registrados</h3>
                    <p>No se encontraron jugadores con los filtros aplicados</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection