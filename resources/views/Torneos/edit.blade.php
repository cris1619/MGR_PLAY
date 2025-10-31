@extends('layouts.app')

@section('title')
Editar Torneo | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🏆 EDITAR TORNEO
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
</style>

<div class="container mt-5">
    <div class="form-card shadow-sm">
        <h3 class="mb-4">✏️ Editar torneo</h3>

        <form method="POST" action="{{ route('torneos.update', $torneos->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <!-- Nombre -->
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $torneos->nombre }}" required>
                </div>

                <!-- Municipio -->
                <div class="col-md-6">
                    <label class="form-label">Municipio</label>
                    <select name="idMunicipio" class="form-select" required>
                        <option value="">-- Selecciona un municipio --</option>
                        @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}" {{ $torneos->idMunicipio == $municipio->id ? 'selected' : '' }}>
                            {{ $municipio->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Descripción -->
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" required>{{ $torneos->descripcion }}</textarea>
                </div>

                <!-- Logo -->
                <div class="col-md-6">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    @if($torneos->logo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $torneos->logo) }}" alt="Logo torneo" height="80">
                        </div>
                    @endif
                </div>

                <!-- Número de equipos -->
                <div class="col-md-6">
                    <label class="form-label">Número de equipos</label>
                    <input type="number" name="numeroEquipos" class="form-control" min="2" value="{{ $torneos->numeroEquipos }}" required>
                </div>

                <!-- Estado -->
                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="activo" {{ $torneos->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ $torneos->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <!-- Tipo de deporte -->
                <div class="col-md-6">
                    <label class="form-label">Tipo de deporte</label>
                    <select name="tipoDeporte" class="form-select" required>
                        <option value="FUTBOL" {{ $torneos->tipoDeporte == 'FUTBOL' ? 'selected' : '' }}>Fútbol</option>
                        <option value="FUTBOL-5" {{ $torneos->tipoDeporte == 'FUTBOL-5' ? 'selected' : '' }}>Fútbol 5</option>
                        <option value="FUTBOL-8" {{ $torneos->tipoDeporte == 'FUTBOL-8' ? 'selected' : '' }}>Fútbol 8</option>
                        <option value="MICRO-FUTBOL" {{ $torneos->tipoDeporte == 'MICRO-FUTBOL' ? 'selected' : '' }}>Microfútbol</option>
                        <option value="OTRO" {{ $torneos->tipoDeporte == 'OTRO' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <!-- Formato -->
                <div class="col-md-6">
                    <label class="form-label">Formato</label>
                    <select name="formato" class="form-select" required>
                        <option value="FASE_GRUPOS" {{ $torneos->formato == 'FASE_GRUPOS' ? 'selected' : '' }}>Fase de Grupos</option>
                        <option value="LIGUILLA" {{ $torneos->formato == 'LIGUILLA' ? 'selected' : '' }}>Liguilla</option>
                        <option value="ELIMINACION_DIRECTA" {{ $torneos->formato == 'ELIMINACION_DIRECTA' ? 'selected' : '' }}>Eliminación Directa</option>
                        <option value="MIXTO" {{ $torneos->formato == 'MIXTO' ? 'selected' : '' }}>Mixto</option>
                    </select>
                </div>

                <!-- Fechas -->
                <div class="col-md-6">
                    <label class="form-label">Fecha de inicio</label>
                    <input type="date" name="fechaInicio" class="form-control" value="{{ $torneos->fechaInicio }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fecha de fin</label>
                    <input type="date" name="fechaFin" class="form-control" value="{{ $torneos->fechaFin }}" required>
                </div>

                <!-- Reglas -->
                <div class="col-md-12">
                    <label class="form-label">Reglas del torneo</label>
                    <textarea name="reglas" class="form-control" rows="3" >{{ $torneos->reglas }}</textarea>
                </div>

                <!-- Premio -->
                <div class="col-md-6">
                    <label class="form-label">Premio</label>
                    <input type="number" name="premio" step="0.01" class="form-control" value="{{ $torneos->premio }}">
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('torneos.index') }}" class="btn btn-warning">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
