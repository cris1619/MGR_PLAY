@extends('layouts.app')

@section('title')
    Editar Municipio | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('municipios.index') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            🌍 EDITAR MUNICIPIO
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

    /* Tarjeta del formulario */
    .edit-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 40px;
        max-width: 600px;
        margin: 60px auto;
        box-shadow: 0 12px 24px rgba(0,0,0,0.3);
        color: #fff;
        animation: fadeInUp 0.6s ease forwards;
    }

    .edit-card h2 {
        color: #ffd700;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

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
    }

    input.form-control:focus {
        border-color: #ffd700;
        box-shadow: 0 0 10px rgba(255,215,0,0.4);
        background-color: #2f3339;
    }

    /* Botones */
    .btn-guardar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-guardar:hover {
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255, 215, 0, 0.5);
        color: #000;
    }

    .btn-cancelar {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1B1F23;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 8px rgba(0, 255, 136, 0.4);
    }

    .btn-cancelar:hover {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 255, 136, 0.6);
        color: #000;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="edit-card">
    <h2>Editar Municipio</h2>
    <form action="{{ route('municipios.update', $municipio->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nombre">Nombre del Municipio</label>
            <input type="text"
                   name="nombre"
                   id="nombre"
                   class="form-control"
                   placeholder="Ingrese el nombre"
                   value="{{ old('nombre', $municipio->nombre) }}"
                   required>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn-guardar">💾 Actualizar</button>
            <a href="{{ route('municipios.index') }}" class="btn-cancelar">↩️ Cancelar</a>
        </div>
    </form>
</div>
@endsection
