@extends('layouts.app')

@section('title')

Editar Cancha | MGR PLAY

@endsection

@section('titleContent')

    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('canchas.index') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                🏟️ EDITAR CANCHAS
            </a>
        </div>
    </nav>



@endsection

@section('content')

<form action="{{ route('canchas.update', $canchas->id) }}" method="POST">
    @csrf

    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la cancha</label>
        <input type="text" name="nombre" id="nombre" 
               class="form-control" 
               value="{{ old('nombre', $canchas->nombre) }}" required>
    </div>

    
    <div class="mb-3">
        <label for="idMunicipio" class="form-label">Municipio</label>
        <select name="idMunicipio" id="idMunicipio" class="form-select" required>
            <option value="">Seleccione un municipio</option>
            @foreach($municipios as $municipio)
                <option value="{{ $municipio->id }}"
                    {{ old('idMunicipio', $canchas->idMunicipio) == $municipio->id ? 'selected' : '' }}>
                    {{ $municipio->nombre }}
                </option>
            @endforeach
        </select>
    </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('canchas.index') }}" class="btn btn-warning">Cancelar</a>
</form>

@endsection