@extends('layouts.app')

@section('title')
    Canchas | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('welcome') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                🏟️ CANCHAS
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .cancha-card {
        background-color: #1B1F23;
        transition: transform 0.2s ease-in-out;
    }

    .cancha-card:hover {
        transform: translateY(-5px);
    }

    /* Estilos barra de búsqueda */
    .filter-card {
        background: #1B1F23;
        padding: 15px 20px;
        border-radius: 15px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">🏟️ Canchas Registradas</h2>
        <a href="{{ route('canchas.create') }}" class="btn btn-secondary rounded-pill px-4">
            ➕ Crear Cancha
        </a>
    </div>

    <!-- 🔍 Barra de búsqueda mejorada -->
    <div class="filter-card">
        <form method="GET" action="{{ route('canchas.index') }}">
            <div class="row g-3 align-items-center">
                
                <!-- Filtrar por municipio -->
                <div class="col-md-9">
                    <select name="IdMunicipio" class="form-select rounded-pill">
                        <option value="">Todos los municipios</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id }}" 
                                {{ request('IdMunicipio') == $municipio->id ? 'selected' : '' }}>
                                {{ $municipio->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones -->
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Buscar</button>
                    <a href="{{ route('canchas.index') }}" class="btn btn-outline-light rounded-pill px-4">Limpiar</a>
                </div>
            </div>
        </form>
    </div>

    <!-- 🔎 Mostrar filtro activo -->
    @if(request('IdMunicipio') || request('search'))
        <div class="alert alert-info text-center rounded-pill">
            @if(request('IdMunicipio'))
                Mostrando canchas en: <b>{{ $municipios->find(request('IdMunicipio'))->nombre }}</b>
            @endif
            @if(request('search'))
                &nbsp; | &nbsp; Coincidencias con: <b>{{ request('search') }}</b>
            @endif
        </div>
    @endif

    <!-- 📌 Listado de canchas -->
    <div class="row justify-content-center g-4">
        @forelse($canchas as $cancha)
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-4 cancha-card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white mb-2">
                            🏟️ <b>{{ $cancha->nombre }}</b>
                        </h5>
                        <p class="text-white-50 mb-3">
                            📍 Municipio: <b>{{ $cancha->municipio->nombre ?? 'Sin asignar' }}</b>
                        </p>

                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="{{ route('canchas.edit', $cancha->id) }}" 
                               class="btn btn-success btn-sm rounded-pill px-3">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('canchas.destroy', $cancha->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar esta cancha?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-white mt-4">
                <h5>No hay canchas registradas en este municipio.</h5>
            </div>
        @endforelse
    </div>

    <div class="container text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Volver al menú</a>
    </div>
</div>
@endsection
