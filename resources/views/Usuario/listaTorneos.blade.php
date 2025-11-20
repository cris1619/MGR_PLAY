@extends('layouts.app')

@section('title', 'Torneos | MGR PLAY')

@section('content')

<style>
/* === ESTILO GENERAL === */
body {
    background-color: #111;
    color: #e9e9e9;
}

/* === TÍTULO === */
.section-title {
    color: #2ecc71;
    font-size: 2rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 35px;
    letter-spacing: 1.5px;
}

/* === TARJETA === */
.card {
    background: #1a1a1a;
    border: 1px solid #2f2f2f;
    border-radius: 18px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.35);
}

/* === TABLA MODERNA === */
.table {
    color: #e9e9e9;
}

.table thead {
    background: #2ecc71 !important;
    color: #111 !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(46, 204, 113, 0.15);
}

.badge {
    font-size: 0.85rem;
    padding: 6px 10px;
}

/* === BOTÓN VER MÁS === */
.btn-ver {
    background: #3498db;
    color: #fff;
    border-radius: 20px;
    padding: 6px 14px;
    font-weight: 600;
    transition: 0.3s;
    text-decoration: none;
}

.btn-ver:hover {
    background: #5dade2;
    color: #fff;
    transform: scale(1.05);
}

/* Animación */
.fade-in {
    animation: fadeIn 0.7s ease forwards;
    opacity: 0;
}

@keyframes fadeIn {
    to { opacity: 1; }
}

</style>

<div class="container mt-5 fade-in">
    <h2 class="section-title">🏆 Torneos Disponibles</h2>

    <div class="card p-3">
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

                            <td>
                                <span class="badge bg-primary">{{ $torneo->tipo }}</span>
                            </td>

                            <td>
                                <span class="badge
                                    @if($torneo->estado == 'Pendiente') bg-warning
                                    @elseif($torneo->estado == 'En curso') bg-success
                                    @else bg-secondary @endif">
                                    {{ $torneo->estado }}
                                </span>
                            </td>

                            <td>
                                {{ $torneo->fecha_inicio ? date('d/m/Y', strtotime($torneo->fecha_inicio)) : '-' }}
                                <br>
                                {{ $torneo->fecha_fin ? date('d/m/Y', strtotime($torneo->fecha_fin)) : '-' }}
                            </td>

                            <td>
                                <span class="badge bg-dark">{{ $torneo->num_equipos ?? 0 }}</span>
                            </td>

                            <td>{{ $torneo->premio ?? '-' }}</td>

                            <td>
                                <a href="{{ route('torneos.show', $torneo->id) }}"
                                    class="btn-ver btn-sm">
                                    Ver Más
                                </a>
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
</script>
@endsection
