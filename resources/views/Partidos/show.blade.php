@extends('layouts.app')

@section('title', 'Detalles del Partido | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            ⚽ DETALLES DEL PARTIDO
        </a>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-admin">Volver al Menú</a>
</nav>
@endsection

@section('content')
<style>
.info-card {
    background-color: #1E2126;
    padding: 25px;
    border-radius: 18px;
    color: #E5E7EB;
    box-shadow: 0 6px 18px rgba(0,0,0,0.4);
    animation: fadeIn 0.8s ease-out;
}
.info-title {
    font-size: 1.6rem;
    color: #22C55E;
    font-weight: 700;
    margin-bottom: 15px;
}
.info-item {
    padding: 12px 0;
    border-bottom: 1px solid #2f3338;
    display: flex;
    justify-content: space-between;
}
.badge-fase {
    background: linear-gradient(135deg, #8B5CF6, #A78BFA);
    padding: 6px 12px;
    border-radius: 25px;
    font-weight: 700;
    color: #fff;
}
.equipo-box {
    background-color: #2a2e33;
    padding: 14px;
    border-radius: 10px;
    margin-bottom: 12px;
}
.goles {
    background: #22C55E;
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    color: white;
}
.penal {
    background: #0EA5E9;
    padding: 4px 10px;
    border-radius: 20px;
    margin-left: 8px;
}
</style>

<div class="container mt-4">

    <h2 class="section-title">⚽ Información del Partido</h2>

    <div class="info-card mb-4">
        <div class="info-item">
            <strong>Fecha:</strong>
            <span>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</span>
        </div>

        <div class="info-item">
            <strong>Hora:</strong>
            <span>{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</span>
        </div>

        <div class="info-item">
            <strong>Fase:</strong>
            <span class="badge-fase">{{ ucfirst($partido->fase) }}</span>
        </div>

        @if($partido->id_grupo)
        <div class="info-item">
            <strong>Grupo:</strong>
            <span>Grupo {{ $partido->id_grupo }}</span>
        </div>
        @endif

        <div class="info-item">
            <strong>Estado:</strong>
            <span class="badge {{ $partido->jugado ? 'bg-success' : 'bg-danger' }}">
                {{ $partido->jugado ? 'Jugado' : 'Pendiente' }}
            </span>
        </div>

        <div class="info-item">
            <strong>Torneo:</strong>
            <span>{{ $partido->torneo->nombre }}</span>
        </div>

        <div class="info-item">
    <strong>Municipio:</strong>
    <span>{{ $partido->municipio?->nombre ?? 'Sin asignar' }}</span>
</div>

<div class="info-item">
    <strong>Cancha:</strong>
    <span>{{ $partido->cancha?->nombre ?? 'Sin asignar' }}</span>
</div>

<div class="info-item">
    <strong>Árbitro:</strong>
    <span>{{ $partido->arbitro?->nombre ?? 'Sin asignar' }}</span>
</div>

<div class="info-item">
    <strong>Torneo:</strong>
    <span>{{ $partido->torneo?->nombre ?? 'Sin asignar' }}</span>
</div>

    </div>

    <h2 class="section-title">⚽ Equipos y Marcador</h2>

    @foreach($partido->equipos as $equipo)
        <div class="equipo-box">
            <strong>{{ $equipo->nombre }}</strong>

            <div class="mt-2">
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

    <div class="text-center mt-4">
        <a href="{{ route('partidos.index') }}" class="btn btn-admin">
            ⬅️ Volver a Partidos
        </a>
    </div>

</div>
@endsection
