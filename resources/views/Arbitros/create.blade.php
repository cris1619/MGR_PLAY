@extends('layouts.app')

@section('title')
 Crear Arbitro | MGR PLAY

@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('Arbitros.index') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                ⚖️ CREAR ARBITROS
            </a>
        </div>
    </nav>
@endsection

@section('content')
 <form action="{{ route('Arbitros.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label" style="color: white;">Nombre del Arbitro</label>
            <input type="text" 
                   name="nombre" 
                   id="nombre" 
                   class="form-control" 
                   placeholder="Ingrese el nombre" 
                   value="{{ old('nombre') }}" 
                   required>
        </div>

                <div class="mb-3">
            <label for="apellido" class="form-label" style="color: white;">Apellido del Arbitro</label>
            <input type="text" 
                   name="apellido" 
                   id="apellido" 
                   class="form-control" 
                   placeholder="Ingrese el apellido" 
                   value="{{ old('apellido') }}" 
                   required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('Arbitros.index') }}" class="btn btn-warning">Volver</a>
    </form>
</div>

@endsection