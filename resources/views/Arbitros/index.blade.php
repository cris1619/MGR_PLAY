@extends('layouts.app')

@section('title')
    Árbitros | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            ⚖️ ÁRBITROS
        </a>
    </div>
    <a href="{{ route('welcome') }}" class="btn-volver">
        <i class="fas fa-arrow-left me-2"></i>Volver al menú
    </a>
</nav>
@endsection

@section('content')
<style>
    /* ==== ANIMACIONES ==== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glowIn {
        0% { box-shadow: 0 0 0 rgba(255,215,0,0); }
        100% { box-shadow: 0 0 20px rgba(255,215,0,0.4); }
    }

    /* ==== NAVBAR ==== */
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
        color: #ccc;
        font-size: 2.3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-section p {
        color: #ccc;
        font-size: 1.1rem;
    }


    /* ==== CONTENEDOR PRINCIPAL ==== */
    .arbitros-container {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 40px;
        max-width: 1400px;
        margin: 40px auto;
        color: #fff;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards, glowIn 1.5s ease 0.3s forwards;
    }

    /* ==== ENCABEZADO ==== */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #444;
    }

    .section-title {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.8rem;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* ==== BOTONES ==== */
    .btn-crear,
    .btn-volver,
    .btn-editar,
    .btn-eliminar {
        border: none;
        padding: 12px 28px;
        border-radius: 25px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.28s ease;
        transform-origin: center;
        cursor: pointer;
        font-size: 0.95rem;
    }

    .btn-crear,
    .btn-volver {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-crear:hover,
    .btn-volver:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        box-shadow: 0 6px 14px rgba(255,215,0,0.55);
        color: #1B1F23;
    }

    .btn-editar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.35);
        padding: 8px 20px;
        font-size: 0.85rem;
    }

    .btn-editar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        box-shadow: 0 6px 14px rgba(255,215,0,0.55);
        color: #1B1F23;
    }

    .btn-eliminar {
        background: linear-gradient(135deg, #00ff88 0%, #00ccff 100%);
        color: #1B1F23;
        box-shadow: 0 4px 8px rgba(0, 229, 204, 0.35);
        padding: 8px 20px;
        font-size: 0.85rem;
    }

    .btn-eliminar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #00d4ba 0%, #00e5cc 100%);
        box-shadow: 0 6px 14px rgba(0,229,204,0.55);
        color: #1B1F23;
    }

    /* ==== TABLA ==== */
    .table-container {
        background: linear-gradient(145deg, #252a2f 0%, #1B1F23 100%);
        border: 2px solid #2a2e33;
        border-radius: 15px;
        padding: 20px;
        overflow: hidden;
    }

    .table-custom {
        width: 100%;
        margin: 0;
        color: #fff;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead {
        background: linear-gradient(135deg, #2a2e33 0%, #1B1F23 100%);
    }

    .table-custom thead th {
        color: #ffd700 !important;
        font-weight: 700;
        text-transform: uppercase;
        padding: 18px 15px;
        border-bottom: 2px solid #ffd700;
        font-size: 0.95rem;
        letter-spacing: 1px;
    }

    .table-custom tbody tr {
        background-color: #1e2227;
        transition: all 0.3s ease;
    }

    .table-custom tbody tr:nth-of-type(even) {
        background-color: #23282e;
    }

    .table-custom tbody tr:hover {
        background-color: #2e353d;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(255,215,0,0.15);
    }

    .table-custom tbody td {
        padding: 16px 15px;
        border-bottom: 1px solid #2f343a;
        color: #fff;
        font-weight: 500;
        vertical-align: middle;
    }

    .table-custom tbody td:first-child {
        color: #ffd700;
        font-weight: 700;
    }

    /* ==== ESTADO VACÍO ==== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state i {
        font-size: 4rem;
        color: #444;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #ccc;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #888;
    }

    /* ==== ACCIONES ==== */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 768px) {
        .arbitros-container {
            padding: 20px;
            margin: 20px 12px;
        }

        .header-section {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .section-title {
            font-size: 1.4rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .table-custom {
            min-width: 600px;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-editar,
        .btn-eliminar {
            width: 100%;
        }
    }
</style>

<div class="hero-section">
        <h1>Gestión de Arbitros</h1>
        <p>Administra los arbitros registrados en MGR PLAY</p>
    </div>

<div class="arbitros-container">
    <!-- Encabezado -->
    <div class="header-section">
        <h2 class="section-title">
            <i class="fas fa-list-ul me-2"></i>Árbitros Registrados
        </h2>
        <a href="{{ route('Arbitros.create') }}" class="btn-crear">
            <i class="fas fa-plus-circle me-2"></i>Crear Árbitro
        </a>
    </div>

    <!-- Tabla -->
    <div class="table-container">
        @if($arbitros->count() > 0)
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 30%;">Nombre</th>
                        <th style="width: 30%;">Apellido</th>
                        <th style="width: 30%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arbitros as $arbitro)
                        <tr>
                            <td><strong>{{ $arbitro->id }}</strong></td>
                            <td>{{ $arbitro->nombre }}</td>
                            <td>{{ $arbitro->apellido }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('Arbitros.edit', $arbitro->id) }}" class="btn-editar">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>

                                    <form action="{{ route('Arbitros.destroy', $arbitro->id) }}" 
                                          method="POST" 
                                          class="delete-arbitro-form d-inline">
                                        @csrf
                                        <button type="button" class="btn-eliminar delete-arbitro-btn">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-user-slash"></i>
                <h3>No hay árbitros registrados</h3>
                <p>Comienza creando tu primer árbitro</p>
            </div>
        @endif
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
            confirmButtonColor: '#ffd700',
            timer: 3000,
            background: '#1B1F23',
            color: '#fff'
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
            confirmButtonColor: '#ff6b6b',
            timer: 4000,
            background: '#1B1F23',
            color: '#fff'
        });
    });
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-arbitro-btn').forEach(button => {
    button.addEventListener('click', function () {
        let form = this.closest('.delete-arbitro-form');

        Swal.fire({
            title: '¿Eliminar árbitro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#22C55E',
            cancelButtonColor: '#ff6b6b',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: '#1B1F23',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection