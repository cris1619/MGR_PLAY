<p><strong>ID:</strong> {{ $torneo->id }}</p>
<p><strong>Nombre:</strong> {{ $torneo->nombre }}</p>
<p><strong>Municipio:</strong> {{ $torneo->municipio->nombre ?? '-' }}</p>
<p><strong>Tipo:</strong> {{ $torneo->tipo }}</p>
<p><strong>Estado:</strong> {{ $torneo->estado }}</p>
<p><strong>Fechas:</strong> {{ $torneo->fecha_inicio ?? '-' }} - {{ $torneo->fecha_fin ?? '-' }}</p>
<p><strong>Número de Equipos:</strong> {{ $torneo->num_equipos ?? 0 }}</p>

@if($torneo->tipo == 'Grupos')
    <p><strong>Cantidad de Grupos:</strong> {{ $torneo->cantidad_grupos }}</p>
    <p><strong>Equipos por Grupo:</strong> {{ $torneo->equipos_por_grupo }}</p>
    <p><strong>Clasificados por Grupo:</strong> {{ $torneo->clasificados_por_grupo }}</p>
@elseif($torneo->tipo == 'Liguilla')
    <p><strong>Partidos por enfrentamiento:</strong> {{ $torneo->partidos_por_enfrentamiento == 2 ? 'Ida y Vuelta' : 'Solo Ida' }}</p>
@endif

<p><strong>Premio:</strong> {{ $torneo->premio ?? '-' }}</p>

<p><strong>Equipos Participantes:</strong></p>
<ul>
    @foreach($torneo->equipos as $equipo)
        <li>{{ $equipo->nombre }}</li>
    @endforeach
</ul>
