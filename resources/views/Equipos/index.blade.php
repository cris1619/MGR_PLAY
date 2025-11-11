@extends('layouts.app')

@section('title', 'Equipos | MGR PLAY')

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
/* === NAVBAR === */
.navbar {
    background-color: #101317;
    padding: 10px 20px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    border-bottom: 2px solid #16A34A;
}
.navbar-left {
    display: flex;
    align-items: center;
    gap: 30px;
}
.logo {
    display: flex;
    align-items: center;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
}
.logo img { height: 48px; margin-right: 15px; }
.logo:hover { transform: scale(1.05); color: #22C55E; }

/* === HERO === */
.hero-section {
    background: linear-gradient(135deg, #1B1F23 0%, #2E353C 100%);
    padding: 50px 20px;
    border-radius: 18px;
    text-align: center;
    margin-bottom: 45px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.35);
    animation: fadeIn 1s ease-out;
}
.hero-section h1 {
    color: #F8FAFC;
    font-weight: 700;
    font-size: 2.4rem;
}
.hero-section p {
    color: #cbd5e1;
    font-size: 1.1rem;
}

/* === BOTONES === */
.btn-admin {
    background: linear-gradient(135deg, #16A34A, #22C55E);
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(22,163,74,0.3);
}
.btn-admin:hover {
    background: linear-gradient(135deg, #22C55E, #16A34A);
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 6px 14px rgba(22,163,74,0.5);
    color: #fff;
}

/* === FILTROS === */
.filter-card {
    background: linear-gradient(145deg, #1C2025 0%, #272C31 100%);
    border: 1px solid #16A34A50;
    border-radius: 18px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
.filter-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(22,163,74,0.2);
}
.filter-card label {
    color: #22C55E;
    font-weight: 600;
}
.form-select, .form-control {
    background-color: #2a2e33;
    color: #fff;
    border: 1px solid #444;
    border-radius: 20px;
    padding: 8px 14px;
}
.input-group-text {
    background-color: #22C55E;
    color: #0f1113;
    font-weight: bold;
    border: none;
}

/* === TABLA === */
.table {
    background-color: #1B1F23;
    color: #E5E7EB;
    border-radius: 15px;
    overflow: hidden;
    text-align: center;
}
.table th {
    background-color: #252A30;
    color: #22C55E;
    font-weight: 700;
    text-transform: uppercase;
}
.table-hover tbody tr:hover {
    background-color: rgba(34,197,94,0.08);
    transition: background 0.3s ease;
}
.table td {
    vertical-align: middle;
    padding: 10px;
}
.badge.bg-success {
    background: #22C55E !important;
    color: #0f1113;
    font-weight: 600;
}
.badge.bg-danger {
    background: #EF4444 !important;
    color: #fff;
    font-weight: 600;
}

/* === BOTONES TABLA === */
.btn-success, .btn-warning {
    border-radius: 25px;
    font-weight: 600;
    padding: 6px 14px;
}
.btn-success {
    background: linear-gradient(135deg, #16A34A, #22C55E);
    border: none;
    color: #fff;
}
.btn-success:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(22,163,74,0.3);
}
.btn-warning {
    background: linear-gradient(135deg, #F59E0B, #FACC15);
    color: #1B1F23;
    border: none;
}
.btn-warning:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(250,204,21,0.3);
}

/* === PAGINACIÓN === */
.pagination .page-link {
    background-color: #2a2e33;
    border: none;
    color: #22C55E;
    border-radius: 50px;
}
.pagination .page-item.active .page-link {
    background-color: #22C55E;
    color: #101317;
    font-weight: bold;
}

/* === TITULO SECCION === */
.section-title {
    color: #22C55E;
    font-size: 1.8rem;
    font-weight: 700;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 25px;
    letter-spacing: 2px;
    position: relative;
    padding-bottom: 10px;
}
.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #22C55E, transparent);
}

/* === ANIMACIONES === */
@keyframes fadeIn { from {opacity: 0; transform: translateY(20px);} to {opacity: 1; transform: translateY(0);} }
.highlight { animation: fadeIn 0.8s ease-out; }

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .navbar-left img { height: 40px; }
    .hero-section h1 { font-size: 1.8rem; }
    .filter-card { padding: 15px; }
    .btn-admin { width: 100%; margin-bottom: 10px; }
    .table-responsive { font-size: 0.9rem; }
}
</style>

<div class="container mt-4">
    <div class="hero-section">
        <h1>👥 Gestión de Equipos</h1>
        <p>Administra, filtra y edita los equipos registrados en el sistema</p>
    </div>

    <h2 class="section-title">📋 Listado de Equipos</h2>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <a href="{{ route('equipos.create') }}" class="btn btn-admin">➕ Crear Equipo</a>
    </div>

    {{-- Filtros --}}
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
                    <input type="text" name="search" class="form-control" placeholder="Escribe un nombre..." value="{{ request('search') }}">
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

    {{-- Mensajes de filtros --}}
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

    {{-- Tabla --}}
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
                            @if($equipo->escudo)
                                <img src="{{ asset('storage/public/escudos/' . $equipo->escudo) }}" alt="Escudo {{ $equipo->nombre }}" 
                                     style="width:50px; height:50px; object-fit:cover; border-radius:50%; border:2px solid #22C55E;">
                            @else
                                <span class="text-muted">Sin escudo</span>
                            @endif
                        </td>
                        <td><strong>{{ $equipo->nombre }}</strong></td>
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

{{-- Mensajes de éxito / error --}}
@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: '¡Éxito!', text: "{{ session('success') }}", confirmButtonText: 'Aceptar', timer: 3000 });
});
</script>
@endif
@if(session('error'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'error', title: '¡Error!', text: "{{ session('error') }}", confirmButtonText: 'Aceptar', timer: 4000 });
});
</script>
@endif
@endsection
