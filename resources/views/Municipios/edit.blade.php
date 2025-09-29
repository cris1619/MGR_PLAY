@extends('layouts.app')

@section('title')
 Editar Municipio | MGR PLAY

@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                🌍 EDITAR MUNICIPIO
            </a>
        </div>
    </nav>
@endsection

@section('content')
    <form action="{{ route('municipios.update', $municipio->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Municipio</label>
            <input type="text" 
                   name="nombre" 
                   id="nombre" 
                   class="form-control" 
                   placeholder="Ingrese el nombre" 
                   value="{{ old('nombre', $municipio->nombre) }}" 
                   required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('municipios.index') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>

@endsection