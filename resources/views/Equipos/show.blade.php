@extends('layouts.app')

@section('title', 'Detalle del Equipo')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white">
            <h4>Detalle del Equipo: {{ $equipo->nombre }}</h4>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $equipo->id }}</p>
            <p><strong>Nombre:</strong> {{ $equipo->nombre }}</p>
            <p><strong>Entrenador:</strong> {{ $equipo->entrenador }}</p>
            <p><strong>Municipio:</strong> {{ $equipo->municipio->nombre ?? '-' }}</p>
            <p><strong>Estado:</strong> {{ $equipo->estado }}</p>

            <a href="{{ route('equipos.index') }}" class="btn btn-secondary mt-2">Volver</a>
        </div>
    </div>
</div>
@endsection
