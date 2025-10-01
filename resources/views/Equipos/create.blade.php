@extends('layouts.app')

@section('title')
    Crear Equipo | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                👥 CREAR EQUIPO
            </a>
        </div>
    </nav>
@endsection

@section('content')

<form action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label for="nombre" class="form-label" style="color: white;">Nombre del equipo</label>
        <input type="text" 
               name="nombre" 
               id="nombre" 
               class="form-control" 
               value="{{ old('nombre') }}" 
               placeholder="Ingrese el nombre del equipo"
               required>
    </div>

    <div class="mb-3">
        <label for="escudo" class="form-label" style="color: white;">Escudo del equipo</label>
        <input type="file" 
               name="escudo" 
               id="escudo" 
               class="form-control"
               accept="image/*"
               required>
    </div>

    <div class="mb-3">
        <label for="entrenador" class="form-label" style="color: white;">Entrenador</label>
        <input type="text" 
               name="entrenador" 
               id="entrenador" 
               class="form-control" 
               value="{{ old('entrenador') }}" 
               placeholder="Ingrese el nombre del entrenador"
               required>
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

    <div class="mb-3">
        <label for="estado" class="form-label" style="color: white;">Estado</label>
        <select name="estado" id="estado" class="form-select" required>
            <option value="">Seleccione un estado</option>
            <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('equipos.index') }}" class="btn btn-warning">Volver</a>
</form>

@endsection
