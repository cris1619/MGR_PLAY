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

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
            z-index: -1;
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

        /* TOP MENU */
        .top-news {
            background-color: rgba(26, 31, 36, 0.9);
            border-bottom: 2px solid var(--verde-neon);
            text-align: center;
            padding: 10px 0;
        }

        .nav-menu2 {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        .nav-menu2 li a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .nav-menu2 li a:hover {
            color: var(--verde-neon);
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
            background-color: rgba(26, 31, 36, 0.9);
            border: 1px solid rgba(0, 255, 136, 0.3);
            border-radius: 10px;
            transition: all 0.3s ease;
            padding: 20px;
        }

        .quick-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 255, 136, 0.3);
        }

        .quick-card h5 {
            color: var(--blanco);
            font-weight: bold;
        }

        .quick-card h3 {
            color: var(--verde-neon);
            font-weight: bold;
            margin-top: 10px;
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
            <button class="icon-btn" title="Buscar">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16a6.471 6.471 0 004.23-1.57l.27.28h.79l5 4.99L20.49 19l-4.99-5zM9.5 14A4.5 4.5 0 115 9.5 4.5 4.5 0 019.5 14z"/>
                </svg>
            </button>

            <button class="icon-btn" title="Usuario">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.67 0 8 1.34 8 4v3H4v-3c0-2.66 5.33-4 8-4zm0-2c-1.1 0-2-.9-2-2s.9-2 2-2 
                    2 .9 2 2-.9 2-2 2z"/>
                </svg>
            </button>
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
                    <div class="card-header">🚀 Accesos Rápidos</div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="quick-card text-center">
                                    <h5>Jugadores Totales</h5>
                                    <h3>{{ $accesosRapidos['totalJugadores'] }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="quick-card text-center">
                                    <h5>Equipos Totales</h5>
                                    <h3>{{ $accesosRapidos['totalEquipos'] }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="quick-card text-center">
                                    <h5>Canchas Totales</h5>
                                    <h3>{{ $accesosRapidos['totalCanchas'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
