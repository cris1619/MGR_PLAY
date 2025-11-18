@extends('layouts.app')

@section('title', 'Torneos | MGR PLAY')

@section('content')
<style>
/* === ESTILO GENERAL === */
body {
    background-color: #1b1f1d;
    color: #faf8f5;
}

/* === TÍTULO DE SECCIÓN === */
.section-title {
    color: #f5c02b;
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
    background: linear-gradient(90deg, transparent, #268340, transparent);
}

/* === TARJETA PRINCIPAL === */
.card {
    background: linear-gradient(145deg, #1b1f1d 0%, #252b27 100%);
    border: 1px solid #2a2e2a;
    border-radius: 20px;
    box-shadow: 0 8px 16px rgba(38, 131, 64, 0.25);
    overflow: hidden;
}
.card-header {
    background: linear-gradient(90deg, #268340, #2da84d);
    color: #faf8f5;
    font-weight: 700;
    border: none;
    padding: 15px 25px;
}
.card-header h4 {
    margin: 0;
    font-size: 1.3rem;
}
.card-body {
    background-color: #1b1f1d;
    border-radius: 0 0 20px 20px;
}

/* === BOTONES === */
.btn-admin {
    background: linear-gradient(135deg, #268340 0%, #34a853 100%);
    color: #faf8f5;
    border: none;
    padding: 8px 18px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 8px rgba(38, 131, 64, 0.3);
}
.btn-admin:hover {
    background: linear-gradient(135deg, #f5c02b 0%, #ffdc66 100%);
    color: #1b1f1d;
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(245, 192, 43, 0.4);
}
.btn-admin:active {
    transform: scale(0.96);
}
.btn-volver {
    background: linear-gradient(135deg, #f5c02b 0%, #ffdc66 100%);
    color: #1b1f1d;
    border: none;
    padding: 8px 18px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 8px rgba(245, 192, 43, 0.4);
}
.btn-volver:hover {
    background: linear-gradient(135deg, #268340 0%, #2da84d 100%);
    color: #faf8f5;
    transform: scale(1.05);
}

/* === TABLA === */
.table {
    color: #faf8f5;
    background-color: #232925;
    border-radius: 15px;
    overflow: hidden;
}
.table thead {
    background: linear-gradient(90deg, #268340, #2da84d);
    color: #faf8f5;
}
.table tbody tr {
    transition: all 0.2s ease;
}
.table tbody tr:hover {
    background-color: rgba(245, 192, 43, 0.1);
}
.table td, .table th {
    vertical-align: middle;
    border-color: #2a2e2a !important;
}

/* === BADGES PERSONALIZADOS === */
.badge {
    border-radius: 10px;
    padding: 6px 10px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* === ANIMACIÓN === */
.fade-in-up {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .section-title { font-size: 1.4rem; }
    .card-header h4 { font-size: 1.1rem; }
    .btn-admin, .btn-volver { font-size: 0.8rem; padding: 7px 14px; }
    table { font-size: 0.85rem; }
}
</style>

<div class="container mt-5 fade-in-up">
    <!-- TÍTULO -->
    <h2 class="section-title">🏆 Gestión de Torneos</h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-trophy me-2"></i> Torneos Registrados</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('torneos.create') }}" class="btn-admin">
                    <i class="fas fa-plus"></i> Nuevo Torneo
                </a>
                <a href="{{ route('welcome') }}" class="btn-volver">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaTorneos" class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Municipio</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fechas</th>
                            <th>Equipos</th>
                            <th>Configuración</th>
                            <th>Premio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($torneos as $torneo)
                        <tr>
                            <td>{{ $torneo->id }}</td>
                            <td><strong>{{ $torneo->nombre }}</strong></td>
                            <td>{{ $torneo->municipio ? $torneo->municipio->nombre : 'Sin municipio' }}</td>

                            <td><span class="badge bg-primary">{{ $torneo->tipo }}</span></td>

                            <td>
                                <span class="badge
                                    @if($torneo->estado == 'Pendiente') bg-warning
                                    @elseif($torneo->estado == 'En curso') bg-success
                                    @else bg-secondary @endif">
                                    {{ $torneo->estado }}
                                </span>
                            </td>

                            <td>
                                {{ $torneo->fecha_inicio ? date('d/m/Y', strtotime($torneo->fecha_inicio)) : '-' }} <br>
                                {{ $torneo->fecha_fin ? date('d/m/Y', strtotime($torneo->fecha_fin)) : '-' }}
                            </td>

                            <td><span class="badge bg-dark">{{ $torneo->num_equipos ?? 0 }}</span></td>

                            <td>
                                @if($torneo->tipo == 'Grupos')
                                    <span class="small text-muted">
                                        {{ $torneo->cantidad_grupos }} grupos <br>
                                        {{ $torneo->equipos_por_grupo }} por grupo <br>
                                        Clasifican {{ $torneo->clasificados_por_grupo }}
                                    </span>
                                @elseif($torneo->tipo == 'Liguilla')
                                    <span class="small text-muted">
                                        {{ $torneo->partidos_por_enfrentamiento == 2 ? 'Ida y Vuelta' : 'Solo Ida' }}
                                    </span>
                                @else
                                    Eliminación directa
                                @endif
                            </td>

                            <td>{{ $torneo->premio ?? '-' }}</td>

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('torneos.show', $torneo->id) }}" class="btn btn-info btn-sm" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('torneos.edit', $torneo->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('torneos.destroy', $torneo->id) }}" method="POST" onsubmit="return confirmarEliminacion()">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
    $('#tablaTorneos').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' },
        responsive: true,
        order: [[0, 'desc']]
    });
});
function confirmarEliminacion() {
    return confirm('¿Estás seguro de que deseas eliminar este torneo?');
}
</script>
@endsection
