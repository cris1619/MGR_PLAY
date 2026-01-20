@extends('layouts.app')

@section('title')
    Crear Árbitro | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('Arbitros.index') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            ⚖️ CREAR ÁRBITRO
        </a>
    </div>
</nav>
@endsection

@section('content')
<style>
.form-container {
    background: linear-gradient(145deg, #1B1F23, #252a2f);
    border: 2px solid #2a2e33;
    border-radius: 20px;
    padding: 40px;
    max-width: 700px;
    margin: 40px auto;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    transition: 0.3s ease;
}
.form-container:hover {
    box-shadow: 0 12px 28px rgba(255, 215, 0, 0.15);
    border-color: #ffd700;
}
.form-label {
    color: #ffd700;
    font-weight: 600;
    margin-bottom: 8px;
}
.form-control {
    background-color: #2a2e33;
    border: 1px solid #444;
    color: #fff;
    border-radius: 10px;
    padding: 10px 15px;
}
.form-control::placeholder {
    color: #ccc;
    opacity: 0.8;
}
.form-control:focus {
    border-color: #ffd700;
    box-shadow: 0 0 6px rgba(255, 215, 0, 0.3);
}
.btn-submit {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    color: #1B1F23;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 700;
    transition: 0.3s ease;
    box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
}
.btn-submit:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(255, 215, 0, 0.5);
}
.btn-back {
    background: linear-gradient(135deg, #00ccff, #00ff88);
    color: #1B1F23;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.3s ease;
}
.btn-back:hover {
    background: linear-gradient(135deg, #00ff88, #00ccff);
    transform: scale(1.05);
}
.section-title {
    color: #ffd700;
    text-align: center;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 30px;
}
</style>

<div class="container fade-in-up">
    <h2 class="section-title">⚖️ Registro de Nuevo Árbitro</h2>

    <div class="form-container">
        <form action="{{ route('Arbitros.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Árbitro</label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       class="form-control" 
                       placeholder="Ingrese el nombre del árbitro"
                       value="{{ old('nombre') }}" 
                       required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido del Árbitro</label>
                <input type="text" 
                       name="apellido" 
                       id="apellido" 
                       class="form-control" 
                       placeholder="Ingrese el apellido del árbitro"
                       value="{{ old('apellido') }}" 
                       required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-submit">💾 Guardar</button>
                <a href="{{ route('Arbitros.index') }}" class="btn-back ms-2">↩️ Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
