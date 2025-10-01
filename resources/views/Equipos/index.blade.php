@extends('layouts.app')

@section('title')
    Equipos | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                👥 EQUIPOS
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
        <h2 class="text-white"> 👥 Equipos Registrados</h2>
        <a href="{{ route('equipos.create') }}" class="btn btn-secondary rounded-pill px-4">
            ➕ Crear Equipo
        </a>
    </div>

 <div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-dark">
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
                <tr>
                    <td>{{ $equipo->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $equipo->escudo) }}" 
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
                        <a href="{{ route('equipos.edit', $equipo->id) }}" 
                           class="btn btn-success btn-sm rounded-pill px-3">
                            ✏️ Editar
                        </a>

                        <form action="{{ route('equipos.destroy', $equipo->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('¿Estás seguro de eliminar este equipo?')">
                            @csrf
    
                            <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3">
                                🗑️ Eliminar
                            </button>
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
</div>


    <div class="container text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Volver al menú</a>
    </div>
</div>
@endsection
