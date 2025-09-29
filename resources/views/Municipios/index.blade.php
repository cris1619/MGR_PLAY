@extends('layouts.app')

@section('title')
    Municipios
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                🌍 MUNICIPIOS
            </a>
        </div>
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .municipio-card {
        background-color: #1B1F23;
        transition: transform 0.2s ease-in-out;
    }

    .municipio-card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="container mt-5">
    <h2 class="text-center text-white mb-4">🌍 Municipios Registrados</h2>

    <div class="row justify-content-center g-4">
        @foreach($municipios as $municipio)
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-4 municipio-card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white mb-3">
                            🏘️ <b>{{ $municipio->nombre }}</b>
                        </h5>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
    <div class="card shadow-lg border-0 rounded-4 municipio-card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white mb-3">
                            🏘️ <b>Crear Municipio</b>
                        </h5>
                    </div>
</div>
</div>

@endsection