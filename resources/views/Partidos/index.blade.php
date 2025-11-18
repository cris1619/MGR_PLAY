@extends('layouts.app')

@section('title', 'Lista de Partidos')

@section('content')
<div class="container mt-4">
    <h2>Lista de Partidos</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Fase</th>
                <th>Equipos</th>
                <th>Marcador</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partidos as $partido)
                <tr>
                    <td>{{ $partido->id }}</td>
                    <td>{{ $partido->fecha }}</td>
                    <td>{{ $partido->hora }}</td>
                    <td>{{ $partido->fase }}</td>
                    <td>
                        @foreach($partido->equipos as $equipo)
                            {{ $equipo->nombre }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($partido->equipos as $equipo)
                            {{ $equipo->pivot->goles ?? 0 }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('partidos.edit', $partido->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection