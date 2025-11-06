@extends('layouts.app')

@section('title')
    Inicio | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('welcome') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
                MALAGA GARCIA ROVIRA PLAY
            </a>
        </div>
            <a href="{{ route('logout') }}">Cerrar sesión</a>
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
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
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

    .logo img {
        height: 50px;
        margin-right: 30px;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1B1F23 0%, #2a2e33 100%);
        padding: 40px 20px;
        margin-bottom: 40px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .hero-section h1 {
        color: #ffd700;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-section p {
        color: #ccc;
        font-size: 1.2rem;
        margin-bottom: 0;
    }

    /* Cards Mejoradas */
    .admin-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        transition: all 0.4s ease;
        height: 100%;
        overflow: hidden;
        position: relative;
    }

    .admin-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #00ff88, #00ccff);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .admin-card:hover::before {
        opacity: 1;
    }

    .admin-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(255, 215, 0, 0.2);
        border-color: #ffd700;
    }

    .admin-card .card-body {
        padding: 30px;
    }

    .card-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        display: inline-block;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .card-title {
        color: #ffd700;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .card-text {
        color: #aaa;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
        min-height: 60px;
    }

    /* Botones Mejorados */
    .btn-admin {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-admin:hover {
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255, 215, 0, 0.5);
        color: #000;
    }

    .btn-admin:active {
        transform: scale(0.98);
    }

    /* Botón Vista Usuario */
    .btn-usuario {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1B1F23;
        border: none;
        padding: 15px 40px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 6px 12px rgba(0, 255, 136, 0.4);
        margin-top: 30px;
    }

    .btn-usuario:hover {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        transform: scale(1.08);
        box-shadow: 0 8px 16px rgba(0, 255, 136, 0.6);
        color: #000;
    }

    /* Secciones */
    .section-title {
        color: #ffd700;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #ffd700, transparent);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 1.8rem;
        }

        .hero-section p {
            font-size: 1rem;
        }

        .card-icon {
            font-size: 2.5rem;
        }

        .card-title {
            font-size: 1.2rem;
        }

        .logo {
            font-size: 14px;
        }

        .logo img {
            height: 40px;
            margin-right: 15px;
        }
    }

    /* Animación de entrada */
    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .admin-card:nth-child(1) { animation-delay: 0.1s; }
    .admin-card:nth-child(2) { animation-delay: 0.2s; }
    .admin-card:nth-child(3) { animation-delay: 0.3s; }
    .admin-card:nth-child(4) { animation-delay: 0.4s; }
    .admin-card:nth-child(5) { animation-delay: 0.5s; }
    .admin-card:nth-child(6) { animation-delay: 0.6s; }
    .admin-card:nth-child(7) { animation-delay: 0.7s; }
</style>

<div class="container mt-4">
    <!-- Hero Section -->
    <div class="hero-section">
        <h1>🎮 Panel de Administración</h1>
        <p>Gestiona todos los aspectos de MGR PLAY desde aquí</p>
    </div>

    <!-- Primera Sección: Gestión Principal -->
    <h2 class="section-title">⚙️ Gestión Principal</h2>
    <div class="row justify-content-center g-4 mb-5">
        <div class="col-lg-4 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🏆</div>
                    <h5 class="card-title">TORNEOS</h5>
                    <p class="card-text">
                        Gestiona los torneos, organiza sedes y sigue el progreso de cada competición.
                    </p>
                    <a href="{{ route('torneos.index') }}" class="btn btn-admin">
                        Ver Torneos →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">👥</div>
                    <h5 class="card-title">EQUIPOS</h5>
                    <p class="card-text">
                        Consulta y administra los equipos participantes y toda su información.
                    </p>
                    <a href="{{ route('equipos.index') }}" class="btn btn-admin">
                        Ver Equipos →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🎽</div>
                    <h5 class="card-title">JUGADORES</h5>
                    <p class="card-text">
                        Explora los jugadores de cada equipo y gestiona sus estadísticas.
                    </p>
                    <a href="{{ route('jugadores.index') }}" class="btn btn-admin">
                        Ver Jugadores →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda Sección: Infraestructura y Logística -->
    <h2 class="section-title">🏗️ Infraestructura y Logística</h2>
    <div class="row justify-content-center g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🌍</div>
                    <h5 class="card-title">MUNICIPIOS</h5>
                    <p class="card-text">
                        Consulta los municipios donde se disputan los torneos.
                    </p>
                    <a href="{{ route('municipios.index') }}" class="btn btn-admin">
                        Ver Municipios →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🏟️</div>
                    <h5 class="card-title">CANCHAS</h5>
                    <p class="card-text">
                        Escenarios preparados para los partidos de cada torneo.
                    </p>
                    <a href="{{ route('canchas.index') }}" class="btn btn-admin">
                        Ver Canchas →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">📅</div>
                    <h5 class="card-title">PARTIDOS</h5>
                    <p class="card-text">
                        Consulta la programación de los partidos y resultados.
                    </p>
                    <a href="#" class="btn btn-admin">
                        Ver Partidos →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">⚖️</div>
                    <h5 class="card-title">ÁRBITROS</h5>
                    <p class="card-text">
                        Conoce a los árbitros encargados de dirigir los encuentros.
                    </p>
                    <a href="{{ route('Arbitros.index')}}" class="btn btn-admin">
                        Ver Árbitros →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Vista Usuario -->
    <div class="text-center mb-5">
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-usuario">
            🎯 Ir a Vista de Usuario
        </a>
    </div>
</div>

@endsection