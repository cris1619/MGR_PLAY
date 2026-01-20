@extends('layouts.app')

@section('title')
Crear Jugador | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            🎽 NUEVO JUGADOR
        </a>
    </div>
    <a href="{{ route('jugadores.index') }}" class="btn btn-admin">← Volver a Jugadores</a>
</nav>
@endsection

@section('content')
<style>
    

    .navbar {
        background-color: rgba(27, 31, 35, 0.9);
        padding: 0 20px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 8px rgba(0,0,0,0.4);
        border-bottom: 2px solid #ffd700;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .logo {
        display: flex;
        align-items: center;
        color: white;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .logo img {
        height: 50px;
        margin-right: 20px;
    }

    /* Tarjeta del formulario */
    .form-card {
        background: rgba(33, 37, 41, 0.95);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 40px;
        color: white;
        box-shadow: 0 8px 16px rgba(0,0,0,0.5);
        transition: all 0.3s ease;
    }

    .form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(255,215,0,0.15);
        border-color: #ffd700;
    }

    h3 {
        color: #ffd700;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 0 0 8px rgba(255,215,0,0.4);
    }

    .form-label {
        font-weight: 600;
        color: #ffd700;
    }

    .form-control,
    .form-select {
        border-radius: 15px;
        background-color: #2a2e33;
        border: none;
        color: #fff;
        font-size: 15px;
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border: 1px solid #ffd700;
        box-shadow: 0 0 6px rgba(255,215,0,0.5);
    }

    /* Botones */
    .btn-guardar {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1B1F23;
        border: none;
        font-weight: 700;
        border-radius: 25px;
        padding: 10px 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0,255,136,0.4);
    }

    .btn-guardar:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        color: #000;
        box-shadow: 0 6px 14px rgba(0,255,136,0.6);
    }

    .btn-volver {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        font-weight: 700;
        border: none;
        border-radius: 25px;
        padding: 10px 25px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(255,215,0,0.4);
    }

    .btn-volver:hover {
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255,215,0,0.6);
        color: #000;
    }

    @media (max-width: 768px) {
        .form-card { padding: 25px; }
    }
    .form-control::placeholder {
        color: #fff;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="form-card fade-in-up">
        <h3>➕ Registrar nuevo jugador</h3>

        <form method="POST" action="{{ route('jugadores.store') }}">
            @csrf

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" style="color: white; background-color: #2a2e33;" required placeholder="Ingrese el Nombre del jugador"> 
                    
                </div>

                <div class="col-md-6">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" style="color: white; background-color: #2a2e33;" required placeholder="Ingrese el Apellido del Jugador">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fecha de nacimiento</label>
                    <input type="date" name="fechaNacimiento" class="form-control" style="color: white; background-color: #2a2e33;" required >
                </div>

                <div class="col-md-3">
                    <label class="form-label">Altura (m)</label>
                    <input type="number" step="0.01" name="altura" class="form-control" style="color: white; background-color: #2a2e33;" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Peso (kg)</label>
                    <input type="number" step="0.01" name="peso" class="form-control" style="color: white; background-color: #2a2e33;" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Posición</label>
                    <select name="posicion" class="form-select" required>
                        <option value="">-- Selecciona una posición --</option>
                        @foreach($posiciones as $posicion)
                            <option value="{{ $posicion }}">{{ ucfirst($posicion) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

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

            <div class="mt-5 d-flex justify-content-end gap-3">
                <button type="submit" class="btn-guardar">💾 Guardar</button>
                <a href="{{ route('jugadores.index') }}" class="btn-volver">← Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
