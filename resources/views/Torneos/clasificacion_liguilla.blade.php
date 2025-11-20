@extends('layouts.app')

@section('content')

<h2 class="mb-4">Clasificación – {{ $torneo->nombre }}</h2>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
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
        @foreach($clasificacion as $fila)
            <tr>
                <td>{{ $fila->equipo->nombre }}</td>
                <td>{{ $fila->partidos_jugados }}</td>
                <td>{{ $fila->ganados }}</td>
                <td>{{ $fila->empatados }}</td>
                <td>{{ $fila->perdidos }}</td>
                <td>{{ $fila->goles_favor }}</td>
                <td>{{ $fila->goles_contra }}</td>
                <td>{{ $fila->goles_favor - $fila->goles_contra }}</td>
                <td><strong>{{ $fila->puntos }}</strong></td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
