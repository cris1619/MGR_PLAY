<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | MGR PLAY</title>
    <link rel="icon" href="{{ asset('img/balonPestaña.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --verde-neon: #00ff88;
            --gris-oscuro: #1a1f24;
            --gris-medio: #2a2e33;
            --gris-claro: #3a3e43;
            --blanco: #f2f2f2;
            --verde-mgr: #268340;
            --amarillo-mgr: #f5c02b;
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
            position: relative;
            color: var(--blanco);
            min-height: 100vh;
        }

        /* NAVBAR */
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

        /* ICONOS */
        .icon-btn {
            background: none;
            border: none;
            color: var(--blanco);
            cursor: pointer;
            transition: transform 0.3s ease, color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .icon-btn svg {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
        }

        .icon-btn span {
            white-space: nowrap;
        }

        .icon-btn:hover {
            transform: translateY(-2px);
            color: var(--verde-neon);
            background-color: rgba(0, 255, 136, 0.1);
        }

        /* TARJETAS Y CONTENIDO */
        .main-content {
            padding: 40px 20px;
        }

        .card {
            background-color: rgba(20, 20, 20, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(6px);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px rgba(0, 255, 136, 0.2);
        }

        .card-header {
            background: linear-gradient(90deg, #0f0f0f, #1a1f24);
            border-bottom: 2px solid var(--verde-neon);
            text-align: center;
            color: var(--verde-neon);
            font-weight: bold;
            font-size: 1.2rem;
            padding: 15px;
        }

        .accordion-button {
            background-color: var(--gris-medio);
            color: var(--blanco);
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--gris-claro);
            color: var(--verde-neon);
        }

        .accordion-body {
            background-color: var(--gris-oscuro);
        }

        .btn-secondary {
            background-color: var(--gris-claro);
            border: none;
            color: var(--blanco);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--verde-neon);
            color: #000;
        }

        .list-unstyled a {
            color: #00ccff;
            text-decoration: none;
            transition: color 0.3s ease, padding-left 0.3s ease;
        }

        .list-unstyled a:hover {
            color: var(--verde-neon);
            padding-left: 5px;
        }

        /* Accesos Rápidos */
        .quick-card {
            background: linear-gradient(145deg, #1b1f1d 0%, #252b27 100%);
            border: 2px solid rgba(0, 255, 136, 0.3);
            border-radius: 15px;
            transition: all 0.4s ease;
            padding: 25px;
            position: relative;
            overflow: hidden;
        }

        .quick-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #268340, #f5c02b);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .quick-card:hover::before {
            opacity: 1;
        }

        .quick-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 255, 136, 0.3);
            border-color: var(--verde-neon);
        }

        .quick-card h5 {
            color: #e5e5e5;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .quick-card h3 {
            color: var(--amarillo-mgr);
            font-weight: bold;
            font-size: 2.5rem;
            margin: 0;
            text-shadow: 0 0 10px rgba(245, 192, 43, 0.3);
        }

        /* SECCIÓN DE TÍTULOS */
        .section-title {
            color: var(--amarillo-mgr);
            font-size: 1.8rem;
            font-weight: 700;
            margin: 30px 0 25px 0;
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
            background: linear-gradient(90deg, transparent, #268340, transparent);
        }

        /* TARJETAS DE PARTIDOS Y TORNEOS */
        .admin-card {
            background: linear-gradient(145deg, #1b1f1d 0%, #252b27 100%);
            border: 2px solid #2a2e2a;
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
            background: linear-gradient(90deg, #268340, #f5c02b);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .admin-card:hover::before {
            opacity: 1;
        }

        .admin-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(245, 192, 43, 0.2);
            border-color: #268340;
        }

        .admin-card .card-body {
            padding: 25px;
        }

        .admin-card .card-title {
            color: #faf8f5;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .admin-card .card-text {
            color: #e5e5e5;
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
            color: var(--amarillo-mgr);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* BOTONES */
        .btn-admin {
            background: linear-gradient(135deg, #268340 0%, #34a853 100%);
            color: #faf8f5;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(38, 131, 64, 0.3);
        }

        .btn-admin:hover {
            background: linear-gradient(135deg, #f5c02b 0%, #ffdc66 100%);
            color: #268340;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(245, 192, 43, 0.4);
        }

        /* ANIMACIONES */
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

        /* FOOTER */
        footer {
            background: linear-gradient(90deg, #0f0f0f, #1a1f24);
            border-top: 2px solid var(--verde-neon);
            margin-top: 50px;
        }

        footer div {
            color: #ccc;
            font-size: 0.9rem;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .logo img {
                height: 40px;
            }

            .main-content {
                padding: 20px 10px;
            }

            .section-title {
                font-size: 1.4rem;
            }

            .quick-card h3 {
                font-size: 2rem;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gris-claro);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--verde-neon);
        }
    </style>
</head>
<body>
    <nav class="navbar d-flex justify-content-between align-items-center">
        <div class="navbar-left">
            <a href="{{ route('welcome') }}" class="logo">
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

    <div class="container main-content">
        <div class="row">
            <!-- Lado izquierdo -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">📍 Ubicaciones</div>
                    <div class="card-body">
                        <div class="accordion" id="accordionMunicipios">
                            @foreach ($municipios as $municipio)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $municipio->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $municipio->id }}">
                                        {{ $municipio->nombre}}
                                    </button>
                                </h2>
                                <div id="collapse{{ $municipio->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionMunicipios">
                                    <div class="accordion-body">
                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-secondary w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#canchas{{ $municipio->id }}">
                                                ⚽ Canchas
                                            </button>
                                            <div class="collapse mt-2" id="canchas{{ $municipio->id }}">
                                                <ul class="list-unstyled ps-3">
                                                    @forelse ($municipio->canchas as $cancha)
                                                    <li><a href="{{ url('/cancha/' . $cancha->id) }}">{{ $cancha->nombre }}</a></li>
                                                    @empty
                                                    <li><em>No hay canchas por ahora.</em></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-secondary w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#equipos{{ $municipio->id }}">
                                                👥 Equipos
                                            </button>
                                            <div class="collapse mt-2" id="equipos{{ $municipio->id }}">
                                                <ul class="list-unstyled ps-3">
                                                    @forelse ($municipio->equipos as $equipo)
                                                    <li><a href="{{ url('/equipo/' . $equipo->id) }}">{{ $equipo->nombre }}</a></li>
                                                    @empty
                                                    <li><em>No hay equipos por ahora.</em></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>

                                        <div>
                                            <button class="btn btn-sm btn-secondary w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#torneos{{ $municipio->id }}">
                                                📅 Torneos
                                            </button>
                                            <div class="collapse mt-2" id="torneos{{ $municipio->id }}">
                                                <ul class="list-unstyled ps-3">
                                                    @forelse ($municipio->torneos as $torneo)
                                                    <li><a href="{{ url('/torneo/' . $torneo->id) }}">{{ $torneo->nombre }}</a></li>
                                                    @empty
                                                    <li><em>No hay torneos por ahora.</em></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accesos Rápidos -->
            <div class="col-lg-9 col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">🚀 Estadísticas Generales</div>
                    <div class="card-body">
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <div class="quick-card text-center fade-in-up">
                                    <h5>Jugadores Totales</h5>
                                    <h3>{{ $accesosRapidos['totalJugadores'] }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="quick-card text-center fade-in-up">
                                    <h5>Equipos Totales</h5>
                                    <h3>{{ $accesosRapidos['totalEquipos'] }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="quick-card text-center fade-in-up">
                                    <h5>Canchas Totales</h5>
                                    <h3>{{ $accesosRapidos['totalCanchas'] }}</h3>
                                </div>
                            </div>
                        </div>

                        <h2 class="section-title">📅 Próximos Partidos</h2>
                        <div class="row justify-content-center g-4 mb-4">
                            @forelse( $partidosProximos ?? [] as $partido )
                                <div class="col-lg-4 col-md-6">
                                    <div class="card admin-card shadow-lg fade-in-up">
                                        <div class="card-body">
                                            <h5 class="card-title">
    {{ $partido->equipoLocal->nombre ?? 'Equipo Local' }}
    vs
    {{ $partido->equipoVisitante->nombre ?? 'Equipo Visitante' }}
</h5>
                                            <p class="card-text">
                                                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($partido->fecha)->format('d M Y') ?? 'Desconocida' }}<br>
                                                <strong>Hora:</strong> {{ \Carbon\Carbon::parse($partido->hora)->format('h:i A') ?? 'Desconocida' }}<br>
                                                <strong>Ubicación:</strong> {{ $partido->cancha->municipio->nombre ?? 'Desconocida' }}
                                            </p>
                                            <a href="{{ route('partidos.show', $partido->id) }}" class="btn btn-admin">
                                                Ver más →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="card admin-card shadow-lg fade-in-up">
                                        <div class="card-body text-center">
                                            <div class="card-icon">⚠️</div>
                                            <h5 class="card-title">No hay partidos próximos</h5>
                                            <p class="card-text">
                                                Por ahora no hay partidos programados. Revisa más tarde.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <h2 class="section-title">🏆 Torneos Disponibles</h2>
                        <div class="row justify-content-center g-4">
                            @forelse( $torneos ?? [] as $torneo )
                                <div class="col-lg-4 col-md-6">
                                    <div class="card admin-card shadow-lg fade-in-up">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $torneo->nombre }}</h5>
                                            <p class="card-text">
                                                <strong>Ubicación:</strong> {{ $torneo->municipio->nombre ?? 'Desconocida' }}<br>
                                                <strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($torneo->fecha_inicio)->format('d M Y') ?? 'Desconocida' }}<br>
                                                <strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($torneo->fecha_fin)->format('d M Y') ?? 'Desconocida' }}
                                            </p>
                                            <a href="{{ route('usuario.listaTorneosShow', $torneo->id) }}" class="btn btn-admin">
                                                Ver más →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="card admin-card shadow-lg fade-in-up">
                                        <div class="card-body text-center">
                                            <div class="card-icon">⚠️</div>
                                            <h5 class="card-title">No hay torneos disponibles</h5>
                                            <p class="card-text">
                                                Por ahora no hay torneos programados. Revisa más tarde o crea uno desde el panel de administración.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <div class="p-4 text-center text-white">
        Realizado por - @Cristian Fernando Solano Villamizar - <br>
        @Juan David Carrillo Mojica <br>
        2025
    </div>
</footer>
</html>