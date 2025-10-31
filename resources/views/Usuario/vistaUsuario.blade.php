<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | MGR PLAY</title>
    <link rel="icon" href="{{ asset('img/balonPestaña.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Play", sans-serif;
            font-optical-sizing: auto;
            background-image: url("{{ asset('img/2713.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }

        /* Overlay oscuro sobre el fondo */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

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

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo img {
            height: 50px;
            margin-right: 30px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 30px;
            margin: 0;
        }

        .nav-menu li a {
            color: #ccc;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: block;
        }

        .nav-menu li a:hover {
            color: #ffd700;
            background-color: rgba(255,255,255,0.1);
            transform: translateY(-2px);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-icon, .user-icon {
            width: 24px;
            height: 24px;
            background: none;
            border: none;
            color: #ccc;
            cursor: pointer;
            padding: 0;
            transition: all 0.3s ease;
        }

        .search-icon:hover, .user-icon:hover {
            color: white;
            transform: scale(1.2);
        }

        .search-icon svg, .user-icon svg {
            width: 100%;
            height: 100%;
            fill: currentColor;
        }

        .top-news {
            background-color: #2a2e33;
            border-bottom: 2px solid #ffd700;
            padding: 8px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .nav-menu2 {
            display: flex;
            align-items: center;
            justify-content: center;
            list-style: none;
            gap: 40px;
            margin: 0;
            padding: 0;
        }

        .nav-menu2 li a {
            color: #ccc;
            text-decoration: none;
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: block;
            font-weight: 500;
        }

        .nav-menu2 li a:hover {
            color: #00ff88;
            background-color: rgba(255,255,255,0.1);
        }

        .main-content {
            padding: 30px 20px;
        }

        .card {
            background-color: rgba(26, 31, 36, 0.95);
            border: 1px solid #2a2e33;
            border-radius: 8px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: linear-gradient(135deg, #1a1f24 0%, #2a2e33 100%);
            border-bottom: 2px solid #ffd700;
            padding: 15px;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .card-body {
            background-color: rgba(26, 31, 36, 0.95);
            padding: 20px;
        }

        .accordion-item {
            background-color: #1a1f24;
            border: 1px solid #2a2e33;
            margin-bottom: 8px;
            border-radius: 6px;
            overflow: hidden;
        }

        .accordion-button {
            background-color: #2a2e33;
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px 16px;
        }

        .accordion-button:not(.collapsed) {
            background-color: #3a3e43;
            color: #ffd700;
        }

        .accordion-button:focus {
            box-shadow: none;
            border: none;
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
        }

        .accordion-body {
            background-color: #1a1f24;
            padding: 15px;
        }

        .btn-secondary {
            background-color: #3a3e43;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #4a4e53;
            transform: translateX(5px);
        }

        .list-unstyled li {
            padding: 6px 0;
        }

        .list-unstyled a {
            color: #00ccff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .list-unstyled a:hover {
            color: #00ff88;
            text-decoration: underline;
            padding-left: 5px;
        }

        .list-unstyled em {
            color: #999;
            font-size: 0.9em;
        }

        .quick-access-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .quick-access-img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 255, 136, 0.3);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .nav-menu {
                gap: 15px;
            }
            
            .nav-menu li a {
                font-size: 14px;
                padding: 6px 12px;
            }

            .logo {
                font-size: 14px;
            }

            .logo img {
                height: 40px;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .navbar-left {
                gap: 10px;
            }

            .logo {
                font-size: 12px;
            }

            .nav-menu2 {
                gap: 15px;
                flex-wrap: wrap;
            }

            .nav-menu2 li a {
                font-size: 11px;
                padding: 4px 8px;
            }

            .main-content {
                padding: 15px 10px;
            }
        }

        /* Scrollbar personalizada */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1f24;
        }

        ::-webkit-scrollbar-thumb {
            background: #3a3e43;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4a4e53;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('welcome') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
                MALAGA GARCIA ROVIRA PLAY
            </a>
            <ul class="nav-menu">
                <li><a href="#">TORNEOS</a></li>
                <li><a href="{{ route('usuario.listaEquipos') }}">EQUIPOS</a></li>
                <li><a href="{{ route('usuario.listaJugadores') }}">JUGADORES</a></li>
                <li><a href="#">PARTIDOS</a></li>
            </ul>
        </div>
        
        <div class="navbar-right">
            <button class="search-icon" title="Buscar">
                <svg viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </button>
            
            <button class="user-icon" title="Usuario">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                </svg>
            </button>
        </div>
    </nav>
    
    <div class="top-news">
        <div class="container">
            <ul class="nav-menu2">
                <li><a href="#">⭐ FAVORITOS</a></li>
                <li><a href="#">⚽ FUTBOL</a></li>
                <li><a href="#">🥅 FUTBOL-5</a></li>
                <li><a href="#">🏃 FUTBOL-8</a></li>
                <li><a href="#">🎯 MICRO-FUTBOL</a></li>
            </ul>
        </div>
    </div>

    <div class="container main-content">
        <div class="row">
            <!-- Contenedor Ubicaciones -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-header text-white text-center">
                        <h5 class="mb-0">📍 Ubicaciones</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionMunicipios">
                            @foreach ($municipios as $municipio)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $municipio->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $municipio->id }}" aria-expanded="false" aria-controls="collapse{{ $municipio->id }}">
                                        {{ $municipio->nombre }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $municipio->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $municipio->id }}" data-bs-parent="#accordionMunicipios">
                                    <div class="accordion-body">
                                        <!-- Canchas -->
                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-secondary w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#canchas{{ $municipio->id }}" aria-expanded="false" aria-controls="canchas{{ $municipio->id }}">
                                                ⚽ Canchas
                                            </button>
                                            <div class="collapse mt-2" id="canchas{{ $municipio->id }}">
                                                <ul class="list-unstyled ps-3">
                                                    @forelse ($municipio->canchas as $cancha)
                                                    <li><a href="{{ url('/cancha/' . $cancha->id) }}">{{ $cancha->nombre }}</a></li>
                                                    @empty
                                                    <li><em>No hay canchas por ahora :/</em></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <!-- Equipos -->
                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-secondary w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#equipos{{ $municipio->id }}" aria-expanded="false" aria-controls="equipos{{ $municipio->id }}">
                                                👥 Equipos
                                            </button>
                                            <div class="collapse mt-2" id="equipos{{ $municipio->id }}">
                                                <ul class="list-unstyled ps-3">
                                                    @forelse ($municipio->equipos as $equipo)
                                                    <li><a href="{{ url('/equipo/' . $equipo->id) }}">{{ $equipo->nombre }}</a></li>
                                                    @empty
                                                    <li><em>No hay equipos por ahora :(</em></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <!-- Torneos -->
                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-secondary w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#torneos{{ $municipio->id }}" aria-expanded="false" aria-controls="torneos{{ $municipio->id }}">
                                                📅 Torneos
                                            </button>
                                            <div class="collapse mt-2" id="torneos{{ $municipio->id }}">
                                                <ul class="list-unstyled ps-3">
                                                    @forelse ($municipio->torneos as $torneo)
                                                    <li><a href="{{ url('/torneo/' . $torneo->id) }}">{{ $torneo->nombre }}</a></li>
                                                    @empty
                                                    <li><em>No hay torneos por ahora :)</em></li>
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

            <!-- Contenedor Accesos Rápidos -->
            <div class="col-lg-9 col-md-8 mb-4">
                <div class="card shadow-lg">
                    <div class="card-header text-white text-center">
                        <h5 class="mb-0">🚀 Accesos Rápidos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                              <div class="card shadow-sm border-left-primary">
                                  <div class="card-body text-center">
                                    <div class="background-color text-white p-2 rounded">
                                      <h5>Jugadores Totales</h5>
                                    </div>
                                      <h3 class="text-success">{{ $accesosRapidos['totalJugadores'] }}</h3>
                                  </div>
                              </div>
                            <div class="card shadow-sm border-left-primary">
                                  <div class="card-body text-center">
                                    <div class="background-color text-white p-2 rounded">
                                      <h5>Equipos Totales</h5>
                                    </div>
                                      <h3 class="text-success">{{ $accesosRapidos['totalEquipos'] }}</h3>
                                  </div>
                            </div>
                            <div class="card shadow-sm border-left-primary">
                                  <div class="card-body text-center">
                                    <div class="background-color text-white p-2 rounded">
                                      <h5>Canchas Totales</h5>
                                    </div>
                                      <h3 class="text-success">{{ $accesosRapidos['totalCanchas'] }}</h3>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>