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
        body{
            font-family: "Play", sans-serif;
            font-optical-sizing: auto;
            background-image: url("{{ asset('img/2713.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            background-color: #1B1F23;
            padding: 0 20px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        }

        .logo-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(45deg, #00ff88, #00ccff);
            border-radius: 4px;
            display: flex;
            align-items: center;
            align-items: center;
            font-weight: bold;
            font-size: 14px;
            color: #000;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 200px;
        }
        .nav-menu2 {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 200px;
        }

        .nav-menu li a {
            color: #ccc;
            text-decoration: none;
            font-size: 20px;
            padding:  24px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-menu2 li a {
            color: #ccc;
            text-decoration: none;
            font-size: 13px;
            padding:  10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-menu li a:hover {
            color: yellow;
            background-color: rgba(255,255,255,0.1);
        }

        .nav-menu2 li a:hover {
            color: green;
            background-color: rgba(255,255,255,0.1);
        }

        .container-principal{
            background-color: #000;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .card-body {
            background-color: #1a1a1a !important;
        }

        .list-group-item {
            background-color: #1a1a1a !important;
            color: #fff !important;
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
            transition: color 0.3s ease;
        }

        .search-icon:hover, .user-icon:hover {
            color: white;
        }

        .search-icon svg, .user-icon svg {
            width: 100%;
            height: 100%;
            fill: currentColor;
        }

        .top-news {
            background-color: #1a1a1a;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border-top: 1px solid #333;
            background-color: #333;
            padding: 1px 0; /* Reduce el padding vertical para hacer la barra más delgada */
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .navbar-left {
                gap: 20px;
            }
            
        }
    </style>
</head>

<body>
   <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('welcome') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                MALAGA GARCIA ROVIRA PLAY
            </a>
            <div class="container">
                <div class="center">
                    <ul class="nav-menu">
                        <li><a href="#">TORNEOS</a></li>
                        <li><a href="{{ route('usuario.listaEquipos') }}">EQUIPOS</a></li>
                        <li><a href="{{ route('usuario.listaJugadores') }}">JUGADORES</a></li>
                        <li><a href="#">PARTIDOS</a></li>
                    </ul>
                </div>
            </div>
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
            <div class="center">
            <ul class="nav-menu2">
                <li><a href="#">FAVORITOS</a></li>
                <li><a href="#">FUTBOL</a></li>
                <li><a href="#">FUTBOL-5</a></li>
                <li><a href="#">FUTBOL-8</a></li>
                <li><a href="#">MICRO-FUTBOL</a></li>
            </ul>
            </div>
        </div>
    </div>

    <div class="row">
      <!-- Contenedor Ubicaciones -->
<div class="col-md-3 mb-4">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-dark text-white text-center">
      <h5 class="mb-0">Ubicaciones</h5>
    </div>
    <div class="card-body">
      <div class="accordion" id="accordionMunicipios">
  @foreach ($municipios as $municipio)
    <div class="accordion-item bg-dark border-0">
      <h2 class="accordion-header" id="heading{{ $municipio->id }}">
        <button class="accordion-button collapsed bg-dark text-white"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $municipio->id }}"
                aria-expanded="false"
                aria-controls="collapse{{ $municipio->id }}">
          {{ $municipio->nombre }}
        </button>
      </h2>

      <div id="collapse{{ $municipio->id }}"
           class="accordion-collapse collapse"
           aria-labelledby="heading{{ $municipio->id }}"
           data-bs-parent="#accordionMunicipios">
        <div class="accordion-body">

          <!-- ⚽ Canchas -->
          <div class="mb-2">
            <button class="btn btn-sm w-100 text-start text-white bg-secondary"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#canchas{{ $municipio->id }}"
                    aria-expanded="false"
                    aria-controls="canchas{{ $municipio->id }}">
              ⚽ Canchas
            </button>
            <div class="collapse mt-2" id="canchas{{ $municipio->id }}">
              <ul class="list-unstyled ps-3">
                @forelse ($municipio->canchas as $cancha)
                  <li>
                    <a href="{{ url('/cancha/' . $cancha->id) }}" class="text-white text-decoration-underline">
                      {{ $cancha->nombre }}
                    </a>
                  </li>
                @empty
                  <li class="text-white"><em>No hay canchas por ahora :/ .</em></li>
                @endforelse
              </ul>
            </div>
          </div>

          <!-- 👥 Equipos -->
          <div class="mb-2">
            <button class="btn btn-sm w-100 text-start text-white bg-secondary"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#equipos{{ $municipio->id }}"
                    aria-expanded="false"
                    aria-controls="equipos{{ $municipio->id }}">
              👥 Equipos
            </button>
            <div class="collapse mt-2" id="equipos{{ $municipio->id }}">
              <ul class="list-unstyled ps-3">
                @forelse ($municipio->equipos as $equipo)
                  <li>
                    <a href="{{ url('/equipo/' . $equipo->id) }}" class="text-white text-decoration-underline">
                      {{ $equipo->nombre }}
                    </a>
                  </li>
                @empty
                  <li class="text-white"><em>No hay equipos por ahora :( .</em></li>
                @endforelse
              </ul>
            </div>
          </div>

          <!-- 📅 Torneos -->
          <div class="mb-2">
            <button class="btn btn-sm w-100 text-start text-white bg-secondary"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#torneos{{ $municipio->id }}"
                    aria-expanded="false"
                    aria-controls="torneos{{ $municipio->id }}">
              📅 Torneos
            </button>
            <div class="collapse mt-2" id="torneos{{ $municipio->id }}">
              <ul class="list-unstyled ps-3">
                @forelse ($municipio->canchas as $cancha)
                  <li>
                    <a href="{{ url('/cancha/' . $cancha->id) }}" class="text-white text-decoration-underline">
                      {{ $cancha->nombre }}
                    </a>
                  </li>
                @empty
                  <li class="text-white"><em>No hay torneos por ahora :) .</em></li>
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


      <!-- Contenedor Imágenes -->
      <div class="col-md-9 mb-4">
        <div class="card shadow-lg border-0">
          <div class="card-header bg-dark text-white text-center">
            <h5 class="mb-0">Accesos Rapidos</h5>
          </div>
          <div class="card-body text-center">
            <div class="row g-2">
              <div class="col-6">
                <img src="https://via.placeholder.com/150" class="img-fluid rounded" alt="Imagen 1">
              </div>
              <div class="col-6">
                <img src="https://via.placeholder.com/150" class="img-fluid rounded" alt="Imagen 2">
              </div>
              <div class="col-6">
                <img src="https://via.placeholder.com/150" class="img-fluid rounded" alt="Imagen 3">
              </div>
              <div class="col-6">
                <img src="https://via.placeholder.com/150" class="img-fluid rounded" alt="Imagen 4">
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