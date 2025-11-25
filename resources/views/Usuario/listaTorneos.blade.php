@extends('layouts.app')

@section('title', 'Torneos | MGR PLAY')

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('usuario.vistaUsuario') }}" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            ⚽ TORNEOS
        </a>
    </div>
    <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary">Volver al menú</a>
</nav>

@section('content')

<style>
/* === VARIABLES === */
:root {
    --verde-neon: #00ff88;
    --verde-oscuro: #00cc6a;
    --gris-oscuro: #0a0e12;
    --gris-medio: #1a1f24;
    --gris-claro: #2a2e33;
    --blanco: #f2f2f2;
}

/* === ESTILO GENERAL === */
body {
    background-color: var(--gris-oscuro);
    color: var(--blanco);
}

/* === HEADER SECTION === */
.torneos-header {
    background: linear-gradient(135deg, rgba(0, 255, 136, 0.1) 0%, rgba(0, 204, 106, 0.05) 100%);
    border-radius: 20px;
    padding: 40px 30px;
    margin-bottom: 40px;
    border: 1px solid rgba(0, 255, 136, 0.2);
    position: relative;
    overflow: hidden;
}

.torneos-header::before {
    content: "";
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(0, 255, 136, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse 4s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.section-title {
    color: var(--verde-neon);
    font-size: 2.5rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 15px;
    letter-spacing: 2px;
    text-shadow: 0 0 20px rgba(0, 255, 136, 0.5);
}

.section-subtitle {
    text-align: center;
    color: #9ca3af;
    font-size: 1.1rem;
    margin-bottom: 0;
}

/* === FILTROS RÁPIDOS === */
.filtros-rapidos {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 30px;
}

.filtro-btn {
    background: var(--gris-medio);
    border: 2px solid var(--gris-claro);
    color: var(--blanco);
    padding: 10px 25px;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 0.95rem;
}

.filtro-btn:hover {
    background: var(--gris-claro);
    border-color: var(--verde-neon);
    color: var(--verde-neon);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 255, 136, 0.2);
}

.filtro-btn.active {
    background: var(--verde-neon);
    color: #000;
    border-color: var(--verde-neon);
}

/* === TARJETA PRINCIPAL === */
.card {
    background: linear-gradient(145deg, #141719 0%, #1a1f24 100%);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    overflow: hidden;
}

/* === TABLA MODERNA === */
.table-container {
    overflow-x: auto;
    border-radius: 15px;
}

.table {
    color: var(--blanco);
    margin-bottom: 0;
}

.table thead {
    background: linear-gradient(90deg, var(--verde-neon) 0%, var(--verde-oscuro) 100%) !important;
    color: #000 !important;
    border: none;
}

.table thead th {
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 18px 15px;
    border: none;
    white-space: nowrap;
}

.table tbody {
    background: transparent;
}

.table tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.table-hover tbody tr:hover {
    background: linear-gradient(90deg, rgba(0, 255, 136, 0.08) 0%, rgba(0, 255, 136, 0.03) 100%);
    transform: scale(1.01);
    box-shadow: 0 2px 10px rgba(0, 255, 136, 0.1);
}

.table tbody td {
    padding: 18px 15px;
    vertical-align: middle;
    border: none;
}

/* === BADGES PERSONALIZADOS === */
.badge {
    font-size: 0.8rem;
    padding: 8px 14px;
    border-radius: 20px;
    font-weight: 600;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}

.badge-tipo {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.badge-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: #fff;
}

.badge-success {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: #000;
}

.badge-secondary {
    background: linear-gradient(135deg, #a8a8a8 0%, #6c757d 100%);
}

.badge-dark {
    background: linear-gradient(135deg, #434343 0%, #000000 100%);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

/* === NOMBRE DEL TORNEO === */
.torneo-nombre {
    font-weight: 700;
    color: var(--verde-neon);
    font-size: 1.05rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.torneo-nombre::before {
    content: "🏆";
    font-size: 1.2rem;
}

/* === FECHAS === */
.fecha-cell {
    font-size: 0.9rem;
    line-height: 1.6;
}

.fecha-inicio {
    color: #4facfe;
    font-weight: 600;
}

.fecha-fin {
    color: #f5576c;
    font-weight: 600;
}

/* === BOTÓN VER MÁS === */
.btn-ver {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    border: 2px solid transparent;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-ver:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    color: #fff;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    border-color: var(--verde-neon);
}

/* === ESTADÍSTICAS RÁPIDAS === */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: linear-gradient(135deg, var(--gris-medio) 0%, var(--gris-claro) 100%);
    border: 1px solid rgba(0, 255, 136, 0.2);
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 255, 136, 0.2);
    border-color: var(--verde-neon);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.stat-value {
    font-size: 2rem;
    font-weight: 800;
    color: var(--verde-neon);
    margin-bottom: 5px;
}

.stat-label {
    color: #9ca3af;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* === ANIMACIONES === */
.fade-in {
    animation: fadeIn 0.8s ease forwards;
    opacity: 0;
}

@keyframes fadeIn {
    to { opacity: 1; }
}

.slide-up {
    animation: slideUp 0.6s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes slideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* === ESTADO VACÍO === */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
}

.empty-state-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }
    
    .filtros-rapidos {
        gap: 10px;
    }
    
    .filtro-btn {
        padding: 8px 18px;
        font-size: 0.85rem;
    }
    
    .table thead th,
    .table tbody td {
        padding: 12px 10px;
        font-size: 0.85rem;
    }
    
    .torneo-nombre {
        font-size: 0.95rem;
    }
}

/* === DATATABLE CUSTOMIZATION === */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    background: var(--gris-claro) !important;
    color: var(--blanco) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 8px !important;
    margin: 0 3px !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: var(--verde-neon) !important;
    color: #000 !important;
    border-color: var(--verde-neon) !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: var(--verde-neon) !important;
    color: #000 !important;
    border-color: var(--verde-neon) !important;
}

.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select {
    background: var(--gris-medio) !important;
    color: var(--blanco) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
}

.dataTables_wrapper .dataTables_filter input:focus,
.dataTables_wrapper .dataTables_length select:focus {
    border-color: var(--verde-neon) !important;
    outline: none !important;
}
</style>

<div class="container mt-5 fade-in">
    <!-- Header Section -->
    <div class="torneos-header slide-up">
        <h1 class="section-title">🏆 Torneos Disponibles</h1>
        <p class="section-subtitle">Explora todos los torneos activos y encuentra tu próxima competición</p>
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="stats-container slide-up" style="animation-delay: 0.2s;">
        <div class="stat-card">
            <div class="stat-icon">🏆</div>
            <div class="stat-value">{{ $torneos->count() }}</div>
            <div class="stat-label">Total Torneos</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⚡</div>
            <div class="stat-value">{{ $torneos->where('estado', 'En curso')->count() }}</div>
            <div class="stat-label">En Curso</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-value">{{ $torneos->where('estado', 'Pendiente')->count() }}</div>
            <div class="stat-label">Pendientes</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✓</div>
            <div class="stat-value">{{ $torneos->where('estado', 'Finalizado')->count() }}</div>
            <div class="stat-label">Finalizados</div>
        </div>
    </div>

    <!-- Tabla de Torneos -->
    <div class="card slide-up" style="animation-delay: 0.4s;">
        <div class="card-body p-0">
            <div class="table-container">
                <table id="tablaTorneos" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Torneo</th>
                            <th>Municipio</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fechas</th>
                            <th>Equipos</th>
                            <th>Premio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($torneos as $torneo)
                        <tr data-estado="{{ $torneo->estado }}">
                            <td><strong>#{{ $torneo->id }}</strong></td>

                            <td>
                                <div class="torneo-nombre">{{ $torneo->nombre }}</div>
                            </td>

                            <td>
                                <span style="color: #9ca3af;">
                                    📍 {{ $torneo->municipio ? $torneo->municipio->nombre : 'Sin municipio' }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-tipo">{{ $torneo->tipo }}</span>
                            </td>

                            <td>
                                <span class="badge
                                    @if($torneo->estado == 'Pendiente') badge-warning
                                    @elseif($torneo->estado == 'En curso') badge-success
                                    @else badge-secondary @endif">
                                    {{ $torneo->estado }}
                                </span>
                            </td>

                            <td>
                                <div class="fecha-cell">
                                    <div class="fecha-inicio">
                                        🔵 {{ $torneo->fecha_inicio ? date('d/m/Y', strtotime($torneo->fecha_inicio)) : '-' }}
                                    </div>
                                    <div class="fecha-fin">
                                        🔴 {{ $torneo->fecha_fin ? date('d/m/Y', strtotime($torneo->fecha_fin)) : '-' }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge badge-dark">
                                    👥 {{ $torneo->num_equipos ?? 0 }}
                                </span>
                            </td>

                            <td>
                                <strong style="color: #ffd700;">
                                    {{ $torneo->premio ?? '-' }}
                                </strong>
                            </td>

                            <td>
                                <a href="{{ route('usuario.listaTorneosShow', $torneo->id) }}"
                                    class="btn-ver btn-sm">
                                    Ver Más
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="empty-state-icon">🏆</div>
                                    <h3>No hay torneos disponibles</h3>
                                    <p>Por el momento no hay torneos registrados en el sistema.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Inicializar DataTable
    const table = $('#tablaTorneos').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' },
        responsive: true,
        order: [[0, 'desc']],
        pageLength: 10,
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip'
    });

    // Filtros personalizados
    $('.filtro-btn').on('click', function() {
        const filter = $(this).data('filter');
        
        // Actualizar botones activos
        $('.filtro-btn').removeClass('active');
        $(this).addClass('active');
        
        // Aplicar filtro
        if (filter === 'todos') {
            table.column(4).search('').draw();
        } else {
            table.column(4).search(filter).draw();
        }
    });
});
</script>
@endsection