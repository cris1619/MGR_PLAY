@extends('layouts.app')

@section('title', 'Equipos | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            👥 EQUIPOS
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

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 10px rgba(255,215,0,0.3); }
        50% { box-shadow: 0 0 20px rgba(255,215,0,0.6); }
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

    /* ==== CONTENEDOR PRINCIPAL ==== */
    .equipos-container {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 40px;
        max-width: 1600px;
        margin: 40px auto;
        color: #fff;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards, glowIn 1.5s ease 0.3s forwards;
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
    .btn-eliminar,
    .btn-buscar,
    .btn-limpiar {
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
    .btn-volver,
    .btn-buscar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-crear:hover,
    .btn-volver:hover,
    .btn-buscar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        box-shadow: 0 6px 14px rgba(255,215,0,0.55);
        color: #1B1F23;
    }

    .btn-limpiar {
        background: linear-gradient(135deg, #2a2e33 0%, #1B1F23 100%);
        color: #ffd700;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        border: 2px solid #444;
    }

    .btn-limpiar:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #1B1F23 0%, #2a2e33 100%);
        box-shadow: 0 6px 14px rgba(255,215,0,0.35);
        color: #ffd700;
        border-color: #ffd700;
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

    /* ==== FILTROS ==== */
    .filter-container {
        background: linear-gradient(145deg, #252a2f 0%, #1B1F23 100%);
        border: 2px solid #2a2e33;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        animation: slideInRight 0.6s ease forwards;
    }

    .filter-title {
        color: #ffd700;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-label {
        color: #ffd700;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: block;
    }

    .form-control,
    .form-select {
        background-color: #1e2227;
        border: 2px solid #2a2e33;
        border-radius: 12px;
        color: #fff;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #23282e;
        border-color: #ffd700;
        box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.15);
        color: #fff;
    }

    .form-control::placeholder {
        color: #888;
    }

    .input-group-text {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        border: none;
        font-weight: 700;
        border-radius: 12px 0 0 12px;
    }

    .input-group .form-control {
        border-radius: 0 12px 12px 0;
    }

    /* ==== ALERTAS DE FILTROS ==== */
    .filter-alert {
        background: linear-gradient(135deg, #2a2e33 0%, #1e2227 100%);
        border: 2px solid #ffd700;
        border-radius: 12px;
        padding: 15px 25px;
        margin-bottom: 20px;
        color: #fff;
        text-align: center;
        font-weight: 600;
        animation: fadeInUp 0.5s ease;
    }

    .filter-alert i {
        color: #ffd700;
        margin-right: 8px;
    }

    .filter-alert b {
        color: #ffd700;
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
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-align: center;
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
        transform: scale(1.005);
        box-shadow: 0 4px 12px rgba(255,215,0,0.15);
    }

    .table-custom tbody tr.highlight {
        animation: pulseGlow 2s ease-in-out 3;
    }

    .table-custom tbody td {
        padding: 16px 15px;
        border-bottom: 1px solid #2f343a;
        color: #fff;
        font-weight: 500;
        vertical-align: middle;
        text-align: center;
    }

    .table-custom tbody td:first-child {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.1rem;
    }

    /* ==== ESCUDO ==== */
    .escudo-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .escudo-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #ffd700;
        box-shadow: 0 4px 8px rgba(255,215,0,0.3);
        transition: all 0.3s ease;
    }

    .escudo-img:hover {
        transform: scale(1.15) rotate(5deg);
        box-shadow: 0 6px 12px rgba(255,215,0,0.5);
    }

    .sin-escudo {
        color: #888;
        font-style: italic;
        font-size: 0.85rem;
    }

    /* ==== BADGES ==== */
    .badge-estado {
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-activo {
        background: linear-gradient(135deg, #00ff88 0%, #00e5cc 100%);
        color: #1B1F23;
        box-shadow: 0 2px 6px rgba(0, 255, 136, 0.3);
    }

    .badge-inactivo {
        background: linear-gradient(135deg, #ff5555 0%, #ff8888 100%);
        color: #fff;
        box-shadow: 0 2px 6px rgba(255, 85, 85, 0.3);
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
        font-size: 1.5rem;
    }

    .empty-state p {
        color: #888;
        font-size: 1rem;
    }

    /* ==== ACCIONES ==== */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    /* ==== PAGINACIÓN ==== */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #2a2e33;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 1200px) {
        .table-custom thead th,
        .table-custom tbody td {
            font-size: 0.8rem;
            padding: 12px 10px;
        }

        .escudo-img {
            width: 45px;
            height: 45px;
        }
    }

    @media (max-width: 768px) {
        .equipos-container {
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

        .filter-container {
            padding: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table-custom {
            min-width: 900px;
        }


        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-editar,
        .btn-eliminar {
            width: 100%;
        }

        .filter-title {
            font-size: 1rem;
        }
    }
</style>

<div class="hero-section">
        <h1>Gestión de Equipos</h1>
        <p>Administra los equipos registrados en MGR PLAY</p>
    </div>

<div class="equipos-container">
    <!-- Encabezado -->
    <div class="header-section">
        <h2 class="section-title">
            <i class="fas fa-shield-alt me-2"></i>Equipos Registrados
        </h2>
        <a href="{{ route('equipos.create') }}" class="btn-crear">
            <i class="fas fa-plus-circle me-2"></i>Crear Equipo
        </a>
    </div>

    <!-- Filtros -->
    <div class="filter-container">
        <div class="filter-title">
            <i class="fas fa-filter"></i>
            Filtros de Búsqueda
        </div>
        <form method="GET" action="{{ route('equipos.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">
                    <i class="fas fa-city me-1"></i>Municipio
                </label>
                <select name="IdMunicipio" class="form-select">
                    <option value="">-- Todos los municipios --</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}" {{ request('IdMunicipio') == $municipio->id ? 'selected' : '' }}>
                            {{ $municipio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">
                    <i class="fas fa-search me-1"></i>Nombre
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-shield-alt"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Buscar equipo..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-2">
                <label class="form-label">
                    <i class="fas fa-list-ol me-1"></i>Mostrar
                </label>
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="all" {{ $perPage == 'all' ? 'selected' : '' }}>Todos</option>
                </select>
            </div>

            <div class="col-md-4 d-flex gap-3 align-items-end">
                <button type="submit" class="btn-buscar flex-fill">
                    <i class="fas fa-search me-2"></i>Buscar
                </button>
                <a href="{{ route('equipos.index') }}" class="btn-limpiar flex-fill">
                    <i class="fas fa-eraser me-2"></i>Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Alertas de filtros activos -->
    @if(request('IdMunicipio'))
        <div class="filter-alert">
            <i class="fas fa-info-circle"></i>
            Mostrando equipos en: <b>{{ $municipios->find(request('IdMunicipio'))->nombre }}</b>
        </div>
    @endif
    
    @if(request('search'))
        <div class="filter-alert">
            <i class="fas fa-search"></i>
            Resultados de búsqueda para: <b>{{ request('search') }}</b>
        </div>
    @endif

    <!-- Tabla -->
    <div class="table-container">
        @if($equipos->count() > 0 || ($perPage === 'all' && count($equipos) > 0))
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 10%;">Escudo</th>
                        <th style="width: 20%;">Nombre</th>
                        <th style="width: 18%;">Entrenador</th>
                        <th style="width: 15%;">Municipio</th>
                        <th style="width: 10%;">Estado</th>
                        <th style="width: 22%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(($perPage === 'all' ? $equipos : $equipos) as $equipo)
                        <tr class="{{ session('highlighted_equipo_id') == $equipo->id ? 'highlight' : '' }}">
                            <td><strong>{{ $equipo->id }}</strong></td>
                            <td>
                                <div class="escudo-container">
                                    @if($equipo->escudo)
                                        <img src="{{ asset('storage/public/escudos/' . $equipo->escudo) }}" 
                                             alt="Escudo {{ $equipo->nombre }}" 
                                             class="escudo-img">
                                    @else
                                        <span class="sin-escudo">
                                            <i class="fas fa-image-slash"></i> Sin escudo
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td><strong>{{ $equipo->nombre }}</strong></td>
                            <td>{{ $equipo->entrenador }}</td>
                            <td>{{ $equipo->municipio->nombre ?? 'Sin asignar' }}</td>
                            <td>
                                <span class="badge-estado {{ $equipo->estado === 'activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                    {{ ucfirst($equipo->estado) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn-editar">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>

                                    <form action="{{ route('equipos.destroy', $equipo->id) }}" 
                                          method="POST" 
                                          class="delete-equipo-form d-inline">
                                        @csrf
                                        <button type="button" class="btn-eliminar delete-equipo-btn">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($perPage !== 'all')
                <div class="pagination-container">
                    {{ $equipos->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-users-slash"></i>
                <h3>No hay equipos registrados</h3>
                <p>Comienza creando tu primer equipo o ajusta los filtros de búsqueda</p>
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
document.querySelectorAll('.delete-equipo-btn').forEach(button => {
    button.addEventListener('click', function () {
        let form = this.closest('.delete-equipo-form');

        Swal.fire({
            title: '¿Eliminar equipo?',
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