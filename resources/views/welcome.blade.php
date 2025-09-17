@extends('layouts.app')

@section('title')
      Inicio | MGR PLAY
@endsection

@section('titleContent')
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
                MALAGA GARCIA ROVIRA PLAY
            </a>
        </div>
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }
</style>

<div class="container">


    <div class="d-flex flex-wrap gap-3 justify-content-center">

    <div class="container mt-5">
    <div class="row justify-content-center g-4">

        <!-- Primera fila (3 tarjetas) -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #1B1F23;">
                <div class="card-body text-center">
                    <h5 class="card-title text-white mb-3">🏆 <b>TORNEOS</b></h5>
                    <p class="card-text text-white-50">
                        <i>Gestiona los torneos, organiza sedes y sigue el progreso.</i>
                    </p>
                    <a href="#" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        ➡️ Ver Torneos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #1B1F23;">
                <div class="card-body text-center">
                    <h5 class="card-title text-white mb-3">👥 <b>EQUIPOS</b></h5>
                    <p class="card-text text-white-50">
                        <i>Consulta los equipos participantes y su información.</i>
                    </p>
                    <a href="#" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        ➡️ Ver Equipos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #1B1F23;">
                <div class="card-body text-center">
                    <h5 class="card-title text-white mb-3">🎽 <b>JUGADORES</b></h5>
                    <p class="card-text text-white-50">
                        <i>Explora los jugadores de cada equipo y sus estadísticas.</i>
                    </p>
                    <a href="#" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        ➡️ Ver Jugadores
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Segunda fila (4 tarjetas) -->
    <div class="row justify-content-center g-4 mt-3">

        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #1B1F23;">
                <div class="card-body text-center">
                    <h5 class="card-title text-white mb-3">🌍 <b>MUNICIPIOS</b></h5>
                    <p class="card-text text-white-50">
                        <i>Consulta los municipios donde se disputan los torneos.</i>
                    </p>
                    <a href="#" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        ➡️ Ver Municipios
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #1B1F23;">
                <div class="card-body text-center">
                    <h5 class="card-title text-white mb-3">🏟️ <b>CANCHAS</b></h5>
                    <p class="card-text text-white-50">
                        <i>Escenarios preparados para los partidos de cada torneo.</i>
                    </p>
                    <a href="#" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        ➡️ Ver Canchas
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #1B1F23;">
                <div class="card-body text-center">
                    <h5 class="card-title text-white mb-3">📅 <b>PARTIDOS</b></h5>
                    <p class="card-text text-white-50">
                        <i>Consulta la programación de los partidos y resultados.</i>
                    </p>
                    <a href="#" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        ➡️ Ver Partidos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #1B1F23;">
                <div class="card-body text-center">
                    <h5 class="card-title text-white mb-3">⚖️ <b>ÁRBITROS</b></h5>
                    <p class="card-text text-white-50">
                        <i>Conoce a los árbitros encargados de dirigir los encuentros.</i>
                    </p>
                    <a href="#" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        ➡️ Ver Árbitros
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection