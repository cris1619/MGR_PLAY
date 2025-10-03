@extends('layouts.app')

@section('title')
Equipos | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            👥 EQUIPOS
        </a>
    </div>
    <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary">Volver al menú</a>
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .filter-card {
        background-color: #1B1F23;
        border-radius: 15px;
        padding: 15px 20px;
        margin-bottom: 25px;
    }

    table {
        background-color: #1B1F23;
        color: white;
    }

    th {
        color: #ddd;
    }
</style>

<div class="container mt-5">
    <h2 class="text-white mb-4"> 👥 Equipos Registrados</h2>

    <!-- 🔍 Barra de filtros -->
    <div class="filter-card shadow-sm">
        <form method="GET" action="{{ route('usuario.listaEquipos') }}" class="row g-3 align-items-end">

            <!-- Municipio -->
            <div class="col-md-4">
                <label class="form-label text-light">Municipio</label>
                <select name="IdMunicipio" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}" {{ request('IdMunicipio') == $municipio->id ? 'selected' : '' }}>
                            {{ $municipio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buscar por nombre -->
            <div class="col-md-4">
                <label class="form-label text-light">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary text-white">🔍</span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Escribe un nombre..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Selector de cantidad -->
            <div class="col-md-2">
                <label class="form-label text-light">Mostrar</label>
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Todos</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Buscar</button>
                <a href="{{ route('usuario.listaEquipos') }}" class="btn btn-outline-light rounded-pill px-4">Limpiar</a>
            </div>
        </form>
    </div>

    <!-- 📋 Tabla de equipos -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Escudo</th>
                    <th>Nombre</th>
                    <th>Entrenador</th>
                    <th>Municipio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipos as $equipo)
                <tr>
                    <td>
                        <img src="{{ asset('img/' . $equipo->escudo) }}"
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
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">⚠️ No hay equipos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- 📌 Paginación -->
        @if(request('per_page') !== 'all')
        <div class="d-flex justify-content-center mt-3">
            {{ $equipos->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
