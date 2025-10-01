@extends('layouts.app')

@section('title')
Arbitros | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-left">
        <a href="#" class="logo">
            <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY" style="height: 50px; margin-right: 30px;">
            ⚖️ ARBITROS
        </a>
    </div>
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .municipio-card {
        background-color: #1B1F23;
        transition: transform 0.2s ease-in-out;
    }

    .municipio-card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">⚖️ Arbitros Registrados</h2>
        <a href="{{ route('Arbitros.create') }}" class="btn btn-secondary rounded-pill px-4">
            ➕ Crear Arbitro
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped table-bordered text-center align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arbitros as $arbitro)
                    <tr>
                        <td><b>{{ $arbitro->nombre }}</b></td>
                        <td><b>{{ $arbitro->apellido }}</b></td>
                        <td>
                            <a href="{{ route('Arbitros.edit', $arbitro->id) }}"
                                class="btn btn-success btn-sm rounded-pill px-3">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('Arbitros.destroy', $arbitro->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('¿Estás seguro de eliminar este municipio?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Volver al menu</a>
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
    <script>
        function confirmarEliminacion(event) {
            event.preventDefault();
            const form = event.target.closest('form');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
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