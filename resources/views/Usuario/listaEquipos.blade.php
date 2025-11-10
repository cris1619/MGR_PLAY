@extends('layouts.app')

@section('title')
Equipos | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            👥 EQUIPOS
        </a>
    </div>
    <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary">Volver al menú</a>
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .filter-card {
        background: linear-gradient(135deg, rgba(26, 31, 36, 0.98) 0%, rgba(42, 46, 51, 0.98) 100%);
        border: 2px solid transparent;
        background-clip: padding-box;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 35px;
        backdrop-filter: blur(15px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        position: relative;
    }

    .filter-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        padding: 2px;
        background: linear-gradient(135deg, #ffd700, #00ff88, #00ccff);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0.5;
    }

    .team-card {
        background: linear-gradient(145deg, #1a1f24 0%, #252a30 50%, #1a1f24 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
    }

    .team-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #00ff88, #00ccff, #ffd700);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .team-card:hover::before {
        opacity: 1;
    }

    .team-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 15px 40px rgba(0, 255, 136, 0.25), 
                    0 8px 20px rgba(255, 215, 0, 0.15);
        border-color: #00ff88;
    }

    .team-card-header {
        background: linear-gradient(135deg, rgba(42, 46, 51, 0.9) 0%, rgba(58, 62, 67, 0.9) 100%);
        padding: 30px 20px;
        text-align: center;
        border-bottom: 3px solid transparent;
        border-image: linear-gradient(90deg, transparent, #ffd700, transparent) 1;
        position: relative;
        overflow: hidden;
    }

    .team-card-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .team-card:hover .team-card-header::after {
        left: 100%;
    }

    .team-escudo-container {
        width: 140px;
        height: 140px;
        margin: 0 auto 15px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .team-escudo-container::before {
        content: '';
        position: absolute;
        inset: -5px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffd700, #00ff88);
        animation: rotate 4s linear infinite;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .team-card:hover .team-escudo-container::before {
        opacity: 0.6;
    }

    .team-escudo {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #1a1f24;
        position: relative;
        z-index: 1;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
    }

    .team-card:hover .team-escudo {
        transform: scale(1.15) rotate(8deg);
        box-shadow: 0 8px 30px rgba(255, 215, 0, 0.4);
    }

    .team-card-body {
        padding: 25px 20px;
        text-align: center;
        position: relative;
    }

    .team-name {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 12px;
        letter-spacing: 1px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease;
    }

    .team-card:hover .team-name {
        color: #ffd700;
        transform: scale(1.05);
    }

    .team-municipio {
        color: #00ccff;
        font-size: 1.1rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .team-card:hover .team-municipio {
        color: #00ff88;
    }

    .btn-ver-mas {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        border: none;
        color: #1a1f24;
        font-weight: 700;
        padding: 12px 35px;
        border-radius: 30px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.9rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 204, 255, 0.3);
    }

    .btn-ver-mas::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.5s ease, height 0.5s ease;
    }

    .btn-ver-mas:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-ver-mas:hover {
        transform: scale(1.08) translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 255, 136, 0.5);
        background: linear-gradient(135deg, #00ff88 0%, #ffd700 100%);
    }

    .no-equipos {
        background-color: rgba(26, 31, 36, 0.95);
        border: 2px dashed #3a3e43;
        border-radius: 15px;
        padding: 60px 20px;
        text-align: center;
        color: #999;
    }

    .no-equipos-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }
</style>

<div class="container mt-5">
    <h2 class="text-white mb-4">👥 Equipos Registrados</h2>

    <!-- 🔍 Barra de filtros -->
    <div class="filter-card shadow-lg">
        <form method="GET" action="{{ route('usuario.listaEquipos') }}" class="row g-3 align-items-end">

            <!-- Municipio -->
            <div class="col-md-4">
                <label class="form-label text-light">📍 Municipio</label>
                <select name="IdMunicipio" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}" {{ request('IdMunicipio') == $municipio->id ? 'selected' : '' }}>
                            {{ $municipio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buscar por nombre -->
            <div class="col-md-4">
                <label class="form-label text-light">🔍 Nombre</label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary text-white">🔍</span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Escribe un nombre..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Selector de cantidad -->
            <div class="col-md-2">
                <label class="form-label text-light">📊 Mostrar</label>
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Todos</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Buscar</button>
                <a href="{{ route('usuario.listaEquipos') }}" class="btn btn-outline-light rounded-pill px-4">Limpiar</a>
            </div>
        </form>
    </div>

    <!-- 🎴 Grid de Cards de Equipos -->
    @if($equipos->count() > 0)
        <div class="row g-4">
            @foreach($equipos as $equipo)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="team-card">
                    <div class="team-card-header">
                        <img src="{{ asset('storage/public/escudos/' . $equipo->escudo) }}"
                             alt="Escudo {{ $equipo->nombre }}"
                             class="team-escudo">
                    </div>
                    <div class="team-card-body">
                        <h5 class="team-name">{{ $equipo->nombre }}</h5>
                        <p class="team-municipio">
                            📍 {{ $equipo->municipio->nombre ?? 'Sin asignar' }}
                        </p>
                        <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-ver-mas">
                            Ver Más
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- 📌 Paginación -->
        @if(request('per_page') !== 'all')
        <div class="d-flex justify-content-center mt-5">
            {{ $equipos->links() }}
        </div>
        @endif
    @else
        <div class="no-equipos">
            <div class="no-equipos-icon">⚽</div>
            <h3 class="text-white mb-3">No hay equipos registrados</h3>
            <p>No se encontraron equipos con los filtros seleccionados.</p>
        </div>
    @endif
</div>
@endsection