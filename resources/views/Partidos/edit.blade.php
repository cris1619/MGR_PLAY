@extends('layouts.app')

@section('title', 'Editar Partido')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Editar Partido</h4>
        </div>
        <form action="{{ route('partidos.update', $partido->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ $partido->fecha }}">
                </div>
                <div class="mb-3">
                    <label>Hora</label>
                    <input type="time" name="hora" class="form-control" value="{{ $partido->hora }}">
                </div>
                <div class="mb-3">
                    <label>Fase</label>
                    <input type="text" name="fase" class="form-control" value="{{ $partido->fase }}">
                </div>
                <h5>Equipos y Marcador</h5>
                @foreach($partido->equipos as $equipo)
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label>{{ $equipo->nombre }}</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="goles[{{ $equipo->id }}]" class="form-control" min="0"
                                   value="{{ $equipo->pivot->goles ?? 0 }}">
                        </div>
                    </div>
                @endforeach
                <button class="btn btn-success mt-3">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection