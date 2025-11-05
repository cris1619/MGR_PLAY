@extends('layouts.app')

@section('title')
Equipos | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            👥 EQUIPOS
        </a>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-admin">Volver al Menú</a>
</nav>
@endsection

@section('content')
<style>
/* === Estilos globales adaptados del panel principal === */
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
.logo:hover { transform: scale(1.05); color: white; }
.logo img { height: 50px; margin-right: 20px; }

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
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}
.hero-section p {
    color: #ccc;
    font-size: 1.1rem;
    margin-bottom: 0;
}

/* Botones */
.btn-admin {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
    color: #1B1F23;
    border: none;
    padding: 10px 25px;
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
.btn-admin:active { transform: scale(0.98); }

/* Filtros */
.filter-card {
    background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
    border: 2px solid #2a2e33;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.3);
}
.filter-card label {
    color: #ffd700;
    font-weight: 600;
}
.form-select,
.form-control {
    border-radius: 20px;
    background-color: #2a2e33;
    color: white;
    border: 1px solid #444;
}
.input-group-text {
    background-color: #ffd700;
    color: #1B1F23;
    border: none;
    font-weight: bold;
}

/* Tabla */
.table {
    background-color: #1B1F23;
    color: white;
    border-radius: 15px;
    overflow: hidden;
}
.table th {
    background-color: #252a2f;
    color: #ffd700;
    text-transform: uppercase;
    font-weight: 700;
    border-bottom: 2px solid #444;
}
.table-hover tbody tr:hover {
    background-color: rgba(255, 215, 0, 0.05);
    transition: background 0.3s ease;
}
.table td {
    vertical-align: middle;
}

/* Badges */
.badge.bg-success { background-color: #00ff88 !important; color: #1B1F23; font-weight: 600; }
.badge.bg-danger { background-color: #ff5555 !important; color: white; font-weight: 600; }

/* Animación de fila destacada */
@keyframes highlight-fade {
    from { background-color: #2d3748; }
    to { background-color: transparent; }
}
.highlight {
    animation: highlight-fade 3s ease-out;
}

/* Botones tabla */
.btn-success, .btn-warning {
    border-radius: 25px;
    font-weight: 600;
}
.btn-success {
    background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
    border: none;
    color: #1B1F23;
}
.btn-success:hover {
    transform: scale(1.05);
}
.btn-warning {
    background: linear-gradient(135deg, #ff8a00 0%, #ffcd00 100%);
    color: #1B1F23;
    border: none;
}
.btn-warning:hover { transform: scale(1.05); }

/* Paginación */
.pagination .page-link {
    background-color: #2a2e33;
    border: none;
    color: #ffd700;
    border-radius: 50px;
}
.pagination .page-item.active .page-link {
    background-color: #ffd700;
    color: #1B1F23;
}

/* Título */
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
</style>

<div class="container mt-4">
    <!-- Hero -->
    <div class="hero-section">
        <h1>👥 Gestión de Equipos</h1>
        <p>Administra los equipos registrados y su información</p>
    </div>

    <h2 class="section-title">📋 Listado de Equipos</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-white">Equipos Registrados</h4>
        <a href="{{ route('equipos.create') }}" class="btn btn-admin">➕ Crear Equipo</a>
    </div>

    <!-- Filtros -->
    <div class="filter-card">
        <form method="GET" action="{{ route('equipos.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label>Municipio</label>
                <select name="IdMunicipio" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}" {{ request('IdMunicipio') == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Nombre</label>
                <div class="input-group">
                    <span class="input-group-text">🔍</span>
                    <input type="text" name="search" class="form-control" placeholder="Escribe un nombre..."
                        value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-2">
                <label>Mostrar</label>
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="all" {{ $perPage == 'all' ? 'selected' : '' }}>Todos</option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-admin w-100">Buscar</button>
                <a href="{{ route('equipos.index') }}" class="btn btn-outline-light w-100 rounded-pill">Limpiar</a>
            </div>
        </form>
    </div>

    <!-- Mensajes de filtros -->
    @if(request('IdMunicipio'))
    <div class="alert alert-info text-center rounded-pill">
        Mostrando equipos en: <b>{{ $municipios->find(request('IdMunicipio'))->nombre }}</b>
    </div>
    @endif

    @if(request('search'))
    <div class="alert alert-info text-center rounded-pill">
        Resultados de búsqueda para: <b>{{ request('search') }}</b>
    </div>
    @endif

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Escudo</th>
                    <th>Nombre</th>
                    <th>Entrenador</th>
                    <th>Municipio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipos as $equipo)
                <tr class="{{ session('highlighted_equipo_id') == $equipo->id ? 'highlight' : '' }}">
                    <td>{{ $equipo->id }}</td>
                    <td>
                        <img src="{{ asset('resources/img' . $equipo->escudo) }}"
                             alt="Escudo {{ $equipo->nombre }}"
                             width="50" height="50"
                             class="rounded-circle border">
                    </td>
                    <td><b>{{ $equipo->nombre }}</b></td>
                    <td>{{ $equipo->entrenador }}</td>
                    <td>{{ $equipo->municipio->nombre ?? 'Sin asignar' }}</td>
                    <td>
                        <span class="badge {{ $equipo->estado === 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($equipo->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-success btn-sm">✏️ Editar</a>
                        <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('¿Estás seguro de eliminar este equipo?')">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">⚠️ No hay equipos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($perPage !== 'all')
        <div class="d-flex justify-content-center mt-3">
            {{ $equipos->links() }}
        </div>
        @endif
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('welcome') }}" class="btn btn-admin">⬅️ Volver al Menú</a>
    </div>
</div>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        confirmButtonText: 'Aceptar',
        timer: 3000
    });
});
</script>
@endif

@if(session('error'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'error',
        title: '¡Error!',
        text: "{{ session('error') }}",
        confirmButtonText: 'Aceptar',
        timer: 4000
    });
});
</script>
@endif
@endsection
