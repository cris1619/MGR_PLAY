@extends('layouts.app')

@section('title')
 Crear Canchas | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('canchas.index') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🏟️ CREAR CANCHA
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
    .navbar-left { display: flex; align-items: center; gap: 40px; }
    .logo { display: flex; align-items: center; color: white; font-size: 18px; font-weight: bold; text-decoration: none; transition: transform 0.3s ease; }
    .logo:hover { transform: scale(1.05); color: white; }
    .logo img { height: 50px; margin-right: 30px; }

    /* ==== ANIMACIONES ==== */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes glowIn { 0% { box-shadow: 0 0 0 rgba(255,215,0,0); } 100% { box-shadow: 0 0 20px rgba(255,215,0,0.4); } }

    /* ==== TARJETA DEL FORMULARIO ==== */
    .edit-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 36px;
        max-width: 720px;
        margin: 72px auto;
        color: #fff;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards, glowIn 1.5s ease 0.3s forwards;
    }

    .edit-card h2 {
        color: #ffd700;
        font-weight: 700;
        margin-bottom: 18px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: fadeInUp 0.8s ease 0.2s forwards;
    }

    /* ==== CAMPOS ==== */
    .form-label {
        color: #ffd700 !important;
        font-weight: 600;
        margin-bottom: 8px;
    }

    input.form-control,
    select.form-select {
        background-color: #2a2e33;
        border: 1px solid #444;
        color: white;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 1rem;
        transition: all 0.28s ease;
        width: 100%;
    }

    input.form-control:focus,
    select.form-select:focus {
        border-color: #ffd700;
        box-shadow: 0 0 10px rgba(255,215,0,0.35);
        background-color: #2f3339;
        transform: translateY(-1px);
        outline: none;
    }

    select.form-select option {
        background-color: #1B1F23;
        color: #fff;
    }

    #nombre::placeholder,
    select.form-select::placeholder {
        color: #fff;
        opacity: 0.6;
        transition: opacity 0.25s ease;
    }
    input:focus::placeholder,
    select.form-select:focus::placeholder { opacity: 0.3; }

    /* ==== BOTONES ==== */
    .form-actions { display:flex; gap:12px; justify-content:center; margin-top:18px; flex-wrap:wrap; }

    .btn-guardar,
    .btn-cancelar {
        border: none;
        padding: 12px 28px;
        border-radius: 25px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.28s ease;
        transform-origin: center;
        color: #1B1F23; /* forzar color del texto */
    }

    .btn-guardar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }
    .btn-guardar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        box-shadow: 0 6px 14px rgba(255,215,0,0.55);
        color: #1B1F23;
    }

    .btn-cancelar {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        box-shadow: 0 4px 8px rgba(0, 255, 136, 0.35);
    }
    .btn-cancelar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        box-shadow: 0 6px 14px rgba(0,255,136,0.55);
        color: #1B1F23;
    }

    /* Responsive small */
    @media (max-width: 576px) {
        .edit-card { padding: 20px; margin: 36px 12px; }
        .form-actions { flex-direction: column; }
        .btn-guardar, .btn-cancelar { width: 100%; text-align: center; }
    }
</style>

<div class="edit-card">
    <h2>Crear Cancha</h2>

    <form action="{{ route('canchas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la cancha</label>
            <input type="text"
                   name="nombre"
                   id="nombre"
                   class="form-control"
                   placeholder="Ingrese el nombre de la cancha"
                   value="{{ old('nombre') }}"
                   style="color: white; background-color: #2a2e33"
                   required>
        </div>

        <div class="mb-3">
            <label for="idMunicipio" class="form-label">Municipio</label>
            <select name="idMunicipio"
                    id="idMunicipio"
                    class="form-select"
                    required>
                <option value="">Seleccione un municipio</option>
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}"
                        {{ old('idMunicipio') == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-guardar">💾 Guardar</button>
            <a href="{{ route('canchas.index') }}" class="btn-cancelar">↩️ Volver</a>
        </div>
    </form>
</div>
@endsection
