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
/* =====================
    ESTILOS GENERALES (BASE OSCURA)
====================== */
.container.mt-4 {
    max-width: 1200px;
    margin: 30px auto;
}

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
.logo {
    display: flex; align-items: center;
    color: #E5E7EB; font-weight: 700; font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s ease;
}
.logo img { 
    height: 40px; margin-right: 12px;
    transition: all 0.3s ease;
}

/* --- ESTILOS DE FILTROS --- */
.filter-box {
    background-color: #1E2126;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    display: flex;
    gap: 20px;
    align-items: flex-end; /* Alinea botones y selects */
}
.filter-group {
    flex-grow: 1;
}
.filter-group label {
    display: block;
    color: #FACC15;
    margin-bottom: 8px;
    font-weight: 600;
    font-size: 0.95rem;
}
.filter-group select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #4B5563;
    background-color: #2a2e33;
    color: #E5E7EB;
    appearance: none; /* Elimina estilo nativo del select */
    transition: border-color 0.2s;
}
.filter-group select:focus {
    border-color: #22C55E;
    outline: none;
}
.btn-filter {
    background-color: #0EA5E9; /* Azul para el filtro */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.2s;
}
.btn-filter:hover {
    background-color: #3B82F6;
}

@media (max-width: 768px) {
    .filter-box {
        flex-direction: column;
        align-items: stretch;
    }
}

/* BOTONES (Re-implementando clases mejoradas) */
.btn-primary-mgr, .btn-secondary-mgr {
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    border: none;
    font-size: 1rem;
}
.btn-secondary-mgr {
    background-color: #374151; /* Gris oscuro */
    color: #F3F4F6; /* Blanco claro */
    border: 1px solid #4B5563;
}
.btn-secondary-mgr:hover {
    background-color: #4B5563;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
}
.btn-info-mgr { /* Estilo específico para el botón de 'Ver' */
    background-color: #0EA5E9; /* Azul vibrante */
    color: white;
    padding: 6px 15px;
    border-radius: 25px;
    font-weight: 600;
    transition: background-color 0.2s, transform 0.2s;
}
.btn-info-mgr:hover {
    background-color: #3B82F6;
    transform: translateY(-1px);
}


/* HERO Y TÍTULO */
.hero-section {
    background: linear-gradient(135deg, #1f2429, #2a3036);
    padding: 30px 20px; /* Padding ajustado */
    border-radius: 18px;
    text-align: center;
    margin-bottom: 40px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    border-top: 5px solid #FACC15; /* Detalle amarillo */
}
.hero-section h1 {
    color: #F8FAFC;
    font-weight: 800;
    font-size: 2.5rem; /* Título más grande */
    margin-bottom: 5px;
}
.hero-section p { color: #9CA3AF; font-size: 1.1rem; }

/* TÍTULO DE SECCIÓN SECUNDARIO */
.section-title {
    color: #FACC15; /* Amarillo para contraste */
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
    font-weight: 800;
    text-transform: none; /* Quitamos uppercase para mejor legibilidad */
}

/* --- ESTILOS DE LA TABLA MEJORADOS --- */
.table-responsive {
    border-radius: 15px;
    overflow-x: auto;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
}
.table {
    background-color: #1B1F23;
    color: #E5E7EB;
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}
.table th, .table td {
    padding: 15px 15px; /* Más padding para aire */
    border-bottom: 1px solid #2f3338;
}
.table th {
    background-color: #252A30;
    color: #22C55E;
    text-transform: uppercase;
    font-size: 0.9rem;
}
.table-hover tbody tr:hover {
    background-color: #2a2e33;
    transition: 0.3s;
}
.table tbody tr:last-child td {
    border-bottom: none; /* Eliminar el borde de la última fila */
}

/* MARCADOR */
.marcador {
    display: flex;
    flex-direction: column;
    gap: 4px; /* Espacio más pequeño */
    font-size: 0.95rem;
}
.marcador-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #2a2e33;
    padding: 4px 8px; /* Padding ajustado */
    border-radius: 6px;
}
.goles-badge {
    background: #22C55E; /* Fondo verde sólido */
    color: #101317; /* Texto oscuro */
    padding: 4px 10px;
    border-radius: 15px;
    font-weight: 800;
    min-width: 35px;
    text-align: center;
}

/* FASE */
.fase-badge {
    background: linear-gradient(135deg, #8B5CF6, #A78BFA);
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

/* ESTADO */
.badge {
    padding: 6px 12px;
    border-radius: 18px;
    font-weight: 700;
    font-size: 0.9rem;
    color: #101317; /* Texto oscuro */
}
.bg-success { background-color: #10B981 !important; } /* Jugado */
.bg-danger { background-color: #F59E0B !important; } /* Pendiente (Usamos Naranja) */

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-section h1 { font-size: 2rem; }
    .table-responsive { font-size: 0.85rem; }
    .table th, .table td { padding: 10px 8px; }
}
@media (max-width: 480px) {
    .logo img { height: 30px; margin-right: 5px; }
    .logo { font-size: 1rem; }
}
</style>

<div class="container mt-4">
    <div class="hero-section">
        <h1>⚽ Partidos del Torneo</h1>
        <p>Consulta la programación, resultados y estado de cada partido</p>
    </div>

    <h2 class="section-title">📋 Listado de Partidos</h2>

    <form method="GET" action="{{ route(Route::currentRouteName()) }}">
        <div class="filter-box">
            
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
                🔍 Aplicar Filtros
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>📅 Fecha/Hora</th>
                    <th>🏆 Fase</th>
                    <th>⚽ Equipos - Marcador</th>
                    <th>📍 Estado</th>
                    <th>⚙️ Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partidos as $partido)
                    <tr>
                        <td><strong>{{ $partido->id }}</strong></td>

                        <td style="white-space: nowrap;">
                            <strong>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</strong><br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }} hrs</small>
                        </td>

                        <td><span class="fase-badge">{{ ucfirst($partido->fase) }}</span></td>

                        <td>
                            <div class="marcador">
                                @foreach($partido->equipos as $equipo)
                                    <div class="marcador-item">
                                        <span>{{ $equipo->nombre }}</span>
                                        <span class="goles-badge">
                                            {{ $equipo->pivot->goles ?? 0 }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>

                        <td>
                            <span class="badge {{ $partido->jugado ? 'bg-success' : 'bg-danger' }}">
                                {{ $partido->jugado ? '✅ Jugado' : '⏳ Pendiente' }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('partidos.show', $partido->id) }}" 
                                class="btn btn-info-mgr">
                                👁️ Ver Detalles
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4" style="background-color: #2a2e33; border-radius: 0 0 15px 15px;">
                            ⚠️ No hay partidos disponibles para mostrar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if ($partidos->lastPage() > 1)
        <div class="d-flex justify-content-center mt-4">
            {{ $partidos->links() }} 
        </div>
    @endif

    <div class="text-center mt-5">
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary-mgr">⬅️ Volver al Menú</a>
    </div>
</div>
@endsection