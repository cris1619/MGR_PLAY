@extends('layouts.app')

@section('title')
Crear Torneo | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🏆 NUEVO TORNEO
        </a>
    </div>
    <a href="{{ route('torneos.index') }}" class="btn btn-secondary">Volver a torneos</a>
</nav>
@endsection

@section('content')
<style>
    .navbar {
        background-color: #1B1F23;
        padding: 0 20px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-card {
        background-color: #1B1F23;
        border-radius: 15px;
        padding: 25px 30px;
        margin-bottom: 25px;
        color: white;
    }

    .form-select,
    .form-control {
        border-radius: 15px;
        font-size: 14px;
    }

    .btn-primary {
        border-radius: 20px;
    }

    
</style>

<div class="container mt-5">
    <div class="form-card shadow-sm">
        <h3 class="mb-4">➕ Registrar nuevo torneo</h3>

        <form method="POST" action="{{ route('torneos.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <!-- Nombre -->
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- Municipio -->
                <div class="col-md-6">
                    <label class="form-label">Municipio</label>
                    <select name="idMunicipio" class="form-select" required>
                        <option value="">-- Selecciona un municipio --</option>
                        @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Descripción -->
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Logo -->
                <div class="col-md-6">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>
                
                <!-- Tipo de deporte -->

                <div class="col-md-6">
                    <label class="form-label">Tipo de deporte</label>
                    <select name="tipoDeporte" class="form-select" required>
                        <option value="FUTBOL">Fútbol</option>
                        <option value="FUTBOL-5">Fútbol 5</option>
                        <option value="FUTBOL-8">Fútbol 8</option>
                        <option value="MICRO-FUTBOL">Microfútbol</option>
                        <option value="OTRO">Otro</option>
                    </select>
                </div>

                <!-- Formato -->
                <div class="col-md-6">
                    <label class="form-label">Formato</label>
                    <select name="formato" class="form-select" required>
                        <option value="FASE_GRUPOS">Fase de Grupos</option>
                        <option value="LIGUILLA">Liguilla</option>
                        <option value="ELIMINACION_DIRECTA">Eliminación Directa</option>
                        <option value="MIXTO">Mixto</option>
                    </select>
                </div>

                <!-- Número de equipos -->
                 <div class="col-md-6">
                    <label class="form-label">Número de equipos</label>
                    <select name="numeroEquipos" class="form-select" required>
                        <option value="4">4</option>
                        <option value="8">8</option>
                        <option value="12">12</option>
                        <option value="16">16</option>
                        <option value="20">20</option>
                        <option value="24">24</option>
                        <option value="28">28</option>
                        <option value="32">32</option>
                        <option value="OTRO">Otro</option>
                    </select>
                </div>


                <!-- Estado -->
                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                
                <!-- Fechas -->
                <div class="col-md-6">
                    <label class="form-label">Fecha de inicio</label>
                    <input type="date" name="fechaInicio" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fecha de fin</label>
                    <input type="date" name="fechaFin" class="form-control" required>
                </div>

                <!-- Reglas -->
                <div class="col-md-12">
                    <label class="form-label">Reglas del torneo</label>
                    <textarea name="reglas" class="form-control" rows="3"></textarea>
                </div>

                <!-- Premio -->
                <div class="col-md-6">
                    <label class="form-label">Premio</label>
                    <input type="number" name="premio" step="0.01" class="form-control">
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('torneos.index') }}" class="btn btn-warning">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
