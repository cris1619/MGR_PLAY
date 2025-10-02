@extends('layouts.app')

@section('title')
Crear Jugador | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🎽 NUEVO JUGADOR
        </a>
    </div>
    <a href="{{ route('jugadores.index') }}" class="btn btn-secondary">Volver a jugadores</a>
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

    .form-card {
        background-color: #1B1F23;
        border-radius: 15px;
        padding: 25px 30px;
        margin-bottom: 25px;
        color: white;
    }

    .form-select,
    .form-control {
        border-radius: 15px;
        font-size: 14px;
    }

    .btn-primary {
        border-radius: 20px;
    }
</style>

<div class="container mt-5">
    <div class="form-card shadow-sm">
        <h3 class="mb-4">➕ Registrar nuevo jugador</h3>

        <form method="POST" action="{{ route('jugadores.store') }}">
            @csrf

            <div class="row g-3">
                <!-- Nombre -->
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- Apellido -->
                <div class="col-md-6">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>

                <!-- Fecha de nacimiento -->
                <div class="col-md-6">
                    <label class="form-label">Fecha de nacimiento</label>
                    <input type="date" name="fechaNacimiento" class="form-control" required>
                </div>

                <!-- Altura -->
                <div class="col-md-3">
                    <label class="form-label">Altura (m)</label>
                    <input type="number" step="0.01" name="altura" class="form-control" required>
                </div>

                <!-- Peso -->
                <div class="col-md-3">
                    <label class="form-label">Peso (kg)</label>
                    <input type="number" step="0.01" name="peso" class="form-control" required>
                </div>

                <!-- Posición -->
                <div class="col-md-6">
                    <label class="form-label">Posición</label>
                    <select name="posicion" class="form-select" required>
                        <option value="">-- Selecciona una posición --</option>
                        @foreach($posiciones as $posicion)
                        <option value="{{ $posicion }}">{{ ucfirst($posicion) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Estado -->
                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

                <!-- Equipo -->
                <div class="col-md-12">
                    <label class="form-label">Equipo</label>
                    <select name="idEquipo" class="form-select" required>
                        <option value="">-- Selecciona un equipo --</option>
                        @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('jugadores.index') }}" class="btn btn-warning">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection