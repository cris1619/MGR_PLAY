@extends('layouts.app')

@section('title', 'Lista de Partidos')

@section('content')
<div class="container mt-4">
    <h2>Lista de Partidos</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cancha</th>
                <th>Árbitro</th>
                <th>Fase</th>
                <th>Equipos</th>
                <th>Marcador</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partidos as $partido)
                <tr>
                    <td>{{ $partido->id }}</td>
                    <td>{{ $partido->fecha ? \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $partido->hora ?? 'N/A' }}</td>
                    <td>{{ $partido->cancha->nombre ?? 'No asignada' }}</td>
                    <td>{{ $partido->arbitro->nombre ?? 'No asignado' }}</td>
                    <td>{{ $partido->fase }}</td>
                    <td>
                        @foreach($partido->equipos as $equipo)
                            <span class="badge bg-info">{{ $equipo->nombre }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($partido->equipos as $equipo)
                            {{ $equipo->pivot->goles ?? 0 }}<br>
                        @endforeach
                    </td>
                    <td>
                        @if($partido->jugado)
                            <span class="badge bg-success">Jugado ✓</span>
                        @else
                            <span class="badge bg-warning">Por jugar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('partidos.edit', $partido->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection