@extends('layouts.app')

@section('title')
Jugadores | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            🎽 JUGADORES
        </a>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-admin">Volver al menú</a>
</nav>
@endsection

@section('content')
<style>
/* === NAVBAR === */
.navbar {
    background-color: #1B1F23;
    padding: 0 20px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}
.logo {
    display: flex;
    align-items: center;
    font-weight: 700;
    font-size: 18px;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}
.logo img {
    height: 50px;
    margin-right: 15px;
    transition: transform 0.3s ease;
}
.logo:hover img {
    transform: rotate(-5deg) scale(1.05);
}

/* === HERO SECTION === */
.hero-section {
    background: linear-gradient(135deg, #1B1F23, #2c3036);
    padding: 50px 20px;
    text-align: center;
    border-radius: 20px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    margin-bottom: 40px;
    transition: all 0.3s ease;
}
.hero-section:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(255, 215, 0, 0.15);
}
.hero-section h1 {
    color: #ffd700;
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 5px rgba(0,0,0,0.6);
}
.hero-section p {
    color: #ccc;
    font-size: 1.1rem;
}

/* === BOTONES === */
.btn-admin {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    color: #1B1F23;
    border: none;
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
}
.btn-admin:hover {
    transform: scale(1.07);
    background: linear-gradient(135deg, #fff57a, #ffd700);
    box-shadow: 0 6px 15px rgba(255, 215, 0, 0.5);
}
.btn-admin:active {
    transform: scale(0.97);
}

/* === FILTROS === */
.filter-card {
    background: linear-gradient(145deg, #1B1F23, #252a2f);
    border: 1px solid #2a2e33;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
.filter-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(255, 215, 0, 0.2);
}
.filter-card label {
    color: #ffd700;
    font-weight: 600;
}
.form-select,
.form-control {
    background-color: #2a2e33;
    color: #fff;
    border-radius: 20px;
    border: 1px solid #444;
}
.input-group-text {
    background-color: #ffd700;
    color: #1B1F23;
    font-weight: bold;
    border: none;
}

/* === TABLA === */
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
.table td {
    vertical-align: middle;
    border-color: #2f343a;
}
.table-hover tbody tr:hover {
    background-color: rgba(255, 215, 0, 0.05);
    transition: background 0.3s ease;
}
.badge.bg-success {
    background-color: #00ff88 !important;
    color: #1B1F23;
    font-weight: 600;
}
.badge.bg-danger {
    background-color: #ff5555 !important;
    color: white;
    font-weight: 600;
}

/* === BOTONES DE ACCIÓN === */
.btn-success, .btn-warning {
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}
.btn-success {
    background: linear-gradient(135deg, #00ff88, #00ccff);
    color: #1B1F23;
    border: none;
}
.btn-success:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 14px rgba(0, 255, 180, 0.4);
}
.btn-warning {
    background: linear-gradient(135deg, #ff8a00, #ffcd00);
    color: #1B1F23;
    border: none;
}
.btn-warning:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 14px rgba(255, 200, 0, 0.4);
}

/* === PAGINACIÓN === */
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

/* === TÍTULOS === */
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
    width: 120px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
}
</style>

<div class="container mt-4">
    <div class="hero-section">
        <h1>🎽 Gestión de Jugadores</h1>
        <p>Administra los jugadores registrados y su información</p>
    </div>

    <h2 class="section-title">📋 Listado de Jugadores</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('jugadores.create') }}" class="btn btn-admin">➕ Crear Jugador</a>
    </div>

    <!-- 🔍 Barra de filtros -->
    <div class="filter-card">
        <form method="GET" action="{{ route('jugadores.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label>Nombre</label>
                <div class="input-group">
                    <span class="input-group-text">🔍</span>
                    <input type="text" name="search" class="form-control" placeholder="Escribe el nombre del jugador..."
                        value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-4">
                <label>Posición</label>
                <select name="posicion" class="form-select">
                    <option value="">-- Todas --</option>
                    @foreach($posiciones as $posicion)
                        <option value="{{ $posicion }}" {{ request('posicion') == $posicion ? 'selected' : '' }}>
                            {{ ucfirst($posicion) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Equipo</label>
                <select name="idEquipo" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ request('idEquipo') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-admin w-100">Buscar</button>
                <a href="{{ route('jugadores.index') }}" class="btn btn-outline-light w-100 rounded-pill">Limpiar</a>
            </div>
        </form>
    </div>

    <!-- 📋 Tabla -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Fecha Nacimiento</th>
                    <th>Altura (m)</th>
                    <th>Peso (kg)</th>
                    <th>Estado</th>
                    <th>Equipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jugadores as $jugador)
                    <tr>
                        <td>{{ $jugador->id }}</td>
                        <td>{{ $jugador->nombreCompleto() }}</td>
                        <td>{{ $jugador->posicion }}</td>
                        <td>{{ \Carbon\Carbon::parse($jugador->fechaNacimiento)->format('d/m/Y') }}</td>
                        <td>{{ number_format($jugador->altura, 2) }}</td>
                        <td>{{ number_format($jugador->peso, 2) }}</td>
                        <td>
                            <span class="badge {{ $jugador->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($jugador->estado) }}
                            </span>
                        </td>
                        <td>{{ $jugador->equipos->nombre ?? 'Sin asignar' }}</td>
                        <td>
                            <a href="{{ route('jugadores.edit', $jugador->id) }}"
                                class="btn btn-success btn-sm rounded-pill px-3">✏️ Editar</a>

                            <form action="{{ route('jugadores.destroy', $jugador->id) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este jugador?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-white-50">⚠️ No hay jugadores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $jugadores->links() }}
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-admin">Volver al menú</a>
    </div>
</div>
@endsection
