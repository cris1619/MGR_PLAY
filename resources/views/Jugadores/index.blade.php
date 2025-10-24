@extends('layouts.app')

@section('title')
Jugadores | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🎽 JUGADORES
        </a>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-secondary">Volver al menú</a>
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

    .form-select,
    .form-control {
        border-radius: 20px;
        font-size: 14px;
    }

    .input-group-text {
        border-radius: 20px 0 0 20px;
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">🎽 Jugadores Registrados</h2>
        <a href="{{ route('jugadores.create') }}" class="btn btn-secondary rounded-pill px-4">➕ Crear Jugador</a>
    </div>

    <!-- 🔍 Barra de filtros avanzada -->
    <div class="filter-card shadow-sm">
        <form method="GET" action="{{ route('jugadores.index') }}" class="row g-3 align-items-end">

            <!-- Nombre -->
            <div class="col-md-4">
                <label class="form-label text-light">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary text-white">🔍</span>
                    <input type="text" name="search" class="form-control"
                        placeholder="Escribe un nombre..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Posición -->
            <div class="col-md-4">
                <label class="form-label text-light">Posición</label>
                <select name="posicion" class="form-select">
                    <option value="">-- Todas --</option>
                    @foreach($posiciones as $posicion)
                    <option value="{{ $posicion }}" {{ request('posicion') == $posicion ? 'selected' : '' }}>
                        {{ ucfirst($posicion) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Equipo -->
            <div class="col-md-4">
                <label class="form-label text-light">Equipo</label>
                <select name="idEquipo" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}" {{ request('idEquipo') == $equipo->id ? 'selected' : '' }}>
                        {{ $equipo->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>


            <!-- Botones -->
            <div class="col-md-12 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Buscar</button>
                <a href="{{ route('jugadores.index') }}" class="btn btn-outline-light rounded-pill px-4">Limpiar</a>
            </div>
        </form>
    </div>

    <!-- 📋 Tabla de jugadores -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
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

                        <form action="{{ route('jugadores.destroy', $jugador->id) }}"
                            method="POST"
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
        <!-- 📌 Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $jugadores->links() }}
        </div>
    </div>

    <div class="container text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Volver al menú</a>
    </div>
</div>
@endsection