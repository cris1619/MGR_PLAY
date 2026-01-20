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
/* === NAVBAR === */
.navbar {
    background-color: #101317;
    padding: 10px 20px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    border-bottom: 2px solid #16A34A;
}
.navbar-left {
    display: flex;
    align-items: center;
    gap: 30px;
}
.logo {
    display: flex;
    align-items: center;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
}
.logo img { height: 48px; margin-right: 15px; }
.logo:hover { transform: scale(1.05); color: #22C55E; }

/* === HERO === */
.hero-section {
    background: linear-gradient(135deg, #1B1F23 0%, #2E353C 100%);
    padding: 50px 20px;
    border-radius: 18px;
    text-align: center;
    margin-bottom: 45px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.35);
    animation: fadeIn 1s ease-out;
}
.hero-section h1 {
    color: #F8FAFC;
    font-weight: 700;
    font-size: 2.4rem;
}
.hero-section p {
    color: #cbd5e1;
    font-size: 1.1rem;
}

/* === BOTONES === */
.btn-admin {
    background: linear-gradient(135deg, #16A34A, #22C55E);
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(22,163,74,0.3);
}
.btn-admin:hover {
    background: linear-gradient(135deg, #22C55E, #16A34A);
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 6px 14px rgba(22,163,74,0.5);
    color: #fff;
}

/* === TABLA === */
.table {
    background-color: #1B1F23;
    color: #E5E7EB;
    border-radius: 15px;
    overflow: hidden;
    text-align: center;
}
.table th {
    background-color: #252A30;
    color: #22C55E;
    font-weight: 700;
    text-transform: uppercase;
    border: none;
}
.table-hover tbody tr:hover {
    background-color: rgba(34,197,94,0.08);
    transition: background 0.3s ease;
}
.table td {
    vertical-align: middle;
    padding: 12px;
    border-color: #2a2e33;
}

/* === BOTONES TABLA === */
.btn-success, .btn-warning, .btn-info {
    border-radius: 25px;
    font-weight: 600;
    padding: 6px 14px;
    font-size: 0.9rem;
}
.btn-success {
    background: linear-gradient(135deg, #16A34A, #22C55E);
    border: none;
    color: #fff;
}
.btn-success:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(22,163,74,0.3);
}
.btn-info {
    background: linear-gradient(135deg, #0EA5E9, #06B6D4);
    border: none;
    color: #fff;
}
.btn-info:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(14,165,233,0.3);
}
.btn-warning {
    background: linear-gradient(135deg, #F59E0B, #FACC15);
    color: #1B1F23;
    border: none;
}
.btn-warning:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(250,204,21,0.3);
}

/* === MARCADOR === */
.marcador {
    display: flex;
    flex-direction: column;
    gap: 5px;
    align-items: center;
}
.marcador-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 5px 10px;
    background-color: #2a2e33;
    border-radius: 8px;
    font-weight: 600;
}
.goles-badge {
    background: linear-gradient(135deg, #22C55E, #16A34A);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: bold;
    min-width: 35px;
    text-align: center;
}

/* === EQUIPOS === */
.equipos-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.equipo-item {
    background-color: #2a2e33;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 600;
    color: #E5E7EB;
    border-left: 3px solid #22C55E;
}

/* === FASE BADGE === */
.fase-badge {
    background: linear-gradient(135deg, #8B5CF6, #A78BFA);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
}

/* === TITULO SECCION === */
.section-title {
    color: #22C55E;
    font-size: 1.8rem;
    font-weight: 700;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 25px;
    letter-spacing: 2px;
    position: relative;
    padding-bottom: 10px;
}
.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #22C55E, transparent);
}

/* === ANIMACIONES === */
@keyframes fadeIn { from {opacity: 0; transform: translateY(20px);} to {opacity: 1; transform: translateY(0);} }
.highlight { animation: fadeIn 0.8s ease-out; }

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .navbar-left img { height: 40px; }
    .hero-section h1 { font-size: 1.8rem; }
    .btn-admin { width: 100%; margin-bottom: 10px; }
    .table-responsive { font-size: 0.85rem; }
    .marcador-item { font-size: 0.85rem; }
    .btn-success, .btn-warning, .btn-info { 
        padding: 5px 10px; 
        font-size: 0.8rem; 
    }
}
</style>

<div class="container mt-4">
    <div class="hero-section">
        <h1>⚽ Gestión de Partidos</h1>
        <p>Administra y visualiza todos los partidos del torneo</p>
    </div>

    <h2 class="section-title">📋 Listado de Partidos</h2>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <a href="{{ route('partidos.create') }}" class="btn btn-admin">➕ Crear Partido</a>
    </div>

    {{-- Tabla --}}
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
                    <th>⚙️ Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partidos as $partido)
                    <tr class="{{ session('highlighted_partido_id') == $partido->id ? 'highlight' : '' }}">
                        <td><strong>{{ $partido->id }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</td>
                        <td>
                            <span class="fase-badge">{{ ucfirst($partido->fase) }}</span>
                        </td>
                        <td>
                            <div class="marcador">
                                @foreach($partido->equipos as $equipo)
                                    <div class="marcador-item">
                                        <span>{{ $equipo->nombre }}</span>
                                        <span class="goles-badge">{{ $equipo->pivot->goles ?? 0 }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $partido->jugado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $partido->jugado == 1 ? '✅ Jugado' : '⏳ Pendiente' }}
                            </span>
                        </td>
                        <td>
                            <a href="" class="btn btn-info btn-sm">
                                👁️ Ver Detalles
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            ⚠️ No hay partidos registrados
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

{{-- Mensajes de éxito / error --}}
@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ 
        icon: 'success', 
        title: '¡Éxito!', 
        text: "{{ session('success') }}", 
        confirmButtonText: 'Aceptar', 
        timer: 3000 
    });
});
</script>
@endif
@if(session('error'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ 
        icon: 'error', 
        title: '¡Error!', 
        text: "{{ session('error') }}", 
        confirmButtonText: 'Aceptar', 
        timer: 4000 
    });
});
</script>
@endif
@endsection