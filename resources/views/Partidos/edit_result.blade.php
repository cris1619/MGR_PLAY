@extends('layouts.app')

@section('title', 'Registrar Resultado')

@section('content')
<div class="container mt-4">
    <h3>Resultado Partido #{{ $partido->id }}</h3>
    <form action="{{ route('partidos.result.update', $partido->id) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach($partido->equipos as $equipo)
        <div class="mb-3">
            <label class="form-label">{{ $equipo->nombre }}</label>
            <input type="number" name="goles[{{ $equipo->id }}]" class="form-control" min="0"
                   value="{{ old('goles.'.$equipo->id, $equipo->pivot->goles ?? 0) }}">
        </div>
        @endforeach

        <button class="btn btn-success">Registrar resultado</button>
    </form>
</div>
@endsection