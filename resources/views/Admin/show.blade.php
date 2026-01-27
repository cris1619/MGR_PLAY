@extends('layouts.app')

@section('title', 'Perfil del Administrador')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Perfil del Administrador</h5>
                </div>

                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $admin->nombre }}</p>
                    <p><strong>Apellido:</strong> {{ $admin->apellido }}</p>
                    <p><strong>Email:</strong> {{ $admin->email }}</p>
                    <p><strong>Registrado el:</strong> {{ $admin->created_at->format('d/m/Y') }}</p>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.edit') }}" class="btn btn-warning">
                            Editar perfil
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-secondary">
                            Volver
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection