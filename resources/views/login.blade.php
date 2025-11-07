<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGR PLAY - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0e13;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background: linear-gradient(135deg, #0a0e13 0%, #1a1f2e 100%);
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: #ffd700;
            border-radius: 50%;
            animation: float 15s infinite;
            opacity: 0.3;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }

        /* Stadium Lines Effect */
        .stadium-lines {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(90deg, rgba(255, 215, 0, 0.03) 1px, transparent 1px),
                linear-gradient(rgba(255, 215, 0, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: scroll 30s linear infinite;
        }

        @keyframes scroll {
            0% { transform: translateY(0); }
            100% { transform: translateY(50px); }
        }

        /* Glowing Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: pulse 8s ease-in-out infinite;
            z-index: 1;
        }

        .orb1 {
            width: 400px;
            height: 400px;
            background: rgba(255, 215, 0, 0.15);
            top: -200px;
            left: -200px;
        }

        .orb2 {
            width: 350px;
            height: 350px;
            background: rgba(0, 255, 136, 0.1);
            bottom: -150px;
            right: -150px;
            animation-delay: 2s;
        }

        .orb3 {
            width: 300px;
            height: 300px;
            background: rgba(0, 204, 255, 0.1);
            top: 50%;
            left: 50%;
            animation-delay: 4s;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1) translateY(0); opacity: 0.3; }
            50% { transform: scale(1.2) translateY(-30px); opacity: 0.5; }
        }

        /* Container */
        .login-container {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Main Card */
        .login-card {
            background: rgba(20, 25, 35, 0.85);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 0;
            max-width: 1100px;
            width: 100%;
            border: 1px solid rgba(255, 215, 0, 0.1);
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                0 0 100px rgba(255, 215, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            overflow: hidden;
            position: relative;
        }

        /* Card Glow Effect */
        .card-glow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(255, 215, 0, 0.05) 50%, transparent 100%);
            pointer-events: none;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }

        /* Left Section - Form */
        .form-section {
            padding: 60px 50px;
            position: relative;
            z-index: 2;
        }

        /* Logo Animation */
        .logo-container {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .logo-icon {
            font-size: 4rem;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 50%, #ffd700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite, bounce 2s ease-in-out infinite;
            display: inline-block;
            filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.5));
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .brand-name {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #ffd700 0%, #fff 50%, #ffd700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 15px 0 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .brand-subtitle {
            color: #8a8f98;
            font-size: 0.95rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            color: #ffd700;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            background: rgba(10, 15, 25, 0.6);
            border: 2px solid rgba(255, 215, 0, 0.2);
            border-radius: 15px;
            padding: 15px 20px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-control:focus {
            background: rgba(10, 15, 25, 0.8);
            border-color: #ffd700;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
            color: #fff;
            outline: none;
        }

        .form-control::placeholder {
            color: #555;
        }

        /* Password Toggle */
        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #ffd700;
            cursor: pointer;
            padding: 5px;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: #ffed4e;
            transform: translateY(-50%) scale(1.1);
        }

        /* Remember Me */
        .form-check {
            margin: 20px 0;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 215, 0, 0.3);
            background: rgba(10, 15, 25, 0.6);
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #ffd700;
            border-color: #ffd700;
        }

        .form-check-label {
            color: #8a8f98;
            margin-left: 10px;
            cursor: pointer;
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            border: none;
            border-radius: 15px;
            color: #000;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Right Section - Hero */
        .hero-section {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(0, 255, 136, 0.05) 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,215,0,0.1)" stroke-width="2"/><line x1="50" y1="10" x2="50" y2="90" stroke="rgba(255,215,0,0.1)" stroke-width="2"/><line x1="10" y1="50" x2="90" y2="50" stroke="rgba(255,215,0,0.1)" stroke-width="2"/></svg>');
            background-size: 150px 150px;
            opacity: 0.3;
            animation: rotate 60s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: #fff;
            margin-bottom: 20px;
            text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
        }

        .hero-text {
            color: #8a8f98;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        /* Feature Items */
        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }

        .feature-icon-wrapper {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 237, 78, 0.1));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            border: 2px solid rgba(255, 215, 0, 0.3);
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        }

        .feature-icon-wrapper i {
            font-size: 1.8rem;
            color: #ffd700;
        }

        .feature-content h6 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .feature-content p {
            color: #8a8f98;
            font-size: 0.9rem;
            margin: 0;
        }

        /* Stats */
        .stats-container {
            margin-top: 50px;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 215, 0, 0.2);
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            position: relative;
            z-index: 2;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 215, 0, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 215, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 215, 0, 0.1);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #8a8f98;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Alerts */
        .alert {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: rgba(0, 255, 136, 0.1);
            color: #00ff88;
            border: 1px solid rgba(0, 255, 136, 0.3);
        }

        .alert-danger {
            background: rgba(255, 77, 77, 0.1);
            color: #ff4d4d;
            border: 1px solid rgba(255, 77, 77, 0.3);
        }

        /* Links */
        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #8a8f98;
        }

        .register-link a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: #ffed4e;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-section {
                display: none;
            }
            
            .form-section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 576px) {
            .brand-name {
                font-size: 2rem;
            }
            
            .logo-icon {
                font-size: 3rem;
            }
            
            .form-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="stadium-lines"></div>
        <div class="particles" id="particles"></div>
        <div class="orb orb1"></div>
        <div class="orb orb2"></div>
        <div class="orb orb3"></div>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">
            <div class="card-glow"></div>
            
            <div class="row g-0">
                <!-- Left - Form Section -->
                <div class="col-lg-5">
                    <div class="form-section">
                        <!-- Logo -->
                        <div class="logo-container">
                            <div class="logo-icon">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <h1 class="brand-name">MGR PLAY</h1>
                            <p class="brand-subtitle">Sistema de Gestión Deportiva</p>
                        </div>

                        <!-- Form -->
                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf

                            <!-- Alerts -->
                            @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ $errors->first() }}
                            </div>
                            @endif

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    Correo Electrónico
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    id="email" 
                                    name="email"
                                    placeholder="tu@email.com"
                                    value="{{ old('email') }}"
                                    required>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i>
                                    Contraseña
                                </label>
                                <div class="password-wrapper">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password" 
                                        name="password"
                                        placeholder="••••••••"
                                        required>
                                    <button type="button" class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="passwordIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Recordar mi sesión
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Iniciar Sesión
                            </button>

                            <!-- Register Link -->
                            <div class="register-link">
                                ¿No tienes cuenta? 
                                <a href="{{ route('registro') }}">Regístrate aquí</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right - Hero Section -->
                <div class="col-lg-7 d-none d-lg-block">
                    <div class="hero-section">
                        <h2 class="hero-title">Bienvenido al Futuro del Deporte</h2>
                        <p class="hero-text">
                            Gestiona torneos, equipos y jugadores con la plataforma más avanzada. 
                            MGR PLAY te ofrece todas las herramientas para llevar tus competiciones al siguiente nivel.
                        </p>

                        <!-- Features -->
                        <div class="feature-item">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Gestión Completa de Torneos</h6>
                                <p>Crea, organiza y administra competiciones con facilidad</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Estadísticas en Tiempo Real</h6>
                                <p>Seguimiento detallado de resultados y rendimiento</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Control Total de Equipos</h6>
                                <p>Administra jugadores, plantillas y estrategias</p>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="stats-container">
                            <div class="stat-item">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Torneos</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">200+</div>
                                <div class="stat-label">Equipos</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">1K+</div>
                                <div class="stat-label">Jugadores</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Generate Particles
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 15 + 's';
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            particlesContainer.appendChild(particle);
        }

        // Toggle Password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });

        // Form Animation on Load
        window.addEventListener('load', function() {
            document.querySelector('.form-section').style.animation = 'fadeInUp 0.8s ease forwards';
            document.querySelector('.hero-section').style.animation = 'fadeInUp 0.8s ease 0.2s forwards';
        });
    </script>
</body>
</html>