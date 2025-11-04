@extends('layouts.app')

@section('title')
    Editar Equipo | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('equipos.index') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
                👥 EDITAR EQUIPO
            </a>
        </div>
    </nav>
@endsection

@section('content')
<style>
    /* Reutiliza el estilo de la vista principal */
    body {
        background-color: #121518;
    }

    .form-container {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.4);
        color: white;
        max-width: 700px;
        margin: 50px auto;
        border: 2px solid #2a2e33;
        animation: fadeInUp 0.6s ease forwards;
    }

    .form-container h2 {
        text-align: center;
        color: #ffd700;
        font-weight: 700;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-label {
        font-weight: 600;
        color: #ffd700;
    }

    .form-control, .form-select {
        background-color: #1b1f23;
        border: 1px solid #2a2e33;
        color: white;
        border-radius: 10px;
        padding: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ffd700;
        box-shadow: 0 0 8px rgba(255,215,0,0.4);
    }

    .preview-img {
        border-radius: 50%;
        border: 2px solid #ffd700;
        margin-top: 10px;
        transition: transform 0.3s ease;
    }

    .preview-img:hover {
        transform: scale(1.05);
    }

    .btn-guardar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        font-weight: 700;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        box-shadow: 0 4px 8px rgba(255,215,0,0.3);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-guardar:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255,215,0,0.5);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        color: #000;
    }

    .btn-volver {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        color: #1B1F23;
        font-weight: 700;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0, 255, 136, 0.3);
    }

    .btn-volver:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 255, 136, 0.5);
        color: #000;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="form-container">
    <h2>✏️ Editar Equipo</h2>

    <form action="{{ route('equipos.update', $equipos->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
    

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del equipo</label>
            <input type="text" 
                   name="nombre" 
                   id="nombre" 
                   class="form-control" 
                   value="{{ old('nombre', $equipos->nombre) }}" 
                   required>
        </div>

        <div class="mb-3">
            <label for="escudo" class="form-label">Escudo del equipo</label>
            <input type="file" 
                   name="escudo" 
                   id="escudo" 
                   class="form-control"
                   accept="image/*">
            @if($equipos->escudo)
                <div class="mt-3 text-center">
                    <img src="{{ asset('storage/' . $equipos->escudo) }}" 
                         alt="Escudo {{ $equipos->nombre }}" 
                         width="90" height="90" 
                         class="preview-img">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="entrenador" class="form-label">Entrenador</label>
            <input type="text" 
                   name="entrenador" 
                   id="entrenador" 
                   class="form-control" 
                   value="{{ old('entrenador', $equipos->entrenador) }}" 
                   required>
        </div>

        <div class="mb-3">
            <label for="idMunicipio" class="form-label">Municipio</label>
            <select name="idMunicipio" id="idMunicipio" class="form-select" required>
                <option value="">Seleccione un municipio</option>
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}" 
                        {{ old('idMunicipio', $equipos->idMunicipio) == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="">Seleccione un estado</option>
                <option value="activo" {{ old('estado', $equipos->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('estado', $equipos->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn-guardar me-2">💾 Actualizar</button>
            <a href="{{ route('equipos.index') }}" class="btn-volver">↩️ Volver</a>
        </div>
    </form>
</div>

@endsection
