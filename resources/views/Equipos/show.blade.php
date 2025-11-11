@extends('layouts.app')

@section('title')
{{ $equipo->nombre }} | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            ⚽ {{ strtoupper($equipo->nombre) }}
        </a>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('usuario.listaEquipos') }}" class="btn btn-outline-light">← Volver a Equipos</a>
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary">🏠 Inicio</a>
    </div>
</nav>
@endsection

@section('content')
<style>
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

    .hero-section {
        background: linear-gradient(135deg, rgba(26, 31, 36, 0.98) 0%, rgba(42, 46, 51, 0.98) 100%);
        border-radius: 25px;
        padding: 50px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
        background-clip: padding-box;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 25px;
        padding: 2px;
        background: linear-gradient(135deg, #ffd700, #00ff88, #00ccff);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0.6;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.08) 0%, transparent 70%);
        animation: pulse 6s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.5; }
        50% { transform: scale(1.2) rotate(45deg); opacity: 0.8; }
    }

    .escudo-container {
        width: 200px;
        height: 200px;
        margin: 0 auto 30px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .escudo-container::before {
        content: '';
        position: absolute;
        inset: -10px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffd700, #00ff88, #00ccff, #ffd700);
        background-size: 300% 300%;
        animation: gradient-rotate 4s linear infinite;
        filter: blur(5px);
    }

    @keyframes gradient-rotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .escudo-principal {
        width: 190px;
        height: 190px;
        border-radius: 50%;
        object-fit: cover;
        border: 6px solid #1a1f24;
        position: relative;
        z-index: 1;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .escudo-principal:hover {
        transform: scale(1.1) rotate(5deg);
    }

    .equipo-nombre {
        background: linear-gradient(135deg, #ffd700 0%, #00ff88 50%, #00ccff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 3.5rem;
        text-align: center;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .info-card {
        background: linear-gradient(145deg, #1a1f24 0%, #252a30 50%, #1a1f24 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #00ff88, #00ccff, #ffd700);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 255, 136, 0.2);
        border-color: #00ff88;
    }

    .card-title {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-item {
        display: flex;
        align-items: center;
        padding: 15px;
        margin-bottom: 15px;
        background: rgba(42, 46, 51, 0.5);
        border-radius: 12px;
        border-left: 4px solid #00ccff;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(42, 46, 51, 0.8);
        border-left-color: #00ff88;
        transform: translateX(5px);
    }

    .info-label {
        color: #00ccff;
        font-weight: 600;
        font-size: 1.1rem;
        min-width: 150px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .estado-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1rem;
    }

    .estado-activo {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1a1f24;
        box-shadow: 0 5px 20px rgba(0, 255, 136, 0.4);
        animation: glow-active 2s ease-in-out infinite;
    }

    @keyframes glow-active {
        0%, 100% { box-shadow: 0 5px 20px rgba(0, 255, 136, 0.4); }
        50% { box-shadow: 0 5px 30px rgba(0, 255, 136, 0.6); }
    }

    .estado-inactivo {
        background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%);
        color: #fff;
        box-shadow: 0 5px 20px rgba(255, 68, 68, 0.4);
    }

    .section-divider {
        height: 3px;
        background: linear-gradient(90deg, transparent, #ffd700, #00ff88, #00ccff, transparent);
        margin: 40px 0;
        border-radius: 2px;
    }

    .btn-outline-light {
        border: 2px solid #fff;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
        background-color: #fff;
        color: #1a1f24;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #3a3e43 0%, #4a4e53 100%);
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #4a4e53 0%, #5a5e63 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(58, 62, 67, 0.5);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, rgba(42, 46, 51, 0.8) 0%, rgba(58, 62, 67, 0.8) 100%);
        border: 2px solid #3a3e43;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: #ffd700;
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        filter: drop-shadow(0 5px 10px rgba(255, 215, 0, 0.3));
    }

    .stat-label {
        color: #00ccff;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-value {
        color: #fff;
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffd700 0%, #00ff88 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @media (max-width: 768px) {
        .equipo-nombre {
            font-size: 2rem;
        }

        .hero-section {
            padding: 30px 20px;
        }

        .escudo-container {
            width: 150px;
            height: 150px;
        }

        .escudo-principal {
            width: 140px;
            height: 140px;
        }

        .info-label {
            min-width: 120px;
            font-size: 1rem;
        }

        .info-value {
            font-size: 1rem;
        }
    }
</style>

<div class="container mt-5 mb-5">
    <!-- Hero Section con Escudo -->
    <div class="hero-section">
        <div class="escudo-container">
            <img src="{{ asset('storage/public/escudos/' . $equipo->escudo) }}"
                 alt="Escudo {{ $equipo->nombre }}"
                 class="escudo-principal">
        </div>
        <h1 class="equipo-nombre">{{ $equipo->nombre }}</h1>
        <div class="text-center">
            <span class="estado-badge {{ $equipo->estado === 'activo' ? 'estado-activo' : 'estado-inactivo' }}">
                <span>{{ $equipo->estado === 'activo' ? '✓' : '✗' }}</span>
                <span>{{ ucfirst($equipo->estado) }}</span>
            </span>
        </div>
    </div>

    <!-- Información Principal -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="info-card">
                <h3 class="card-title">
                    <span>📋</span>
                    <span>Información General</span>
                </h3>
                
                <div class="info-item">
                    <div class="info-label">
                        <span>👤</span>
                        <span>Entrenador:</span>
                    </div>
                    <div class="info-value">{{ $equipo->entrenador }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <span>📍</span>
                        <span>Municipio:</span>
                    </div>
                    <div class="info-value">{{ $equipo->municipio->nombre ?? 'No asignado' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <span>🆔</span>
                        <span>ID Equipo:</span>
                    </div>
                    <div class="info-value">#{{ $equipo->id }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="info-card">
                <h3 class="card-title">
                    <span>📊</span>
                    <span>Estadísticas</span>
                </h3>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">⚽</div>
                        <div class="stat-label">Partidos</div>
                        <div class="stat-value">{{ $equipo->partidos_count ?? 0 }}</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-label">Jugadores</div>
                        <div class="stat-value">{{ $equipo->jugadores_count ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información Adicional -->
    <div class="section-divider"></div>

    <div class="info-card">
        <h3 class="card-title">
            <span>ℹ️</span>
            <span>Detalles Adicionales</span>
        </h3>
        
        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">
                        <span>📅</span>
                        <span>Fecha de Registro:</span>
                    </div>
                    <div class="info-value">{{ $equipo->created_at ? $equipo->created_at->format('d/m/Y') : 'No disponible' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">
                        <span>🔄</span>
                        <span>Última Actualización:</span>
                    </div>
                    <div class="info-value">{{ $equipo->updated_at ? $equipo->updated_at->format('d/m/Y H:i') : 'No disponible' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="text-center mt-5">
        <a href="{{ route('usuario.listaEquipos') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 me-3">
            ← Volver a Equipos
        </a>
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary btn-lg rounded-pill px-5">
            🏠 Ir al Inicio
        </a>
    </div>
</div>
@endsection