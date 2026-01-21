@extends('layouts.app')

@section('title')
    Municipios | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            🌍 MUNICIPIOS
        </a>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-admin">Volver al menú</a>
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
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .logo {
        display: flex;
        align-items: center;
        color: white;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
        color: white;
    }

    .logo img {
        height: 50px;
        margin-right: 30px;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1B1F23 0%, #2a2e33 100%);
        padding: 40px 20px;
        margin-bottom: 40px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .hero-section h1 {
        color: #fcfcfcff;
        font-size: 2.3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-section p {
        color: #ccc;
        font-size: 1.1rem;
    }

    /* Cards Municipios */
    .municipio-card {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        transition: all 0.4s ease;
        height: 100%;
        overflow: hidden;
        position: relative;
    }

    .municipio-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #00ff88, #00ccff);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .municipio-card:hover::before {
        opacity: 1;
    }

    .municipio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(255, 215, 0, 0.2);
        border-color: #ffd700;
    }

    .municipio-card .card-body {
        padding: 30px;
    }

    .card-title {
        color: #f3f3f0ff;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .card-text {
        color: #ccc;
        font-size: 0.95rem;
    }

    /* Botones */
    .btn-admin {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-admin:hover {
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(255, 215, 0, 0.5);
        color: #000;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1B1F23;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,255,136,0.4);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #00ccff 0%, #00ff88 100%);
        transform: scale(1.05);
        color: #000;
    }

    .section-title {
        color: #ffd700;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
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

<div class="container mt-4">
    <!-- Hero -->
    <div class="hero-section">
        <h1>🌍 Gestión de Municipios</h1>
        <p>Administra los municipios registrados en MGR PLAY</p>
    </div>

    
    <!-- Título + Botón -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">🏘️ Municipios Registrados</h2>
        <a href="{{ route('Municipios.create') }}" class="btn-admin">
            ➕ Crear Municipio
        </a>
    </div>

    <!-- Cards Municipios -->
    <div class="row justify-content-center g-4">
        @forelse($municipios as $municipio)
            <div class="col-md-4">
                <div class="card municipio-card shadow-lg fade-in-up">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3"> {{ $municipio->nombre }}</h5>
                        <p class="card-text">ID: <b>{{ $municipio->id }}</b></p>

                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="{{ route('municipios.edit', $municipio->id) }}" class="btn-admin">✏️ Editar</a>

                            <form action="{{ route('municipios.destroy', $municipio->id) }}" method="POST" class="delete-form">
                                @csrf
                                <button type="button" class="btn-secondary delete-btn">🗑️ Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-white mt-4">
                <h5>No hay municipios registrados aún.</h5>
            </div>
        @endforelse
    </div>

    <!-- Volver -->
    <div class="text-center mt-5">
        <a href="{{ route('welcome') }}" class="btn-admin">Volver al menú</a>
    </div>
</div>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Aceptar',
                timer: 3000
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: "{{ session('error') }}",
                confirmButtonText: 'Aceptar',
                timer: 4000
            });
        });
    </script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
        let form = this.closest('.delete-form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#22C55E',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });
});
</script>

@endsection
