@extends('layouts.app')

@section('title', 'Programar Partido')

@section('content')
<div class="container mt-4">
    <h3>Programar Partido #{{ $partido->id }}</h3>
    <form action="{{ route('partidos.schedule.update', $partido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $partido->fecha) }}">
        </div>

        <div class="mb-3">
            <label>Hora</label>
            <input type="time" name="hora" class="form-control" value="{{ old('hora', $partido->hora) }}">
        </div>

        <div class="mb-3">
            <label>Fase</label>
            <input type="text" name="fase" class="form-control" value="{{ old('fase', $partido->fase) }}">
        </div>

        <div class="mb-3">
            <label>Lugar</label>
            <input type="text" name="lugar" class="form-control" value="{{ old('lugar', $partido->lugar) }}">
        </div>

        <div class="mb-3">
            <label>Cancha</label>
            <input type="text" name="cancha" class="form-control" value="{{ old('cancha', $partido->cancha) }}">
        </div>

        <div class="mb-3">
            <label>Árbitro</label>
            <select name="arbitro_id" class="form-select">
                <option value="">-- Seleccionar árbitro --</option>
                @foreach($arbitros as $arb)
                    <option value="{{ $arb->id }}" {{ old('arbitro_id', $partido->arbitro_id) == $arb->id ? 'selected' : '' }}>
                        {{ $arb->nombre }} {{ $arb->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Guardar programación</button>
    </form>
</div>
@endsection