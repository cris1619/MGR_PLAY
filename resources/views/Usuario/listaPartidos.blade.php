@extends('layouts.app')

@section('title', 'Partidos | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('usuario.vistaUsuario') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            🗓️ LISTADO DE PARTIDOS
        </a>
    </div>
    <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary-mgr">🏠 Volver al Menú</a>
</nav>
@endsection

@section('content')
<style>
/* =====================
    ESTILOS GENERALES (BASE OSCURA)
====================== */
.container.mt-4 {
    max-width: 1200px;
    margin: 30px auto;
}
body {
    background-color: #0f1215;
}

/* NAVBAR Y LOGO (Re-implementando estilos de navegación mejorados) */
.navbar {
    background-color: #101317;
    padding: 15px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    border-bottom: 3px solid #16A34A; /* Borde verde fuerte */
}
.navbar-left { display: flex; align-items: center; }
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