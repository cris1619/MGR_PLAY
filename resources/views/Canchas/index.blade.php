@extends('layouts.app')

@section('title')
    Canchas | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                🏟️ CANCHAS
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

    .cancha-card {
        background-color: #1B1F23;
        transition: transform 0.2s ease-in-out;
    }

    .cancha-card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">🏟️ Canchas Registradas</h2>
        <a href="#" class="btn btn-secondary rounded-pill px-4">
            ➕ Crear Cancha
        </a>
    </div>

    <div class="row justify-content-center g-4">
        @foreach($canchas as $cancha)
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
                            <a href="#" 
                               class="btn btn-success btn-sm rounded-pill px-3">
                                ✏️ Editar
                            </a>

                            <form action="#" 
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
        @endforeach
    </div>
</div>
@endsection
