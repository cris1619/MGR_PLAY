@extends('layouts.app')

@section('title')
{{ $torneo->nombre }} | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🏆 TORNEO
        </a>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('torneos.index') }}" class="btn btn-outline-light">← Volver</a>
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary">🏠 Inicio</a>
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .hero-section {
        background: linear-gradient(135deg, rgba(26, 31, 36, 0.98) 0%, rgba(42, 46, 51, 0.98) 100%);
        border-radius: 25px;
        padding: 50px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        border: 2px solid #ffd700;
    }

    .trophy-icon {
        font-size: 5rem;
        text-align: center;
        margin-bottom: 20px;
        filter: drop-shadow(0 5px 20px rgba(255, 215, 0, 0.5));
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }

    .torneo-nombre {
        background: linear-gradient(135deg, #ffd700 0%, #00ff88 50%, #00ccff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 3rem;
        text-align: center;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .info-card {
        background: linear-gradient(145deg, #1a1f24 0%, #252a30 50%, #1a1f24 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #00ff88, #00ccff, #ffd700);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 255, 136, 0.2);
        border-color: #00ff88;
    }

    .card-title {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-item {
        display: flex;
        padding: 15px;
        margin-bottom: 15px;
        background: rgba(42, 46, 51, 0.5);
        border-radius: 12px;
        border-left: 4px solid #00ccff;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(42, 46, 51, 0.8);
        border-left-color: #00ff88;
        transform: translateX(5px);
    }

    .info-label {
        color: #00ccff;
        font-weight: 600;
        font-size: 1.1rem;
        min-width: 200px;
    }

    .info-value {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .estado-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1rem;
    }

    .estado-activo {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1a1f24;
        box-shadow: 0 5px 20px rgba(0, 255, 136, 0.4);
    }

    .estado-finalizado {
        background: linear-gradient(135deg, #ffd700 0%, #ffaa00 100%);
        color: #1a1f24;
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
    }

    .estado-inactivo {
        background: linear-gradient(135deg, #666 0%, #444 100%);
        color: #fff;
    }

    .tipo-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        border-radius: 20px;
        background: rgba(0, 204, 255, 0.2);
        border: 2px solid #00ccff;
        color: #00ccff;
        font-weight: 700;
        text-transform: uppercase;
    }

    .equipos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .equipo-card {
        background: rgba(42, 46, 51, 0.6);
        border: 2px solid #3a3e43;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s ease;
    }

    .equipo-card:hover {
        background: rgba(42, 46, 51, 0.9);
        border-color: #00ff88;
        transform: translateX(5px);
    }

    .equipo-escudo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffd700;
    }

    .equipo-nombre {
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
    }

    .grupo-container {
        background: rgba(26, 31, 36, 0.6);
        border: 2px solid #2a2e33;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
    }

    .grupo-title {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 20px;
    }

    .partido-card {
        background: rgba(42, 46, 51, 0.6);
        border: 2px solid #3a3e43;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .partido-card:hover {
        border-color: #00ccff;
        transform: translateY(-2px);
    }

    .partido-equipos {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .partido-equipo {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
    }

    .vs-separator {
        color: #ffd700;
        font-weight: 800;
        font-size: 1.2rem;
        padding: 0 20px;
    }

    .partido-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid #3a3e43;
    }

    .partido-fecha {
        color: #00ccff;
        font-size: 0.9rem;
    }

    .partido-jugado {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .jugado-si {
        background: rgba(0, 255, 136, 0.2);
        border: 1px solid #00ff88;
        color: #00ff88;
    }

    .jugado-no {
        background: rgba(255, 215, 0, 0.2);
        border: 1px solid #ffd700;
        color: #ffd700;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .stat-card {
        background: rgba(42, 46, 51, 0.8);
        border: 2px solid #3a3e43;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: #ffd700;
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .stat-label {
        color: #00ccff;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .stat-value {
        color: #fff;
        font-size: 2rem;
        font-weight: 800;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="hero-section">
        <div class="trophy-icon">🏆</div>
        <h1 class="torneo-nombre">{{ $torneo->nombre }}</h1>
        <div class="text-center mb-3">
            <span class="tipo-badge">{{ $torneo->tipo }}</span>
        </div>
        <div class="text-center">
            <span class="estado-badge estado-{{ $torneo->estado }}">
                {{ ucfirst($torneo->estado) }}
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="info-card">
                <h3 class="card-title">📋 Información General</h3>
                
                <div class="info-item">
                    <div class="info-label">🆔 ID:</div>
                    <div class="info-value">{{ $torneo->id }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">📍 Municipio:</div>
                    <div class="info-value">{{ $torneo->municipio->nombre ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">📅 Inicio:</div>
                    <div class="info-value">{{ $torneo->fecha_inicio ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">🏁 Fin:</div>
                    <div class="info-value">{{ $torneo->fecha_fin ?? '-' }}</div>
                </div>

                @if($torneo->premio)
                <div class="info-item">
                    <div class="info-label">💰 Premio:</div>
                    <div class="info-value">{{ $torneo->premio }}</div>
                </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="info-card">
                <h3 class="card-title">⚙️ Configuración</h3>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-label">Equipos</div>
                        <div class="stat-value">{{ $torneo->num_equipos ?? 0 }}</div>
                    </div>

                    @if($torneo->tipo == 'Grupos')
                        <div class="stat-card">
                            <div class="stat-icon">🔢</div>
                            <div class="stat-label">Grupos</div>
                            <div class="stat-value">{{ $torneo->cantidad_grupos }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($torneo->equipos && $torneo->equipos->count() > 0)
    <div class="info-card">
        <h3 class="card-title">👥 Equipos Participantes</h3>
        <div class="equipos-grid">
            @foreach($torneo->equipos as $equipo)
            <div class="equipo-card">
                <img src="{{ asset('storage/public/escudos/' . $equipo->escudo) }}" alt="{{ $equipo->nombre }}" class="equipo-escudo">
                <div class="equipo-nombre">{{ $equipo->nombre }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($torneo->tipo == 'Grupos' && isset($torneo->grupos))
        @foreach($torneo->grupos as $grupo)
        <div class="grupo-container">
            <h4 class="grupo-title">🔷 {{ $grupo->nombre }}</h4>

            <div class="equipos-grid mb-4">
                @foreach($grupo->equipos as $equipo)
                <div class="equipo-card">
                    <img src="{{ asset('storage/public/escudos/' . $equipo->escudo) }}" alt="{{ $equipo->nombre }}" class="equipo-escudo">
                    <div class="equipo-nombre">{{ $equipo->nombre }}</div>
                </div>
                @endforeach
            </div>

            @php
                $partidosGrupo = $torneo->partidos->where('id_grupo', $grupo->id);
            @endphp

            @if($partidosGrupo->count() > 0)
            <h5 style="color: #00ccff; margin-bottom: 15px;">⚽ Partidos</h5>
            @foreach($partidosGrupo as $partido)
                @php
                    $equiposPartido = $partido->partido_equipos;
                @endphp

                @if($equiposPartido && $equiposPartido->count() == 2)
                <div class="partido-card">
                    <div class="partido-equipos">
                        <div class="partido-equipo">
                            <img src="{{ asset('img/' . $equiposPartido[0]->equipo->escudo) }}" alt="" class="equipo-escudo">
                            <span class="info-value">{{ $equiposPartido[0]->equipo->nombre }}</span>
                        </div>
                        <div class="vs-separator">VS</div>
                        <div class="partido-equipo">
                            <img src="{{ asset('img/' . $equiposPartido[1]->equipo->escudo) }}" alt="" class="equipo-escudo">
                            <span class="info-value">{{ $equiposPartido[1]->equipo->nombre }}</span>
                        </div>
                    </div>
                    
                    <div class="partido-info">
                        @if($partido->fecha)
                        <div class="partido-fecha">
                            📅 {{ $partido->fecha }} @if($partido->hora)⏰ {{ $partido->hora }}@endif
                        </div>
                        @endif
                        <span class="partido-jugado {{ $partido->jugado ? 'jugado-si' : 'jugado-no' }}">
                            {{ $partido->jugado ? '✓ Jugado' : '⏳ Pendiente' }}
                        </span>
                    </div>
                </div>
                @endif
            @endforeach
            @endif
        </div>
        @endforeach
    @endif

    @if($torneo->tipo == 'Eliminacion' && $torneo->partidos->count() > 0)
    <div class="info-card">
        <h3 class="card-title">⚔️ Partidos de Eliminación</h3>

        @foreach($torneo->partidos->sortBy('id') as $partido)
            @php
                $equipos = $partido->partido_equipos;
                $local = $equipos->where('rol', 'Local')->first();
                $visitante = $equipos->where('rol', 'Visitante')->first();
            @endphp

            <div class="partido-card">
                @if($partido->fase)
                <div style="color: #ffd700; font-weight: 600; margin-bottom: 10px;">
                    🏆 {{ $partido->fase }}
                </div>
                @endif

                <div class="partido-equipos">
                    <div class="partido-equipo">
                        @if($local && $local->equipo)
                        <img src="{{ asset('storage/public/escudos/' . $local->equipo->escudo) }}" alt="" class="equipo-escudo">
                        <span class="info-value">{{ $local->equipo->nombre }}</span>
                        @else
                        <span class="info-value" style="color: #999;">Por definir</span>
                        @endif
                    </div>
                    
                    <div class="vs-separator">VS</div>
                    
                    <div class="partido-equipo">
                        @if($visitante && $visitante->equipo)
                        <img src="{{ asset('storage/public/escudos/' . $visitante->equipo->escudo) }}" alt="" class="equipo-escudo">
                        <span class="info-value">{{ $visitante->equipo->nombre }}</span>
                        @else
                        <span class="info-value" style="color: #999;">Por definir</span>
                        @endif
                    </div>
                </div>
                
                <div class="partido-info">
                    @if($partido->fecha)
                    <div class="partido-fecha">
                        📅 {{ $partido->fecha }} @if($partido->hora)⏰ {{ $partido->hora }}@endif
                    </div>
                    @endif
                    <span class="partido-jugado {{ $partido->jugado ? 'jugado-si' : 'jugado-no' }}">
                        {{ $partido->jugado ? '✓ Jugado' : '⏳ Pendiente' }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    @if($torneo->tipo == 'Liguilla')
    <div class="info-card">
        <h3 class="card-title">🔄 Partidos de Liguilla</h3>

        @if($torneo->partidos && $torneo->partidos->count() > 0)
            @foreach($torneo->partidos as $partido)
                <div class="partido-card">
                    @if($partido->fase)
                    <div style="color: #ffd700; font-weight: 600; margin-bottom: 10px;">
                        📋 {{ $partido->fase }}
                    </div>
                    @endif

                    <ul style="color: #fff; list-style: none; padding: 0;">
                        @foreach($partido->partido_equipos as $pe)
                        <li style="padding: 5px 0;">
                            <span style="color: #00ccff;">{{ $pe->rol }}:</span>
                            <span>{{ $pe->equipo ? $pe->equipo->nombre : 'BYE' }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @else
            <p style="color: #999; text-align: center; padding: 40px;">No hay partidos generados aún</p>
        @endif
    </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('torneos.index') }}" class="btn btn-outline-light btn-lg">← Volver a Torneos</a>
    </div>
</div>
@endsection