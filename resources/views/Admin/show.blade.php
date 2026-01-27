@extends('layouts.app')

@section('title', 'Perfil del Administrador')

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

    .profile-card {
        background: linear-gradient(145deg, #101317 0%, #1B1F23 50%, #101317 100%);
        border: 2px solid #1F2428;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .profile-card::before {
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

    .profile-header {
        background: linear-gradient(135deg, rgba(27, 31, 35, 0.9) 0%, rgba(34, 39, 43, 0.9) 100%);
        padding: 40px 30px;
        text-align: center;
        border-bottom: 3px solid transparent;
        border-image: linear-gradient(90deg, transparent, #22C55E, transparent) 1;
        position: relative;
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-avatar::before {
        content: '';
        position: absolute;
        inset: -5px;
        border-radius: 50%;
        background: linear-gradient(135deg, #22C55E, #15803D);
        animation: rotate 4s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .avatar-circle {
        width: 140px;
        height: 140px;
        background: linear-gradient(135deg, #15803D, #22C55E);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: white;
        font-weight: bold;
        border: 5px solid #101317;
        position: relative;
        z-index: 1;
        box-shadow: 0 8px 30px rgba(34, 197, 94, 0.4);
    }

    .profile-name {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
        letter-spacing: 1px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }

    .profile-email {
        color: #22C55E;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .profile-body {
        padding: 40px 30px;
    }

    .info-item {
        background: linear-gradient(145deg, #1C2025 0%, #272C31 100%);
        border: 1px solid #16A34A50;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateX(10px);
        border-color: #22C55E;
        box-shadow: 0 5px 15px rgba(34, 197, 94, 0.2);
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #15803D, #22C55E);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        color: #9CA3AF;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .info-value {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
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
        text-decoration: none;
        display: inline-block;
    }

    .btn-action:hover {
        transform: scale(1.08) translateY(-2px);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.5);
        background: linear-gradient(135deg, #22C55E 0%, #166534 100%);
        color: #ffffff;
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

    .alert-custom {
        background: linear-gradient(145deg, rgba(34, 197, 94, 0.1) 0%, rgba(21, 128, 61, 0.1) 100%);
        border: 2px solid #22C55E;
        border-radius: 15px;
        padding: 15px 20px;
        color: #22C55E;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
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

    .alert-custom .icon {
        font-size: 1.5rem;
    }

    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
        flex-wrap: wrap;
    }
</style>

<div class="container fade-in">
    {{-- HERO HEADER --}}
    <div class="hero-section slide-up">
        <h1>👤 Mi Perfil</h1>
        <p>Información de tu cuenta de administrador</p>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert-custom">
            <span class="icon">✅</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="profile-card">
                {{-- Header con Avatar --}}
                <div class="profile-header">
                    <div class="profile-avatar">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($admin->nombre, 0, 1)) }}{{ strtoupper(substr($admin->apellido, 0, 1)) }}
                        </div>
                    </div>
                    <h2 class="profile-name">{{ $admin->nombre }} {{ $admin->apellido }}</h2>
                    <p class="profile-email">{{ $admin->email }}</p>
                </div>

                {{-- Body con Información --}}
                <div class="profile-body">
                    <div class="info-item">
                        <div class="info-icon">👤</div>
                        <div class="info-content">
                            <div class="info-label">Nombre</div>
                            <div class="info-value">{{ $admin->nombre }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📝</div>
                        <div class="info-content">
                            <div class="info-label">Apellido</div>
                            <div class="info-value">{{ $admin->apellido }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📧</div>
                        <div class="info-content">
                            <div class="info-label">Correo Electrónico</div>
                            <div class="info-value">{{ $admin->email }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📅</div>
                        <div class="info-content">
                            <div class="info-label">Fecha de Registro</div>
                            <div class="info-value">{{ $admin->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>

                    {{-- Botones de Acción --}}
                    <div class="button-group">
                        <a href="{{ route('admin.edit') }}" class="btn-action">
                            ✏️ Editar Perfil
                        </a>
                        <a href="{{ route('usuario.vistaUsuario') }}" class="btn-secondary-custom">
                            ← Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection