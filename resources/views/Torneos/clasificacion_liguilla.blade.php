@extends('layouts.app')

@section('title')
Clasificación {{ $torneo->nombre }} | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            📊 CLASIFICACIÓN
        </a>
    </div>
    <div class="d-flex gap-2">
        <a href="javascript:history.back()" class="btn btn-outline-light">← Volver</a>
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary">🏠 Inicio</a>
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
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

    /* ==== ANIMACIONES ==== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glowIn {
        0% { box-shadow: 0 0 0 rgba(0, 204, 255, 0); }
        100% { box-shadow: 0 0 20px rgba(0, 204, 255, 0.4); }
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    @keyframes podiumGlow {
        0%, 100% { box-shadow: 0 5px 20px rgba(255, 215, 0, 0.3); }
        50% { box-shadow: 0 5px 30px rgba(255, 215, 0, 0.6); }
    }

    /* ==== CONTENEDOR PRINCIPAL ==== */
    .clasificacion-container {
        max-width: 1400px;
        margin: 50px auto;
        padding: 0 20px;
    }

    /* ==== HEADER ==== */
    .clasificacion-header {
        background: linear-gradient(145deg, #1a1f24 0%, #252a30 100%);
        border: 2px solid #2a2e33;
        border-radius: 25px;
        padding: 40px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.8s ease forwards, glowIn 1.5s ease 0.3s forwards;
    }

    .clasificacion-header::before {
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

    .clasificacion-title {
        background: linear-gradient(135deg, #ffd700 0%, #00ff88 50%, #00ccff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 2.5rem;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

    .clasificacion-subtitle {
        text-align: center;
        color: #00ccff;
        font-size: 1.2rem;
        font-weight: 600;
    }

    /* ==== TABLA ==== */
    .tabla-wrapper {
        background: linear-gradient(145deg, #1a1f24 0%, #252a30 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 30px;
        overflow-x: auto;
        animation: fadeInUp 0.8s ease 0.2s forwards;
    }

    .clasificacion-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        margin: 0;
    }

    .clasificacion-table thead tr {
        background: linear-gradient(135deg, #2a2e33 0%, #1a1f24 100%);
    }

    .clasificacion-table thead th {
        color: #ffd700;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 20px 15px;
        text-align: center;
        font-size: 0.95rem;
        border: none;
        background: transparent;
    }

    .clasificacion-table thead th:first-child {
        text-align: left;
        padding-left: 25px;
        border-radius: 15px 0 0 15px;
    }

    .clasificacion-table thead th:last-child {
        border-radius: 0 15px 15px 0;
    }

    .clasificacion-table tbody tr {
        background: linear-gradient(145deg, #252a30 0%, #1a1f24 100%);
        border: 2px solid #2a2e33;
        transition: all 0.3s ease;
        position: relative;
    }

    .clasificacion-table tbody tr:hover {
        transform: translateX(5px);
        border-color: #00ff88;
        box-shadow: 0 5px 20px rgba(0, 255, 136, 0.2);
    }

    .clasificacion-table tbody tr td {
        padding: 20px 15px;
        color: #fff;
        font-size: 1.05rem;
        text-align: center;
        border: none;
        background: transparent;
    }

    .clasificacion-table tbody tr td:first-child {
        text-align: left;
        padding-left: 25px;
        font-weight: 600;
        color: #00ccff;
        border-radius: 15px 0 0 15px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .clasificacion-table tbody tr td:last-child {
        border-radius: 0 15px 15px 0;
    }

    /* ==== POSICIONES DESTACADAS ==== */
    .clasificacion-table tbody tr:nth-child(1) {
        background: linear-gradient(145deg, rgba(255, 215, 0, 0.2) 0%, rgba(255, 215, 0, 0.1) 100%);
        border: 2px solid #ffd700;
        animation: podiumGlow 2s ease-in-out infinite;
    }

    .clasificacion-table tbody tr:nth-child(2) {
        background: linear-gradient(145deg, rgba(192, 192, 192, 0.2) 0%, rgba(192, 192, 192, 0.1) 100%);
        border: 2px solid #c0c0c0;
    }

    .clasificacion-table tbody tr:nth-child(3) {
        background: linear-gradient(145deg, rgba(205, 127, 50, 0.2) 0%, rgba(205, 127, 50, 0.1) 100%);
        border: 2px solid #cd7f32;
    }

    /* ==== ESCUDO EQUIPO ==== */
    .equipo-escudo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffd700;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    /* ==== BADGE POSICIÓN ==== */
    .posicion-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #2a2e33 0%, #1a1f24 100%);
        border: 2px solid #3a3e43;
        border-radius: 50%;
        font-weight: 700;
        color: #00ccff;
        font-size: 1rem;
    }

    .clasificacion-table tbody tr:nth-child(1) .posicion-badge {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        border-color: #ffd700;
        color: #1a1f24;
    }

    .clasificacion-table tbody tr:nth-child(2) .posicion-badge {
        background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%);
        border-color: #c0c0c0;
        color: #1a1f24;
    }

    .clasificacion-table tbody tr:nth-child(3) .posicion-badge {
        background: linear-gradient(135deg, #cd7f32 0%, #e8a87c 100%);
        border-color: #cd7f32;
        color: #1a1f24;
    }

    /* ==== PUNTOS DESTACADOS ==== */
    .puntos-cell {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800 !important;
        font-size: 1.3rem !important;
    }

    /* ==== DIFERENCIA DE GOLES ==== */
    .dg-positiva {
        color: #00ff88;
        font-weight: 700;
    }

    .dg-negativa {
        color: #ff6b6b;
        font-weight: 700;
    }

    .dg-neutral {
        color: #999;
        font-weight: 700;
    }

    /* ==== LEYENDA ==== */
    .leyenda {
        background: linear-gradient(145deg, #1a1f24 0%, #252a30 100%);
        border: 2px solid #2a2e33;
        border-radius: 15px;
        padding: 20px;
        margin-top: 30px;
        animation: fadeInUp 0.8s ease 0.4s forwards;
    }

    .leyenda-title {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .leyenda-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 15px;
    }

    .leyenda-item {
        text-align: center;
        padding: 10px;
        background: rgba(42, 46, 51, 0.5);
        border-radius: 10px;
        border: 1px solid #3a3e43;
        transition: all 0.3s ease;
    }

    .leyenda-item:hover {
        border-color: #00ccff;
        transform: translateY(-2px);
    }

    .leyenda-item-label {
        color: #00ccff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .leyenda-item-desc {
        color: #999;
        font-size: 0.75rem;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 768px) {
        .clasificacion-container {
            padding: 0 10px;
            margin: 30px auto;
        }

        .clasificacion-header {
            padding: 25px;
        }

        .clasificacion-title {
            font-size: 1.8rem;
        }

        .clasificacion-subtitle {
            font-size: 1rem;
        }

        .tabla-wrapper {
            padding: 15px;
        }

        .clasificacion-table thead th,
        .clasificacion-table tbody tr td {
            padding: 12px 8px;
            font-size: 0.85rem;
        }

        .clasificacion-table tbody tr td:first-child {
            padding-left: 35px;
        }

        .clasificacion-table tbody tr::before {
            font-size: 1.5rem;
            left: 5px;
        }

        .posicion-badge {
            width: 25px;
            height: 25px;
            font-size: 0.85rem;
        }

        .equipo-escudo {
            width: 30px;
            height: 30px;
        }

        .leyenda-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<div class="clasificacion-container">
    <!-- HEADER -->
    <div class="clasificacion-header">
        <div class="clasificacion-title">📊 Tabla de Clasificación</div>
        <div class="clasificacion-subtitle">{{ $torneo->nombre }}</div>
    </div>

    <!-- LEYENDA -->
    <div class="leyenda">
        <div class="leyenda-title">📖 Leyenda</div>
        <div class="leyenda-grid">
            <div class="leyenda-item">
                <div class="leyenda-item-label">PJ</div>
                <div class="leyenda-item-desc">Partidos Jugados</div>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-item-label">G</div>
                <div class="leyenda-item-desc">Ganados</div>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-item-label">E</div>
                <div class="leyenda-item-desc">Empatados</div>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-item-label">P</div>
                <div class="leyenda-item-desc">Perdidos</div>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-item-label">GF</div>
                <div class="leyenda-item-desc">Goles a Favor</div>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-item-label">GC</div>
                <div class="leyenda-item-desc">Goles en Contra</div>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-item-label">DG</div>
                <div class="leyenda-item-desc">Diferencia de Goles</div>
            </div>
            <div class="leyenda-item">
                <div class="leyenda-item-label">PTS</div>
                <div class="leyenda-item-desc">Puntos</div>
            </div>
        </div>
    </div>

    <!-- TABLA -->
    <div class="tabla-wrapper">
        <table class="clasificacion-table">
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>PJ</th>
                    <th>G</th>
                    <th>E</th>
                    <th>P</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>DG</th>
                    <th>PTS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clasificacion as $index => $fila)
                    <tr>
                        <td>
                            <span class="posicion-badge">{{ $index + 1 }}</span>
                            @if($fila->equipo->escudo)
                                <img src="{{ asset('storage/public/escudos/' . $fila->equipo->escudo) }}" 
                                     alt="{{ $fila->equipo->nombre }}" 
                                     class="equipo-escudo">
                            @endif
                            {{ $fila->equipo->nombre }}
                        </td>
                        <td>{{ $fila->partidos_jugados }}</td>
                        <td>{{ $fila->ganados }}</td>
                        <td>{{ $fila->empatados }}</td>
                        <td>{{ $fila->perdidos }}</td>
                        <td>{{ $fila->goles_favor }}</td>
                        <td>{{ $fila->goles_contra }}</td>
                        <td>
                            @php
                                $dg = $fila->goles_favor - $fila->goles_contra;
                            @endphp
                            <span class="{{ $dg > 0 ? 'dg-positiva' : ($dg < 0 ? 'dg-negativa' : 'dg-neutral') }}">
                                {{ $dg > 0 ? '+' : '' }}{{ $dg }}
                            </span>
                        </td>
                        <td class="puntos-cell">{{ $fila->puntos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection