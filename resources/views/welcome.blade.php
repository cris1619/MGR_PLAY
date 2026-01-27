@extends('layouts.app')

@section('title')
Inicio | MGR PLAY
@endsection

@section('titleContent')
<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="{{ route('welcome') }}" class="logo">
                <img src="{{ url('img/logoSinFondo.png') }}" alt="MGR PLAY">
                <span class="logo-text">MALAGA GARCIA ROVIRA PLAY</span>
            </a>
        </div>
        
        <button class="mobile-menu-toggle" onclick="toggleMobileNav()">
            <i class="fas fa-bars"></i>
        </button>

        <div class="navbar-right" id="navbarRight">
            @auth('admin')
                <a href="{{ route('admin.show', auth('admin')->id()) }}" class="icon-btn admin-btn">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ auth('admin')->user()->nombre }}</span>
                </a>
            @endauth
            
            <a href="{{ route('logout') }}" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar sesión</span>
            </a>
        </div>
    </div>
</nav>
@endsection

@section('content')
<style>
/* --- VARIABLES --- */
:root {
    --verde-mgr: #268340;
    --amarillo-mgr: #f5c02b;
    --gris-oscuro: #1b1f1d;
    --gris-medio: #252b27;
    --blanco: #faf8f5;
}

/* --- NAVBAR --- */
.navbar {
    background: linear-gradient(90deg, #0f0f0f, #1a1f24);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    position: sticky;
    top: 0;
    z-index: 1000;
    padding: 0;
}

.navbar-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.navbar-left {
    display: flex;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    color: var(--blanco);
    font-size: 1rem;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
    gap: 15px;
}

.logo:hover {
    transform: scale(1.05);
    color: var(--amarillo-mgr);
}

.logo img {
    height: 50px;
    flex-shrink: 0;
}

.logo-text {
    white-space: nowrap;
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

.mobile-menu-toggle {
    display: none;
    background: none;
    border: 2px solid var(--verde-mgr);
    color: var(--verde-mgr);
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.3rem;
    transition: all 0.3s ease;
}

.mobile-menu-toggle:hover {
    background-color: rgba(38, 131, 64, 0.1);
}

/* --- BOTONES NAVBAR --- */
.icon-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: var(--blanco);
    font-weight: 600;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    border: 1px solid transparent;
}

.icon-btn:hover {
    background: rgba(245, 192, 43, 0.1);
    color: var(--amarillo-mgr);
    border-color: var(--amarillo-mgr);
    transform: translateY(-2px);
}

.icon-btn i {
    font-size: 1.2rem;
}

.logout-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, var(--verde-mgr), #2da84d);
    color: var(--blanco);
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    border: none;
    box-shadow: 0 4px 10px rgba(38, 131, 64, 0.3);
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.logout-btn i {
    font-size: 1.1rem;
}

.logout-btn:hover {
    background: linear-gradient(135deg, var(--amarillo-mgr), #f9d65c);
    color: var(--verde-mgr);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(245, 192, 43, 0.4);
}

.logout-btn:active {
    transform: scale(0.98);
}

/* --- HERO SECTION --- */
.hero-section {
    background: linear-gradient(135deg, rgba(38, 131, 64, 0.15) 0%, rgba(27, 31, 29, 0.9) 100%);
    padding: 50px 30px;
    margin-bottom: 40px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(38, 131, 64, 0.25);
    border: 2px solid rgba(38, 131, 64, 0.3);
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(245, 192, 43, 0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-20px) translateX(20px); }
}

.hero-section h1 {
    color: var(--amarillo-mgr);
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 0 30px rgba(245, 192, 43, 0.3);
    position: relative;
    z-index: 1;
}

.hero-section p {
    color: var(--blanco);
    font-size: 1.25rem;
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

/* --- TARJETAS ADMIN --- */
.admin-card {
    background: linear-gradient(145deg, var(--gris-oscuro) 0%, var(--gris-medio) 100%);
    border: 2px solid #2a2e2a;
    border-radius: 20px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    overflow: hidden;
    position: relative;
}

.admin-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--verde-mgr), var(--amarillo-mgr));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.admin-card:hover::before {
    opacity: 1;
}

.admin-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 15px 35px rgba(245, 192, 43, 0.25);
    border-color: var(--verde-mgr);
}

.admin-card .card-body {
    padding: 30px 25px;
}

.card-icon {
    font-size: 3.5rem;
    margin-bottom: 20px;
    display: inline-block;
    animation: float 3s ease-in-out infinite;
    color: var(--amarillo-mgr);
    text-shadow: 0 0 20px rgba(245, 192, 43, 0.3);
}

.card-title {
    color: var(--blanco);
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 15px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.card-text {
    color: #e5e5e5;
    font-size: 0.95rem;
    line-height: 1.7;
    margin-bottom: 25px;
    min-height: 80px;
}

/* --- BOTONES ADMIN --- */
.btn-admin {
    background: linear-gradient(135deg, var(--verde-mgr) 0%, #34a853 100%);
    color: var(--blanco);
    border: none;
    padding: 13px 35px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 5px 15px rgba(38, 131, 64, 0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-admin:hover {
    background: linear-gradient(135deg, var(--amarillo-mgr) 0%, #ffdc66 100%);
    color: var(--verde-mgr);
    transform: scale(1.08) translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 192, 43, 0.4);
}

.btn-admin:active {
    transform: scale(0.98);
}

/* --- BOTÓN VISTA USUARIO --- */
.btn-usuario {
    background: linear-gradient(135deg, var(--amarillo-mgr) 0%, #ffdc66 100%);
    color: var(--gris-oscuro);
    border: none;
    padding: 18px 50px;
    border-radius: 35px;
    font-weight: 700;
    font-size: 1.15rem;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 8px 20px rgba(245, 192, 43, 0.4);
    margin-top: 40px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.btn-usuario:hover {
    background: linear-gradient(135deg, var(--verde-mgr) 0%, #2da84d 100%);
    color: var(--blanco);
    transform: scale(1.1) translateY(-3px);
    box-shadow: 0 12px 25px rgba(38, 131, 64, 0.5);
}

.btn-usuario:active {
    transform: scale(0.98);
}

/* --- TÍTULOS DE SECCIONES --- */
.section-title {
    color: var(--amarillo-mgr);
    font-size: 2rem;
    font-weight: 700;
    margin: 40px 0 30px 0;
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
    width: 120px;
    height: 4px;
    background: linear-gradient(90deg, transparent, var(--verde-mgr), transparent);
    border-radius: 2px;
}

/* --- ANIMACIONES --- */
.fade-in-up {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* --- RESPONSIVE --- */
@media (max-width: 992px) {
    .mobile-menu-toggle {
        display: block;
    }

    .navbar-right {
        position: fixed;
        top: 70px;
        right: -100%;
        width: 280px;
        height: calc(100vh - 70px);
        background: linear-gradient(180deg, #1a1f24 0%, #0f0f0f 100%);
        flex-direction: column;
        justify-content: flex-start;
        padding: 30px 20px;
        gap: 20px;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.5);
        transition: right 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        z-index: 999;
    }

    .navbar-right.active {
        right: 0;
    }

    .icon-btn,
    .logout-btn {
        width: 100%;
        justify-content: center;
        padding: 15px 20px;
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.6rem;
    }
}

@media (max-width: 768px) {
    .navbar-container {
        height: 60px;
        padding: 0 15px;
    }

    .logo {
        font-size: 0.85rem;
    }

    .logo img {
        height: 40px;
    }

    .logo-text {
        display: none;
    }

    .hero-section {
        padding: 40px 20px;
    }

    .hero-section h1 {
        font-size: 2rem;
    }

    .hero-section p {
        font-size: 1rem;
    }

    .card-icon {
        font-size: 2.8rem;
    }

    .card-title {
        font-size: 1.2rem;
    }

    .card-text {
        font-size: 0.9rem;
        min-height: 60px;
    }

    .btn-admin {
        padding: 11px 28px;
        font-size: 0.85rem;
    }

    .btn-usuario {
        padding: 15px 40px;
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.4rem;
    }

    .admin-card .card-body {
        padding: 25px 20px;
    }
}

@media (max-width: 576px) {
    .hero-section h1 {
        font-size: 1.6rem;
    }

    .hero-section p {
        font-size: 0.9rem;
    }

    .card-icon {
        font-size: 2.5rem;
    }

    .card-title {
        font-size: 1.1rem;
    }

    .card-text {
        min-height: auto;
    }

    .btn-admin,
    .btn-usuario {
        width: 100%;
        text-align: center;
    }

    .section-title {
        font-size: 1.2rem;
    }
}

/* --- OVERLAY PARA MENÚ MÓVIL --- */
.navbar-overlay {
    display: none;
    position: fixed;
    top: 70px;
    left: 0;
    width: 100%;
    height: calc(100vh - 70px);
    background: rgba(0, 0, 0, 0.7);
    z-index: 998;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.navbar-overlay.active {
    display: block;
    opacity: 1;
}

@media (max-width: 992px) {
    .navbar-overlay {
        display: none;
    }
    
    .navbar-overlay.active {
        display: block;
    }
}
</style>

<!-- Overlay para cerrar menú móvil -->
<div class="navbar-overlay" id="navbarOverlay" onclick="closeMobileNav()"></div>

<div class="container mt-4">
    <!-- Hero Section -->
    <div class="hero-section fade-in-up">
        <h1>🎮 Panel de Administración</h1>
        <p>Gestiona todos los aspectos de MGR PLAY desde aquí</p>
    </div>

    <!-- Primera Sección: Gestión Principal -->
    <h2 class="section-title">⚙️ Gestión Principal</h2>
    <div class="row justify-content-center g-4 mb-5">
        <div class="col-lg-4 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🏆</div>
                    <h5 class="card-title">Torneos</h5>
                    <p class="card-text">
                        Gestiona los torneos, organiza sedes y sigue el progreso de cada competición.
                    </p>
                    <a href="{{ route('torneos.index') }}" class="btn btn-admin">
                        Ver Torneos →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">👥</div>
                    <h5 class="card-title">Equipos</h5>
                    <p class="card-text">
                        Consulta y administra los equipos participantes y toda su información.
                    </p>
                    <a href="{{ route('equipos.index') }}" class="btn btn-admin">
                        Ver Equipos →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🎽</div>
                    <h5 class="card-title">Jugadores</h5>
                    <p class="card-text">
                        Explora los jugadores de cada equipo y gestiona sus estadísticas.
                    </p>
                    <a href="{{ route('jugadores.index') }}" class="btn btn-admin">
                        Ver Jugadores →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda Sección: Infraestructura y Logística -->
    <h2 class="section-title">🏗️ Infraestructura y Logística</h2>
    <div class="row justify-content-center g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🌍</div>
                    <h5 class="card-title">Municipios</h5>
                    <p class="card-text">
                        Consulta los municipios donde se disputan los torneos.
                    </p>
                    <a href="{{ route('municipios.index') }}" class="btn btn-admin">
                        Ver Municipios →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">🏟️</div>
                    <h5 class="card-title">Canchas</h5>
                    <p class="card-text">
                        Escenarios preparados para los partidos de cada torneo.
                    </p>
                    <a href="{{ route('canchas.index') }}" class="btn btn-admin">
                        Ver Canchas →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card admin-card shadow-lg fade-in-up">
                <div class="card-body text-center">
                    <div class="card-icon">⚖️</div>
                    <h5 class="card-title">Árbitros</h5>
                    <p class="card-text">
                        Conoce a los árbitros encargados de dirigir los encuentros.
                    </p>
                    <a href="{{ route('Arbitros.index')}}" class="btn btn-admin">
                        Ver Árbitros →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Vista Usuario -->
    <div class="text-center mb-5">
        <a href="{{ route('usuario.vistaUsuario') }}" class="btn btn-usuario">
            🎯 Ir a Vista de Usuario
        </a>
    </div>
</div>

<script>
function toggleMobileNav() {
    const navRight = document.getElementById('navbarRight');
    const overlay = document.getElementById('navbarOverlay');
    
    navRight.classList.toggle('active');
    overlay.classList.toggle('active');
}

function closeMobileNav() {
    const navRight = document.getElementById('navbarRight');
    const overlay = document.getElementById('navbarOverlay');
    
    navRight.classList.remove('active');
    overlay.classList.remove('active');
}

// Cerrar menú al hacer clic en un enlace
document.querySelectorAll('.navbar-right a').forEach(link => {
    link.addEventListener('click', () => {
        closeMobileNav();
    });
});

// Cerrar menú con tecla Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeMobileNav();
    }
});
</script>

@endsection