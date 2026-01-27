@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<style>
    :root {
        --verde-neon: #00ff88;
        --gris-oscuro: #1a1f24;
        --gris-medio: #2a2e33;
        --gris-claro: #3a3e43;
        --blanco: #f2f2f2;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Play", sans-serif;
        background-image: url("{{ asset('img/2713.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative;
        color: var(--blanco);
        min-height: 100vh;
    }

    .hero-section {
        background: linear-gradient(135deg, rgba(0, 255, 136, 0.15) 0%, rgba(0, 204, 106, 0.05) 100%);
        border-radius: 25px;
        padding: 50px 30px;
        margin-bottom: 40px;
        border: 2px solid rgba(0, 255, 136, 0.3);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 255, 136, 0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-20px) translateX(20px); }
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: 900;
        color: var(--verde-neon);
        text-shadow: 0 0 30px rgba(0, 255, 136, 0.5);
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .hero-section p {
        color: #dce0e6ff;
        font-size: 1.2rem;
        position: relative;
        z-index: 1;
    }

    .edit-card {
        background: linear-gradient(145deg, #101317 0%, #1B1F23 50%, #101317 100%);
        border: 2px solid #1F2428;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .edit-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #22C55E, #15803D, #22C55E);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .edit-header {
        background: linear-gradient(135deg, rgba(27, 31, 35, 0.9) 0%, rgba(34, 39, 43, 0.9) 100%);
        padding: 30px;
        text-align: center;
        border-bottom: 3px solid transparent;
        border-image: linear-gradient(90deg, transparent, #22C55E, transparent) 1;
    }

    .edit-header h2 {
        color: #ffffff;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: 1px;
    }

    .edit-body {
        padding: 40px 30px;
    }

    .form-group-custom {
        margin-bottom: 25px;
    }

    .form-label-custom {
        color: #9CA3AF;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control-custom {
        background: linear-gradient(145deg, #1C2025 0%, #272C31 100%);
        border: 2px solid #16A34A50;
        border-radius: 12px;
        padding: 14px 18px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #22C55E;
        background: #1C2025;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
    }

    .form-control-custom::placeholder {
        color: #6B7280;
    }

    .alert-danger-custom {
        background: linear-gradient(145deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
        border: 2px solid #EF4444;
        border-radius: 15px;
        padding: 20px;
        color: #FCA5A5;
        margin-bottom: 30px;
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-danger-custom ul {
        margin: 10px 0 0 0;
        padding-left: 20px;
    }

    .alert-danger-custom li {
        margin-bottom: 5px;
    }

    .btn-action {
        background: linear-gradient(135deg, #15803D 0%, #22C55E 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        padding: 14px 40px;
        border-radius: 30px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        cursor: pointer;
    }

    .btn-action:hover {
        transform: scale(1.08) translateY(-2px);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.5);
        background: linear-gradient(135deg, #22C55E 0%, #166534 100%);
    }

    .btn-secondary-custom {
        background: linear-gradient(145deg, #1C2025 0%, #272C31 100%);
        border: 2px solid #22C55E;
        color: #22C55E;
        font-weight: 700;
        padding: 14px 40px;
        border-radius: 30px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary-custom:hover {
        background: #22C55E;
        color: #101317;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(34, 197, 94, 0.3);
    }

    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .password-divider {
        margin: 35px 0 30px 0;
        text-align: center;
        position: relative;
    }

    .password-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #22C55E, transparent);
    }

    .password-divider span {
        background: #101317;
        padding: 0 20px;
        color: #22C55E;
        font-weight: 600;
        position: relative;
        z-index: 1;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
    }

    .info-note {
        background: linear-gradient(145deg, rgba(34, 197, 94, 0.05) 0%, rgba(21, 128, 61, 0.05) 100%);
        border-left: 4px solid #22C55E;
        border-radius: 8px;
        padding: 12px 15px;
        color: #9CA3AF;
        font-size: 0.85rem;
        margin-top: 8px;
        display: flex;
        align-items: start;
        gap: 10px;
    }

    .info-note .icon {
        color: #22C55E;
        font-size: 1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }
</style>

<div class="container fade-in">
    {{-- HERO HEADER --}}
    <div class="hero-section slide-up">
        <h1>✏️ Editar Perfil</h1>
        <p>Actualiza tu información personal</p>
    </div>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="alert-danger-custom">
            <strong>⚠️ Se encontraron los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="edit-card">
                <div class="edit-header">
                    <h2>📝 Formulario de Edición</h2>
                </div>

                <div class="edit-body">
                    <form action="{{ route('admin.update') }}" method="POST">
                        @csrf

                        {{-- Nombre --}}
                        <div class="form-group-custom">
                            <label for="nombre" class="form-label-custom">
                                👤 Nombre
                            </label>
                            <input 
                                type="text" 
                                class="form-control-custom" 
                                id="nombre" 
                                name="nombre" 
                                value="{{ old('nombre', $admin->nombre) }}" 
                                required
                                placeholder="Ingresa tu nombre"
                            >
                        </div>

                        {{-- Apellido --}}
                        <div class="form-group-custom">
                            <label for="apellido" class="form-label-custom">
                                📝 Apellido
                            </label>
                            <input 
                                type="text" 
                                class="form-control-custom" 
                                id="apellido" 
                                name="apellido" 
                                value="{{ old('apellido', $admin->apellido) }}" 
                                required
                                placeholder="Ingresa tu apellido"
                            >
                        </div>

                        {{-- Email --}}
                        <div class="form-group-custom">
                            <label for="email" class="form-label-custom">
                                📧 Correo Electrónico
                            </label>
                            <input 
                                type="email" 
                                class="form-control-custom" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $admin->email) }}" 
                                required
                                placeholder="correo@ejemplo.com"
                            >
                        </div>

                        {{-- Divisor --}}
                        <div class="password-divider">
                            <span>🔒 Cambiar Contraseña (Opcional)</span>
                        </div>

                        {{-- Contraseña Actual --}}
                        <div class="form-group-custom">
                            <label for="current_password" class="form-label-custom">
                                🔑 Contraseña Actual
                            </label>
                            <input 
                                type="password" 
                                class="form-control-custom" 
                                id="current_password" 
                                name="current_password"
                                placeholder="Ingresa tu contraseña actual"
                            >
                            <div class="info-note">
                                <span class="icon">ℹ️</span>
                                <span>Solo requerida si deseas cambiar tu contraseña</span>
                            </div>
                        </div>

                        {{-- Nueva Contraseña --}}
                        <div class="form-group-custom">
                            <label for="password" class="form-label-custom">
                                🆕 Nueva Contraseña
                            </label>
                            <input 
                                type="password" 
                                class="form-control-custom" 
                                id="password" 
                                name="password"
                                placeholder="Deja en blanco si no deseas cambiarla"
                            >
                            <div class="info-note">
                                <span class="icon">ℹ️</span>
                                <span>Debe tener al menos 8 caracteres. Déjalo vacío para mantener la contraseña actual</span>
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="button-group">
                            <button type="submit" class="btn-action">
                                💾 Guardar Cambios
                            </button>
                            <a href="{{ route('admin.show') }}" class="btn-secondary-custom">
                                ❌ Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection