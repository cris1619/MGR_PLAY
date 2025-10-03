@extends('layouts.app')

@section('title')
Jugadores | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            ⚽ JUGADORES
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
    <h2 class="text-white mb-4"> ⚽ Jugadores Registrados</h2>

    <!-- 🔍 Barra de filtros -->
    <div class="filter-card shadow-sm p-4 rounded-4 mb-4">
        <form method="GET" action="{{ route('usuario.listaJugadores') }}" class="row g-3 align-items-end">

            <!-- Nombre -->
            <div class="col-md-4">
                <label class="form-label text-light fw-bold">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark text-light rounded-start-pill">🔍</span>
                    <input type="text" name="search" class="form-control rounded-end-pill"
                           placeholder="Escribe un nombre..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Posición -->
            <div class="col-md-4">
                <label class="form-label text-light fw-bold">Posición</label>
                <select name="posicion" class="form-select rounded-pill">
                    <option value="">-- Todas --</option>
                    <option value="Portero" {{ request('posicion') == 'Portero' ? 'selected' : '' }}>Portero</option>
                    <option value="Defensa" {{ request('posicion') == 'defensa central' ? 'selected' : '' }}>Defensa central</option>
                    <option value="Mediocampo" {{ request('posicion') == 'lateral izquierdo' ? 'selected' : '' }}>Lateral izquierdo</option>
                    <option value="Mediocampo" {{ request('posicion') == 'lateral derecho' ? 'selected' : '' }}>Lateral derecho</option>
                    <option value="Mediocampo" {{ request('posicion') == 'mediocentro' ? 'selected' : '' }}>Mediocentro</option>
                    <option value="Delantero" {{ request('posicion') == 'extremo izquierdo' ? 'selected' : '' }}>Extremo izquierdo</option>
                    <option value="Delantero" {{ request('posicion') == 'extremo derecho' ? 'selected' : '' }}>Extremo derecho</option>
                    <option value="Delantero" {{ request('posicion') == 'delantero centro' ? 'selected' : '' }}>Delantero centro</option>
                </select>
            </div>

            <!-- Equipo -->
            <div class="col-md-4">
                <label class="form-label text-light fw-bold">Equipo</label>
                <select name="idEquipo" class="form-select rounded-pill">
                    <option value="">-- Todos --</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ request('idEquipo') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Buscar</button>
                <a href="{{ route('usuario.listaJugadores') }}" class="btn btn-outline-light rounded-pill px-4">Limpiar</a>
            </div>
        </form>
    </div>

    <!-- 📋 Tabla de jugadores -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Posición</th>
                    <th>Fecha Nacimiento</th>
                    <th>Altura</th>
                    <th>Peso</th>
                    <th>Equipo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jugadores as $jugador)
                <tr>
                    <td><b>{{ $jugador->nombre }}</b></td>
                    <td>{{ $jugador->apellido }}</td>
                    <td>{{ $jugador->posicion }}</td>
                    <td>{{ \Carbon\Carbon::parse($jugador->fechaNacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $jugador->altura }} m</td>
                    <td>{{ $jugador->peso }} kg</td>
                    <td>{{ $jugador->equipos->nombre ?? 'Sin equipo' }}</td>
                    <td>
                        <span class="badge {{ $jugador->estado === 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($jugador->estado) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">⚠️ No hay jugadores registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- 📌 Paginación -->
        @if(request('per_page') !== 'all')
        <div class="d-flex justify-content-center mt-3">
            {{ $jugadores->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
