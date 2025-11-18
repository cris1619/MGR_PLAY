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
    /* 🌑 NAVBAR */
    .navbar {
        background-color: #101317;
        padding: 0 25px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .navbar a.logo {
        font-weight: bold;
        color: #22C55E;
        text-decoration: none;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .navbar a.logo:hover {
        color: #6EE7B7;
    }

    /* 🎨 FILTROS */
    .filter-card {
        background-color: #1B1F23;
        border: 1px solid #22C55E33;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    label {
        color: #d1d5db;
    }

    .form-control, .form-select {
        background-color: #101317;
        color: #ffffff;
        border: 1px solid #22C55E55;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: #15191d;
        border-color: #22C55E;
        box-shadow: 0 0 6px #22C55E55;
        color: white;
    }

    .input-group-text {
        background-color: #22C55E;
        color: #101317;
        font-weight: bold;
        border: none;
    }

    /* 🟩 BOTONES */
    .btn-primary {
        background-color: #22C55E;
        border: none;
        font-weight: bold;
        color: #101317;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #16A34A;
        transform: translateY(-2px);
        box-shadow: 0 0 10px #22C55E55;
    }

    .btn-outline-light {
        border: 1px solid #22C55E;
        color: #22C55E;
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
        background-color: #22C55E;
        color: #101317;
    }

    /* 🧾 TABLA */
    table {
        background-color: #1B1F23;
        color: white;
        border-radius: 10px;
        overflow: hidden;
    }

    th {
        background-color: #101317 !important;
        color: #22C55E;
        text-transform: uppercase;
        font-weight: bold;
        border-bottom: 2px solid #22C55E44;
    }

    td {
        vertical-align: middle;
    }

    tr:hover {
        background-color: #15191d;
    }

    /* 🏷️ ESTADO */
    .badge.bg-success {
        background-color: #22C55E !important;
        color: #101317;
        font-weight: bold;
    }

    .badge.bg-danger {
        background-color: #EF4444 !important;
        font-weight: bold;
    }

    /* 🧭 PAGINACIÓN */
    .pagination .page-link {
        background-color: #1B1F23;
        border: none;
        color: #22C55E;
        border-radius: 50px;
    }
    .pagination .page-item.active .page-link {
        background-color: #22C55E;
        color: #101317;
        font-weight: bold;
    }

    .titulo-jugadores {
    color: #22C55E; /* Verde MGR PLAY */
    font-weight: bold;
    text-shadow: 0 0 8px #22C55E33;
}

    .form-control::placeholder {
        color: #fff;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

.placeholder {
    color: white;
    opacity: 1; /* Para Chrome, Safari */
}
.placeholder {
    color: white;
    opacity: 1; /* Para Chrome, Safari */
}


 
</style>

<div class="container mt-5">
    <h2 class="titulo-jugadores mb-4">⚽ Jugadores Registrados</h2>


    <!-- 🔍 FILTROS -->
    <div class="filter-card shadow-sm p-4 rounded-4 mb-4">
        <form method="GET" action="{{ route('usuario.listaJugadores') }}" class="row g-3 align-items-end">
            <!-- Nombre -->
            <div class="col-md-4">
                <label class="form-label fw-bold">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text rounded-start-pill">🔍</span>
                    <input type="text" name="search" class="form-control rounded-end-pill"
                           placeholder="Escribe un nombre..."style="color: white; background-color: #2a2e33;;" value="{{ request('search') }}">
                </div>
            </div>

            <!-- Posición -->
            <div class="col-md-4">
                <label class="form-label fw-bold">Posición</label>
                <select name="posicion" class="form-select rounded-pill">
                    <option value="">-- Todas --</option>
                    <option value="Portero" {{ request('posicion') == 'Portero' ? 'selected' : '' }}>Portero</option>
                    <option value="Defensa" {{ request('posicion') == 'defensa central' ? 'selected' : '' }}>Defensa central</option>
                    <option value="Mediocampo" {{ request('posicion') == 'lateral izquierdo' ? 'selected' : '' }}>Lateral izquierdo</option>
                    <option value="Mediocampo" {{ request('posicion') == 'lateral derecho' ? 'selected' : '' }}>Lateral derecho</option>
                    <option value="Mediocampo" {{ request('posicion') == 'Mediocentro' ? 'selected' : '' }}>Mediocentro</option>
                    <option value="Delantero" {{ request('posicion') == 'extremo izquierdo' ? 'selected' : '' }}>Extremo izquierdo</option>
                    <option value="Delantero" {{ request('posicion') == 'extremo derecho' ? 'selected' : '' }}>Extremo derecho</option>
                    <option value="Delantero" {{ request('posicion') == 'delantero centro' ? 'selected' : '' }}>Delantero centro</option>
                </select>
            </div>

            <!-- Equipo -->
            <div class="col-md-4">
                <label class="form-label fw-bold">Equipo</label>
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

    <!-- 📋 TABLA -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead>
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
        <div class="d-flex justify-content-center mt-5">
            {{ $jugadores->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
