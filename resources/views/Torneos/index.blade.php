@extends('layouts.app')

@section('title')
Torneos | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🏆 TORNEOS
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
        <h2 class="text-white">🏆 Torneos Registrados</h2>
        <a href="{{ route('torneos.create') }}" class="btn btn-secondary rounded-pill px-4">➕ Crear Torneo</a>
    </div>

    <!-- 🔍 Filtros -->
    <div class="filter-card shadow-sm">
        <form method="GET" action="{{ route('torneos.index') }}" class="row g-3 align-items-end">

            <!-- Nombre -->
            <div class="col-md-3">
                <label class="form-label text-light">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary text-white">🔍</span>
                    <input type="text" name="search" class="form-control"
                        placeholder="Escribe un nombre..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Municipio -->
            <div class="col-md-3">
                <label class="form-label text-light">Municipio</label>
                <select name="idMunicipio" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}" {{ request('idMunicipio') == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Estado -->
            <div class="col-md-3">
                <label class="form-label text-light">Estado</label>
                <select name="estado" class="form-select">
                    <option value="">-- Todos --</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <!-- Tipo de deporte -->
            <div class="col-md-3">
                <label class="form-label text-light">Deporte</label>
                <select name="tipoDeporte" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach(['FUTBOL','FUTBOL-5','FUTBOL-8','MICRO-FUTBOL','OTRO'] as $deporte)
                    <option value="{{ $deporte }}" {{ request('tipoDeporte') == $deporte ? 'selected' : '' }}>
                        {{ $deporte }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="col-md-12 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Buscar</button>
                <a href="{{ route('torneos.index') }}" class="btn btn-outline-light rounded-pill px-4">Limpiar</a>
            </div>


            <!-- 📌 Paginación -->
            <div class="d-flex justify-content-center mt-3">
                {{ $torneos->links() }}
            </div>
        </div>
    </form>
</div>

<!-- 📋 Tabla de torneos -->
<div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Municipio</th>
                <th>Deporte</th>
                <th>Formato</th>
                <th>Equipos</th>
                <th>Estado</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($torneos as $torneo)
            <tr>
                <td>{{ $torneo->id }}</td>
                <td>
                    @if($torneo->logo)
                    <img src="{{ asset('storage/'.$torneo->logo) }}" alt="logo" style="height: 30px; margin-right:5px;">
                    @endif
                    {{ $torneo->nombre }}
                </td>
                <td>{{ $torneo->municipios->nombre ?? 'Sin asignar' }}</td>
                <td>{{ $torneo->tipoDeporte }}</td>
                <td>{{ $torneo->formato }}</td>
                <td>{{ $torneo->numeroEquipos }}</td>
                <td>
                    <span class="badge {{ $torneo->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($torneo->estado) }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($torneo->fechaInicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($torneo->fechaFin)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('torneos.edit', $torneo->id) }}"
                        class="btn btn-success btn-sm rounded-pill px-3">✏️ Editar</a>

                    <form action="{{ route('torneos.destroy', $torneo->id) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Estás seguro de eliminar este torneo?')">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3">🗑️ Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-white-50">⚠️ No hay torneos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="container text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Volver al menú</a>
    </div>
</div>
@endsection