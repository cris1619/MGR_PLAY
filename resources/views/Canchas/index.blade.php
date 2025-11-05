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

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1B1F23 0%, #2a2e33 100%);
        padding: 40px 20px;
        margin-bottom: 40px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .hero-section h1 {
        color: #ccc;
        font-size: 2.3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-section p {
        color: #ccc;
        font-size: 1.1rem;
    }

    /* Cards Canchas */
    .municipio-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        transition: all 0.4s ease;
        height: 100%;
        overflow: hidden;
        position: relative;
    }

    .municipio-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #00ff88, #00ccff);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .municipio-card:hover::before {
        opacity: 1;
    }

    .municipio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(255, 215, 0, 0.2);
        border-color: #ffd700;
    }

    .municipio-card .card-body {
        padding: 30px;
    }

    .card-title {
        color:  #ccc;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .card-text {
        color: #ccc;
        font-size: 0.95rem;
    }

    /* Botones */
    .btn-admin {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-admin:hover {
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255, 215, 0, 0.5);
        color: #000;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1B1F23;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,255,136,0.4);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        transform: scale(1.05);
        color: #000;
    }

    .section-title {
        color: #ffd700;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #ffd700, transparent);
    }

        /* 🔍 Tarjeta contenedora de filtros */
    .filter-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 1px solid #2a2e33;
        border-radius: 20px;
        padding: 20px 25px;
        margin-bottom: 30px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
    }

    .filter-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(255, 215, 0, 0.2);
    }

    /* 🔽 Select personalizado */
    .filter-card select.form-select {
        background-color: #1B1F23;
        color: #fff;
        border: 1px solid #ffd700;
        padding: 10px 15px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .filter-card select.form-select:focus {
        outline: none;
        box-shadow: 0 0 8px #ffd700;
        border-color: #ffd700;
    }

    /* 🔤 Texto del placeholder */
    .filter-card select option {
        background-color: #1B1F23;
        color: #fff;
    }

    /* 🔘 Botón de buscar */
    .filter-card .btn-primary {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        border: none;
        font-weight: 700;
        box-shadow: 0 4px 8px rgba(255,215,0,0.3);
        transition: all 0.3s ease;
    }

    .filter-card .btn-primary:hover {
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        transform: scale(1.05);
    }

    /* 🔘 Botón de limpiar */
    .filter-card .btn-outline-light {
        border: 1px solid #00ccff;
        color: #00ccff;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-card .btn-outline-light:hover {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        color: #000;
        transform: scale(1.05);
    }

</style>

<div class="container mt-4">

    <div class="hero-section">
        <h1>🏟️  Gestión de Canchas</h1>
        <p>Administra las Canchas registrados en MGR PLAY</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">🏟️ Canchas Registradas</h2>
        <a href="{{ route('canchas.create') }}" class="btn-admin">
            ➕ Crear Cancha
        </a>
    </div>

    <!-- 🔍 Barra de búsqueda mejorada -->
    <div class="filter-card">
    <form method="GET" action="{{ route('canchas.index') }}">
        <div class="row g-3 align-items-center">
            
            <!-- 🔽 Select de municipios -->
            <div class="col-md-9">
                <select name="IdMunicipio" class="form-select rounded-pill">
                    <option value="">Todos los Municipios</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}" 
                            {{ request('IdMunicipio') == $municipio->id ? 'selected' : '' }}>
                            {{ $municipio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 🔘 Botones -->
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Buscar</button>
                <a href="{{ route('canchas.index') }}" class="btn btn-outline-light rounded-pill px-4">Limpiar</a>
            </div>
        </div>
    </form>
</div>

    <!-- 🔎 Mostrar filtro activo -->
        @if(request('IdMunicipio'))
            @php
                $municipioSeleccionado = $municipios->firstWhere('id', request('IdMunicipio'));
            @endphp
            <div class="alert alert-info text-center rounded-pill">
                Mostrando canchas en: 
                <b>{{ $municipioSeleccionado ? $municipioSeleccionado->nombre : 'Desconocido' }}</b>
            </div>
        @endif

    <!-- 📌 Listado de canchas -->
    <div class="row justify-content-center g-4">
        @forelse($canchas as $cancha)
            <div class="col-md-4">
                <div class="card municipio-card shadow-lg fade-in-up">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3"> {{ $cancha->nombre }}</h5>

                        <p class="text-white-50 mb-3">

                            📍 Municipio: <b>{{ $cancha->municipio->nombre ?? 'Sin asignar' }}</b>
                        </p>

                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="{{ route('canchas.edit', $cancha->id) }}" 
                               class="btn-admin">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('canchas.destroy', $cancha->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar esta cancha?')">
                                @csrf
                                <button type="submit" class="btn-secondary"">
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
        <a href="{{ route('welcome') }}" class="btn btn-admin">Volver al menú</a>
    </div>
</div>
@endsection
