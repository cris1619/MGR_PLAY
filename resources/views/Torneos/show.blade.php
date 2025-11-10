@extends('layouts.app')

@section('title', 'Detalle del Torneo')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white">
            <h4>Detalle del Torneo: {{ $torneo->nombre }}</h4>
        </div>
        <div class="card-body">

            <p><strong>ID:</strong> {{ $torneo->id }}</p>
            <p><strong>Municipio:</strong> {{ $torneo->municipio->nombre ?? '-' }}</p>
            <p><strong>Tipo:</strong> {{ $torneo->tipo }}</p>
            <p><strong>Estado:</strong> {{ $torneo->estado }}</p>
            <p><strong>Fecha Inicio:</strong> {{ $torneo->fecha_inicio ?? '-' }}</p>
            <p><strong>Fecha Fin:</strong> {{ $torneo->fecha_fin ?? '-' }}</p>
            <p><strong>Número de Equipos:</strong> {{ $torneo->num_equipos ?? 0 }}</p>

            @if($torneo->tipo == 'Grupos')
                <p><strong>Cantidad de Grupos:</strong> {{ $torneo->cantidad_grupos }}</p>
                <p><strong>Equipos por Grupo:</strong> {{ $torneo->equipos_por_grupo }}</p>
                <p><strong>Clasificados por Grupo:</strong> {{ $torneo->clasificados_por_grupo }}</p>
            @elseif($torneo->tipo == 'Liguilla')
                <p><strong>Partidos por enfrentamiento:</strong> {{ $torneo->partidos_por_enfrentamiento == 2 ? 'Ida y Vuelta' : 'Solo Ida' }}</p>
            @endif

            <p><strong>Premio:</strong> {{ $torneo->premio ?? '-' }}</p>

            <hr>
            <h5>Equipos Participantes:</h5>
            <ul>
                @foreach($torneo->equipos as $equipo)
                    <li>{{ $equipo->nombre }}</li>
                @endforeach
            </ul>

            @if($torneo->tipo == 'Grupos')
                <hr>
                <h5>Grupos y Partidos:</h5>

                @foreach($torneo->grupos as $grupo)
                    <div class="mb-3">
                        <h6>{{ $grupo->nombre }}</h6>
                        <strong>Equipos:</strong>
                        <ul>
                            @foreach($grupo->equipos as $equipo)
                                <li>{{ $equipo->nombre }}</li>
                            @endforeach
                        </ul>

                        <strong>Partidos:</strong>
                        <ul>
                            @foreach($torneo->partidos->where('id_grupo', $grupo->id) as $partido)
                                @php
                                    $equiposPartido = $partido->partido_equipos;
                                @endphp

                                @if($equiposPartido && $equiposPartido->count() == 2)
                                    <li>
                                        {{ $equiposPartido[0]->equipo->nombre ?? 'Equipo Local' }}
                                        vs
                                        {{ $equiposPartido[1]->equipo->nombre ?? 'Equipo Visitante' }}
                                        - Jugado: {{ $partido->jugado ? 'Sí' : 'No' }}
                                        @if($partido->fecha)
                                            - Fecha: {{ $partido->fecha }} {{ $partido->hora }}
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            @endif

            <a href="{{ route('torneos.index') }}" class="btn btn-secondary mt-2">Volver</a>
        </div>
    </div>
</div>
@endsection
