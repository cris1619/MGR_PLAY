@extends('layouts.app')

@section('title', 'Torneos | MGR PLAY')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-trophy me-2"></i> Torneos Registrados</h4>
            <a href="{{ route('torneos.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nuevo Torneo
            </a>
        </div>

        <div class="card-body">
            <table id="tablaTorneos" class="table table-striped table-hover align-middle">
                <thead class="table-dark">
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

                            {{-- Nombre --}}
                            <td><strong>{{ $torneo->nombre }}</strong></td>

                            {{-- Municipio --}}
                            <td>
                                {{ $torneo->municipio ? $torneo->municipio->nombre : 'Sin municipio' }}
                            </td>

                            {{-- Tipo --}}
                            <td>
                                <span class="badge bg-primary">{{ $torneo->tipo }}</span>
                            </td>

                            {{-- Estado --}}
                            <td>
                                <span class="badge 
                                    @if($torneo->estado == 'Pendiente') bg-warning 
                                    @elseif($torneo->estado == 'En curso') bg-success 
                                    @else bg-secondary @endif">
                                    {{ $torneo->estado }}
                                </span>
                            </td>

                            {{-- Fechas --}}
                            <td>
                                {{ $torneo->fecha_inicio ? date('d/m/Y', strtotime($torneo->fecha_inicio)) : '-' }} <br>
                                {{ $torneo->fecha_fin ? date('d/m/Y', strtotime($torneo->fecha_fin)) : '-' }}
                            </td>

                            {{-- Número de Equipos --}}
                            <td>
                                <span class="badge bg-dark">
                                    {{ $torneo->num_equipos ?? 0 }}
                                </span>
                            </td>

                            {{-- Configuración según tipo --}}
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

                            {{-- Premio --}}
                            <td>{{ $torneo->premio ?? '-' }}</td>

                            {{-- Acciones --}}
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
