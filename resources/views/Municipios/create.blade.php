@extends('layouts.app')

@section('title')
 Crear Municipio | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('Municipios.index') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🌍 CREAR MUNICIPIO
        </a>
    </div>
</nav>
@endsection

@section('content')
<style>
    /* ==== NAVBAR ==== */
    .navbar {
        background-color: #1B1F23;
        padding: 0 20px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
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

    .logo:hover {
        transform: scale(1.05);
        color: white;
    }

    .logo img {
        height: 50px;
        margin-right: 30px;
    }

    /* ==== ANIMACIONES ==== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glowIn {
        0% { box-shadow: 0 0 0 rgba(255,215,0,0); }
        100% { box-shadow: 0 0 20px rgba(255,215,0,0.4); }
    }

    /* ==== TARJETA DEL FORMULARIO ==== */
    .edit-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 40px;
        max-width: 600px;
        margin: 80px auto;
        color: #fff;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards, glowIn 1.5s ease 0.3s forwards;
    }

    .edit-card h2 {
        color: #f8f8f5ff;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: fadeInUp 0.8s ease 0.2s forwards;
    }

    /* ==== CAMPOS ==== */
    label {
        color: #ffd700;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }

    input.form-control {
        background-color: #2a2e33;
        border: 1px solid #444;
        color: white;
        border-radius: 10px;
        padding: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input.form-control:focus {
        border-color: #ffd700;
        box-shadow: 0 0 10px rgba(255,215,0,0.4);
        background-color: #2f3339;
        transform: scale(1.02);
    }

    #nombre::placeholder {
        color: #fff;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

    input:focus::placeholder {
        opacity: 0.3;
    }

    /* ==== BOTONES ==== */
    .btn-guardar,
    .btn-cancelar {
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        transform-origin: center;
    }

    .btn-guardar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-guardar:hover {
    transform: scale(1.07);
    background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
    box-shadow: 0 6px 14px rgba(255, 215, 0, 0.6);
    color: #1B1F23; /* ← mantiene el color original del texto */
    }

    .btn-cancelar {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1B1F23;
        box-shadow: 0 4px 8px rgba(0, 255, 136, 0.4);
    }

    .btn-cancelar:hover {
    transform: scale(1.07);
    background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
    box-shadow: 0 6px 14px rgba(0, 255, 136, 0.6);
    color: #1B1F23; /* ← mantiene el color original */
    }
</style>

<div class="edit-card">
    <h2>Crear Municipio</h2>

    <form action="{{ route('municipios.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nombre">Nombre del Municipio</label>
            <input type="text" 
                   name="nombre" 
                   id="nombre" 
                   class="form-control" 
                   placeholder="Ingrese el nombre" 
                   value="{{ old('nombre') }}"
                   style="color: white; background-color: #2a2e33;" 
                   required>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-guardar">💾 Guardar</button>
            <a href="{{ route('municipios.index') }}" class="btn btn-cancelar">↩️ Volver</a>
        </div>
    </form>
</div>
@endsection
