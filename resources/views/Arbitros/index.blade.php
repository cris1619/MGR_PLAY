@extends('layouts.app')

@section('title')
    Árbitros | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
            ⚖️ ÁRBITROS
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
        color: #ffffff;
        font-size: 2.3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-section p {
        color: #ccc;
        font-size: 1.1rem;
    }

    /* Tabla */
    .table-dark {
        background-color: #1B1F23 !important;
        color: #ffffff !important;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #23282e !important;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #1e2227 !important;
    }

    .table-striped tbody tr:hover {
        background-color: #2e353d !important;
        transition: 0.3s ease;
    }

    .table th {
        color: #ffd700 !important;
        font-weight: 700;
        text-transform: uppercase;
        border-bottom: 2px solid #ffd700 !important;
    }

    .table td {
        color: #000000ff !important;
        font-weight: 500;
        border-color: #2f343a !important;
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

    /* Título */
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
        <h1>⚖️ Gestión de Árbitros</h1>
        <p>Administra los árbitros registrados en MGR PLAY</p>
    </div>

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">⚖️ Árbitros Registrados</h2>
        <a href="{{ route('Arbitros.create') }}" class="btn-admin">➕ Crear Árbitro</a>
    </div>

    <!-- 📋 Tabla Árbitros -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped table-bordered text-center align-middle shadow-lg rounded-4 overflow-hidden">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arbitros as $arbitro)
                        <tr>
                            <td><b>{{ $arbitro->id }}</b></td>
                            <td>{{ $arbitro->nombre }}</td>
                            <td>{{ $arbitro->apellido }}</td>
                            <td>
                                <a href="{{ route('Arbitros.edit', $arbitro->id) }}" class="btn-admin btn-sm rounded-pill px-3">✏️ Editar</a>

                                <form action="{{ route('Arbitros.destroy', $arbitro->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este árbitro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-secondary btn-sm rounded-pill px-3">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">⚠️ No hay árbitros registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
@endsection
