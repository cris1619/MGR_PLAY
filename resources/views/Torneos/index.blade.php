@extends('layouts.app')

@section('title', 'Torneos | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            🏆 TORNEOS
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
    .torneos-container {
        background: linear-gradient(145deg, #1B1F23 0%, #252a2f 100%);
        border: 2px solid #2a2e33;
        border-radius: 20px;
        padding: 40px;
        max-width: 1800px;
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
    .btn-ver,
    .btn-editar,
    .btn-eliminar {
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.28s ease;
        transform-origin: center;
        cursor: pointer;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .btn-crear,
    .btn-volver {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
        padding: 12px 28px;
        font-size: 0.95rem;
    }

    .btn-crear:hover,
    .btn-volver:hover {
        transform: scale(1.06);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        box-shadow: 0 6px 14px rgba(255,215,0,0.55);
        color: #1B1F23;
    }

    .btn-ver {
        background: linear-gradient(135deg, #00ccff 0%, #0099ff 100%);
        color: #fff;
        box-shadow: 0 2px 4px rgba(0, 204, 255, 0.3);
        padding: 7px 14px;
        font-size: 0.75rem;
    }

    .btn-ver:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #00d4ff 0%, #00aaff 100%);
        box-shadow: 0 4px 10px rgba(0,204,255,0.5);
        color: #fff;
    }

    .btn-editar {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1B1F23;
        box-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
        padding: 7px 14px;
        font-size: 0.75rem;
    }

    .btn-editar:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        box-shadow: 0 4px 10px rgba(255,215,0,0.5);
        color: #1B1F23;
    }

    .btn-eliminar {
        background: linear-gradient(135deg, #ff5555 0%, #ff8888 100%);
        color: #fff;
        box-shadow: 0 2px 4px rgba(255, 85, 85, 0.3);
        padding: 7px 14px;
        font-size: 0.75rem;
    }

    .btn-eliminar:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #ff6666 0%, #ff9999 100%);
        box-shadow: 0 4px 10px rgba(255,85,85,0.5);
        color: #fff;
    }

    /* ==== TABLA ==== */
    .table-container {
        background: linear-gradient(145deg, #252a2f 0%, #1B1F23 100%);
        border: 2px solid #2a2e33;
        border-radius: 15px;
        padding: 20px;
        overflow-x: auto;
        position: relative;
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
        padding: 16px 10px;
        border-bottom: 2px solid #ffd700;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        text-align: center;
        white-space: nowrap;
    }

    .table-custom thead th.col-acciones {
        position: sticky;
        right: 0;
        background: linear-gradient(135deg, #2a2e33 0%, #1B1F23 100%);
        z-index: 10;
        box-shadow: -4px 0 8px rgba(0,0,0,0.3);
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
        transform: scale(1.001);
        box-shadow: 0 4px 12px rgba(255,215,0,0.15);
    }

    .table-custom tbody td {
        padding: 14px 10px;
        border-bottom: 1px solid #2f343a;
        color: #fff;
        font-weight: 500;
        vertical-align: middle;
        text-align: center;
        font-size: 0.8rem;
    }

    .table-custom tbody td:first-child {
        color: #ffd700;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .table-custom tbody td strong {
        color: #fff;
        font-weight: 600;
    }

    .table-custom tbody td.col-acciones {
        position: sticky;
        right: 0;
        background: linear-gradient(135deg, #1e2227 0%, #23282e 100%);
        z-index: 5;
        box-shadow: -4px 0 8px rgba(0,0,0,0.3);
    }

    .table-custom tbody tr:nth-of-type(even) td.col-acciones {
        background: linear-gradient(135deg, #23282e 0%, #1e2227 100%);
    }

    .table-custom tbody tr:hover td.col-acciones {
        background: linear-gradient(135deg, #2e353d 0%, #343a42 100%);
    }

    /* ==== BADGES ==== */
    .badge-custom {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        white-space: nowrap;
    }

    .badge-tipo {
        background: linear-gradient(135deg, #00aaff 0%, #0088dd 100%);
        color: #fff;
        box-shadow: 0 2px 6px rgba(0, 170, 255, 0.3);
    }

    .badge-pendiente {
        background: linear-gradient(135deg, #ffaa00 0%, #ff8800 100%);
        color: #1B1F23;
        box-shadow: 0 2px 6px rgba(255, 170, 0, 0.3);
    }

    .badge-en-curso {
        background: linear-gradient(135deg, #00ff88 0%, #00e5cc 100%);
        color: #1B1F23;
        box-shadow: 0 2px 6px rgba(0, 255, 136, 0.3);
    }

    .badge-finalizado {
        background: linear-gradient(135deg, #888 0%, #666 100%);
        color: #fff;
        box-shadow: 0 2px 6px rgba(136, 136, 136, 0.3);
    }

    .badge-equipos {
        background: linear-gradient(135deg, #2a2e33 0%, #1B1F23 100%);
        color: #ffd700;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        border: 2px solid #444;
        font-weight: 700;
    }

    /* ==== CONFIGURACIÓN ==== */
    .config-info {
        font-size: 0.75rem;
        line-height: 1.5;
        color: #aaa;
    }

    .config-info strong {
        color: #ffd700;
    }

    /* ==== FECHAS ==== */
    .fecha-info {
        font-size: 0.8rem;
        line-height: 1.6;
    }

    .fecha-info .fecha-label {
        color: #ffd700;
        font-weight: 600;
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
        gap: 5px;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;
        min-width: 200px;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 1400px) {
        .table-custom {
            font-size: 0.8rem;
        }
        
        .table-custom thead th,
        .table-custom tbody td {
            padding: 10px 8px;
        }
    }

    @media (max-width: 768px) {
        .torneos-container {
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
            border-radius: 12px;
            padding: 15px;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-ver,
        .btn-editar,
        .btn-eliminar {
            width: 100%;
            padding: 8px 12px;
        }
    }
</style>

<div class="torneos-container">
    <!-- Encabezado -->
    <div class="header-section">
        <h2 class="section-title">
            <i class="fas fa-trophy me-2"></i>Torneos Registrados
        </h2>
        <a href="{{ route('torneos.create') }}" class="btn-crear">
            <i class="fas fa-plus-circle me-2"></i>Crear Torneo
        </a>
    </div>

    <!-- Tabla -->
    <div class="table-container">
        @if($torneos->count() > 0)
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 4%;">ID</th>
                        <th style="width: 15%;">Nombre</th>
                        <th style="width: 10%;">Municipio</th>
                        <th style="width: 8%;">Tipo</th>
                        <th style="width: 8%;">Estado</th>
                        <th style="width: 11%;">Fechas</th>
                        <th style="width: 6%;">Equipos</th>
                        <th style="width: 13%;">Configuración</th>
                        <th style="width: 10%;">Premio</th>
                        <th class="col-acciones" style="width: 15%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($torneos as $torneo)
                        <tr>
                            <td><strong>{{ $torneo->id }}</strong></td>
                            <td><strong>{{ $torneo->nombre }}</strong></td>
                            <td>{{ $torneo->municipio ? $torneo->municipio->nombre : 'Sin municipio' }}</td>
                            <td>
                                <span class="badge-custom badge-tipo">{{ $torneo->tipo }}</span>
                            </td>
                            <td>
                                <span class="badge-custom 
                                    @if($torneo->estado == 'Pendiente') badge-pendiente
                                    @elseif($torneo->estado == 'En curso') badge-en-curso
                                    @else badge-finalizado 
                                    @endif">
                                    {{ $torneo->estado }}
                                </span>
                            </td>
                            <td>
                                <div class="fecha-info">
                                    <div>
                                        <span class="fecha-label">Inicio:</span> 
                                        {{ $torneo->fecha_inicio ? date('d/m/Y', strtotime($torneo->fecha_inicio)) : '-' }}
                                    </div>
                                    <div>
                                        <span class="fecha-label">Fin:</span> 
                                        {{ $torneo->fecha_fin ? date('d/m/Y', strtotime($torneo->fecha_fin)) : '-' }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-custom badge-equipos">{{ $torneo->num_equipos ?? 0 }}</span>
                            </td>
                            <td>
                                <div class="config-info">
                                    @if($torneo->tipo == 'Grupos')
                                        <div><strong>{{ $torneo->cantidad_grupos }}</strong> grupos</div>
                                        <div><strong>{{ $torneo->equipos_por_grupo }}</strong> por grupo</div>
                                        <div>Clasifican <strong>{{ $torneo->clasificados_por_grupo }}</strong></div>
                                    @elseif($torneo->tipo == 'Liguilla')
                                        <div>{{ $torneo->partidos_por_enfrentamiento == 2 ? 'Ida y Vuelta' : 'Solo Ida' }}</div>
                                    @else
                                        <div>Eliminación directa</div>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $torneo->premio ?? '-' }}</td>
                            <td class="col-acciones">
                                <div class="action-buttons">
                                    <a href="{{ route('torneos.show', $torneo->id) }}" class="btn-ver" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('torneos.edit', $torneo->id) }}" class="btn-editar" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('torneos.destroy', $torneo->id) }}" 
                                          method="POST" 
                                          class="delete-torneo-form d-inline">
                                        @csrf
                                        <button type="button" class="btn-eliminar delete-torneo-btn" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
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
                <i class="fas fa-trophy"></i>
                <h3>No hay torneos registrados</h3>
                <p>Comienza creando tu primer torneo</p>
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
document.querySelectorAll('.delete-torneo-btn').forEach(button => {
    button.addEventListener('click', function () {
        let form = this.closest('.delete-torneo-form');

        Swal.fire({
            title: '¿Eliminar torneo?',
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