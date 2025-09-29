@extends('layouts.app')

@section('title')
 Crear Municipio | MGR PLAY

@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                🌍 CREAR MUNICIPIOS
            </a>
        </div>
    </nav>
@endsection

@section('content')
 <form action="{{ route('municipios.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label" style="color: white;">Nombre del Municipio</label>
            <input type="text" 
                   name="nombre" 
                   id="nombre" 
                   class="form-control" 
                   placeholder="Ingrese el nombre" 
                   value="{{ old('nombre') }}" 
                   required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('municipios.index') }}" class="btn btn-warning">Volver</a>
    </form>
</div>

@endsection