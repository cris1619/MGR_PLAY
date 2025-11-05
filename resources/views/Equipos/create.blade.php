@extends('layouts.app')

@section('title')
    Crear Equipo | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('equipos.index') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
                👥 CREAR EQUIPO
            </a>
        </div>
    </nav>
@endsection

@section('content')
<style>
/* ====== ESTILOS HEREDADOS Y FORMULARIO ====== */
.form-container {
    background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
    border: 2px solid #2a2e33;
    border-radius: 20px;
    padding: 40px;
    max-width: 700px;
    margin: 40px auto;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
.form-container:hover {
    box-shadow: 0 12px 28px rgba(255, 215, 0, 0.15);
    transform: translateY(-5px);
    border-color: #ffd700;
}

.form-label {
    color: #ffd700;
    font-weight: 600;
    margin-bottom: 8px;
}

.form-control, .form-select {
    background-color: #2a2e33;
    border: 1px solid #444;
    color: #fff;
    border-radius: 10px;
    padding: 10px 15px;
    transition: border-color 0.3s ease;
}
.form-control:focus, .form-select:focus {
    border-color: #ffd700;
    box-shadow: 0 0 6px rgba(255, 215, 0, 0.3);
    outline: none;
}

.btn-submit {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
    color: #1B1F23;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
}
.btn-submit:hover {
    background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(255, 215, 0, 0.5);
    color: #000;
}

.btn-back {
    background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
    color: #1B1F23;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 255, 136, 0.3);
    text-decoration: none;
}
.btn-back:hover {
    background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 255, 136, 0.5);
    color: #000;
}

h2.section-title {
    color: #ffd700;
    text-align: center;
    font-size: 1.8rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 30px;
    letter-spacing: 2px;
    position: relative;
}
h2.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
}
</style>

<div class="container fade-in-up">
    <h2 class="section-title">⚽ Registro de Nuevo Equipo</h2>

    <div class="form-container">
        <form action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del equipo</label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       class="form-control" 
                       value="{{ old('nombre') }}" 
                       placeholder="Ingrese el nombre del equipo"
                       required>
            </div>

            <div class="mb-3">
                <label for="escudo" class="form-label">Escudo del equipo</label>
                <input type="file" 
                       name="escudo" 
                       id="escudo" 
                       class="form-control"
                       accept="image/*"
                       required>
            </div>

            <div class="mb-3">
                <label for="entrenador" class="form-label">Entrenador</label>
                <input type="text" 
                       name="entrenador" 
                       id="entrenador" 
                       class="form-control" 
                       value="{{ old('entrenador') }}" 
                       placeholder="Ingrese el nombre del entrenador"
                       required>
            </div>

            <div class="mb-3">
                <label for="idMunicipio" class="form-label">Municipio</label>
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

            <div class="mb-4">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="">Seleccione un estado</option>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-submit">💾 Guardar</button>
                <a href="{{ route('equipos.index') }}" class="btn-back ms-2">↩️ Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
