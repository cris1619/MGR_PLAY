@extends('layouts.app')

@section('title')

Crear Canchas | MGR PLAY

@endsection

@section('titleContent')

    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('canchas.index') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                🏟️ CREAR CANCHAS
            </a>
        </div>
    </nav>

@endsection

@section('content')

<form action="{{ route('canchas.store') }}" method="POST">
    @csrf
    
    
    <div class="mb-3">
        <label for="nombre" class="form-label" style="color: white;">Nombre de la cancha</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
    </div>

    
    <div class="mb-3">
        <label for="idMunicipio" class="form-label" style="color: white;">Municipio</label>
        <select name="idMunicipio" id="idMunicipio" class="form-select" required>
            <option value="">Seleccione un municipio</option>
            @foreach($municipios as $municipio)
                <option value="{{ $municipio->id }}" 
                    {{ old('idMunicipio') == $municipio->id ? 'selected' : '' }}>
                    {{ $municipio->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('canchas.index') }}" class="btn btn-warning">Volver</a>
</form>


@endsection