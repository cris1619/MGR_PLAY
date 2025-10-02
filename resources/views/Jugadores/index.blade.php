@extends('layouts.app')

@section('title')
    Jugadores | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                ⚽ JUGADORES
            </a>
        </div>
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
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
        <h2 class="text-white">⚽ Jugadores Registrados</h2>
        <a href="{{ route('jugadores.create') }}" class="btn btn-secondary rounded-pill px-4">
            ➕ Crear Jugador
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
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
                        <td>{{ $jugador->nombre }}</td>
                        <td>{{ $jugador->apellido }}</td>
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
                            <a href="" 
                               class="btn btn-success btn-sm rounded-pill px-3">
                                ✏️ Editar
                            </a>

                            <form action="" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este jugador?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-white-50">No hay jugadores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="container text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Volver al menú</a>
    </div>
</div>
@endsection
