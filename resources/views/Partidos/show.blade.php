@extends('layouts.app')

@section('title', 'Detalles del Partido | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('usuario.vistaUsuario') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            ⚽ DETALLES DEL PARTIDO
        </a>
    </div>
    <a href="{{ route('usuario.listaPartidos') }}" class="btn btn-primary-mgr">🏠 Volver al Menú</a>
</nav>
@endsection

@section('content')
<style>
/* Estilos Base de la Navbar (Ajuste Necesario) */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px; /* Asegura un buen padding en la navbar */
    background-color: #1a1d21; /* Color de fondo oscuro si no está definido en 'layouts.app' */
}

.logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    font-size: 1.2rem;
    color: #E5E7EB;
    font-weight: 700;
}

/* --- AJUSTES DEL LOGO: Más pequeño y Responsive --- */
.logo img {
    /* Tamaño por defecto para escritorio/móvil */
    height: 40px; 
    width: auto;
    margin-right: 10px;
    transition: all 0.3s ease; /* Transición suave para cualquier cambio */
}

/* Media Query para hacerlo más pequeño en pantallas grandes (Escritorio) */
@media (min-width: 768px) {
    .logo img {
        height: 35px; /* Ligeramente más pequeño en escritorio para no ser intrusivo */
    }
}

/* Media Query para hacerlo un poco más pequeño en pantallas muy pequeñas (Móvil) */
@media (max-width: 480px) {
    .logo img {
        height: 30px; /* Aún más pequeño en móvil */
        margin-right: 5px;
    }
    .logo {
        font-size: 1rem; /* También reducimos el texto que acompaña al logo */
    }
}
/* --- FIN AJUSTES DEL LOGO --- */


/* Resto de Estilos (Mantenidos) */
.container.mt-4 {
    max-width: 900px;
    margin: 30px auto;
}
.section-title {
    font-size: 1.8rem;
    color: #FACC15;
    font-weight: 800;
    margin-bottom: 25px;
    border-bottom: 3px solid rgba(250, 204, 21, 0.3);
    padding-bottom: 8px;
}
.info-card {
    background-color: #1E2126;
    padding: 30px;
    border-radius: 18px;
    color: #E5E7EB;
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
    animation: fadeIn 0.8s ease-out;
    border: 1px solid #2f3338;
}
.info-item {
    padding: 15px 0;
    border-bottom: 1px solid #2f3338;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.05rem;
}
.info-item strong {
    color: #9CA3AF;
    font-weight: 600;
}
.badge-fase {
    background: linear-gradient(45deg, #8B5CF6, #C4B5FD);
    padding: 7px 15px;
    border-radius: 25px;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 4px 8px rgba(139, 92, 246, 0.4);
}
.equipo-box {
    background-color: #2a2e33;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-left: 5px solid #22C55E;
    transition: transform 0.2s;
}
.equipo-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.5);
}
.equipo-box strong {
    font-size: 1.4rem;
    color: #E5E7EB;
    flex-grow: 1;
}
.marcador-goles {
    display: flex;
    align-items: center;
    gap: 10px;
}
.goles {
    background: #22C55E;
    padding: 8px 16px;
    border-radius: 30px;
    font-weight: 800;
    color: #1E2126;
    font-size: 1.1rem;
    min-width: 100px;
    text-align: center;
}
.penal {
    background: #0EA5E9;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 700;
    color: white;
    font-size: 0.95rem;
}
.badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.95rem;
}
.bg-success { background-color: #10B981 !important; }
.bg-danger { background-color: #EF4444 !important; }

/* Estilo para los botones (Mantenidos) */
.btn-primary-mgr {
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    background: linear-gradient(90deg, #22C55E 0%, #10B981 100%);
    color: #1E2126;
    border: none;
    font-size: 1rem;
}
.btn-primary-mgr:hover {
    background: linear-gradient(90deg, #10B981 0%, #059669 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(34, 197, 94, 0.5);
    color: white;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="container mt-4">

    <h2 class="section-title">⚽ Información del Partido</h2>

    <div class="info-card mb-4">
        <div class="info-item">
            <strong>📅 Fecha:</strong>
            <span>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</span>
        </div>
        <div class="info-item">
            <strong>⏰ Hora:</strong>
            <span>{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }} hrs</span>
        </div>
        <div class="info-item">
            <strong>🏆 Fase:</strong>
            <span class="badge-fase">{{ ucfirst($partido->fase) }}</span>
        </div>
        @if($partido->id_grupo)
        <div class="info-item">
            <strong>🔢 Grupo:</strong>
            <span>Grupo {{ $partido->id_grupo }}</span>
        </div>
        @endif
        <div class="info-item">
            <strong>🟢 Estado:</strong>
            <span class="badge {{ $partido->jugado ? 'bg-success' : 'bg-danger' }}">
                {{ $partido->jugado ? 'Jugado' : 'Pendiente' }}
            </span>
        </div>
        <div class="info-item">
            <strong>🏅 Torneo:</strong>
            <span>{{ $partido->torneo?->nombre ?? 'Sin asignar' }}</span>
        </div>
        <div class="info-item">
            <strong>📍 Municipio:</strong>
            <span>{{ $partido->municipio?->nombre ?? 'Sin asignar' }}</span>
        </div>
        <div class="info-item">
            <strong>🏟️ Cancha:</strong>
            <span>{{ $partido->cancha?->nombre ?? 'Sin asignar' }}</span>
        </div>
        <div class="info-item" style="border-bottom: none;">
            <strong>👨‍⚖️ Árbitro:</strong>
            <span>{{ $partido->arbitro?->nombre ?? 'Sin asignar' }}</span>
        </div>
    </div>

    <h2 class="section-title">⚽ Equipos y Marcador</h2>

    @foreach($partido->equipos as $equipo)
        <div class="equipo-box">
            <strong>{{ $equipo->nombre }}</strong>
            <div class="marcador-goles">
                <span class="goles">
                    Goles: {{ $equipo->pivot->goles ?? 0 }}
                </span>
                @if($equipo->pivot->penales !== null)
                    <span class="penal">
                        Penales: {{ $equipo->pivot->penales }}
                    </span>
                @endif
            </div>
        </div>
    @endforeach

    <div class="text-center mt-5">
        <a href="{{ route('usuario.listaPartidos') }}" class="btn btn-primary-mgr">
            ⬅️ Volver a Partidos
        </a>
    </div>

</div>
@endsection