@extends('layouts.app')

@section('title', 'Partidos | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            ⚽ PARTIDOS
        </a>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-admin">Volver al Menú</a>
</nav>
@endsection

@section('content')
<style>
/* =====================
   ESTILOS GENERALES
====================== */
body {
    background-color: #0f1215;
}

/* NAVBAR */
.navbar {
    background-color: #101317;
    padding: 10px 20px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    border-bottom: 2px solid #16A34A;
}
.navbar-left { display: flex; align-items: center; gap: 25px; }
.logo {
    display: flex; align-items: center;
    color: white; font-weight: 700; font-size: 18px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.logo img { height: 48px; margin-right: 12px; }
.logo:hover { transform: scale(1.05); color: #22C55E; }

/* HERO */
.hero-section {
    background: linear-gradient(135deg, #1f2429, #2a3036);
    padding: 40px 20px;
    border-radius: 18px;
    text-align: center;
    margin-bottom: 40px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.35);
}
.hero-section h1 {
    color: #F8FAFC;
    font-weight: 700;
    font-size: 2.2rem;
}
.hero-section p { color: #cbd5e1; font-size: 1.1rem; }

/* BOTONES */
.btn-admin {
    background: linear-gradient(135deg, #16A34A, #22C55E);
    color: white;
    border: none;
    padding: 10px 22px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-admin:hover {
    background: linear-gradient(135deg, #22C55E, #16A34A);
    transform: translateY(-2px) scale(1.03);
}

/* TABLA */
.table {
    background-color: #1B1F23;
    color: #E5E7EB;
    border-radius: 15px;
    overflow: hidden;
}
.table th {
    background-color: #252A30;
    color: #22C55E;
    text-transform: uppercase;
}
.table-hover tbody tr:hover {
    background-color: rgba(34,197,94,0.08);
    transition: 0.3s;
}

/* MARCADOR */
.marcador {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.marcador-item {
    display: flex;
    justify-content: space-between;
    background-color: #2a2e33;
    padding: 6px 10px;
    border-radius: 8px;
}
.goles-badge {
    background: linear-gradient(135deg, #22C55E, #16A34A);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: bold;
}

/* FASE */
.fase-badge {
    background: linear-gradient(135deg, #8B5CF6, #A78BFA);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
}

/* TITULO */
.section-title {
    color: #22C55E;
    text-align: center;
    margin-bottom: 30px;
    font-size: 1.8rem;
    font-weight: 700;
    text-transform: uppercase;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-section h1 { font-size: 1.7rem; }
    .table-responsive { font-size: 0.9rem; }
}
</style>

<div class="container mt-4">
    <div class="hero-section">
        <h1>⚽ Partidos del Torneo</h1>
        <p>Consulta la programación, resultados y estado de cada partido</p>
    </div>

    <h2 class="section-title">📋 Listado de Partidos</h2>

    <div class="table-responsive">
        <table class="table table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>📅 Fecha</th>
                    <th>🕐 Hora</th>
                    <th>🏆 Fase</th>
                    <th>⚽ Equipos - Marcador</th>
                    <th>📍 Estado</th>
                    <th>⚙️ Ver</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partidos as $partido)
                    <tr>
                        <td><strong>{{ $partido->id }}</strong></td>

                        <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>

                        <td>{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</td>

                        <td><span class="fase-badge">{{ ucfirst($partido->fase) }}</span></td>

                        <td>
                            <div class="marcador">
                                @foreach($partido->equipos as $equipo)
                                    <div class="marcador-item">
                                        <span>{{ $equipo->nombre }}</span>
                                        <span class="goles-badge">
                                            {{ $equipo->pivot->goles ?? 0 }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>

                        <td>
                            <span class="badge {{ $partido->jugado ? 'bg-success' : 'bg-danger' }}">
                                {{ $partido->jugado ? '✅ Jugado' : '⏳ Pendiente' }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('partidos.show', $partido->id) }}" 
                               class="btn btn-info btn-sm" style="border-radius:25px;">
                                👁️ Ver Detalles
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            ⚠️ No hay partidos disponibles
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('welcome') }}" class="btn btn-admin">⬅️ Volver al Menú</a>
    </div>
</div>
@endsection
