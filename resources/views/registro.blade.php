<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGR PLAY - Registro</title>
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
        .register-container {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        /* Main Card */
        .register-card {
            background: rgba(20, 25, 35, 0.85);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 0;
            max-width: 1200px;
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

        /* Form Section */
        .form-section {
            padding: 50px 40px;
            position: relative;
            z-index: 2;
        }

        /* Logo Animation */
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .logo-icon {
            font-size: 3.5rem;
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
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #ffd700 0%, #fff 50%, #ffd700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 10px 0 5px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .brand-subtitle {
            color: #8a8f98;
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            color: #ffd700;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            background: rgba(10, 15, 25, 0.6);
            border: 2px solid rgba(255, 215, 0, 0.2);
            border-radius: 12px;
            padding: 12px 18px;
            color: #fff;
            font-size: 0.95rem;
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

        .form-control.is-invalid {
            border-color: #ff4d4d;
        }

        .invalid-feedback {
            color: #ff4d4d;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        /* Password Wrapper */
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
            z-index: 10;
        }

        .password-toggle:hover {
            color: #ffed4e;
            transform: translateY(-50%) scale(1.1);
        }

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { width: 33%; background: #ff4d4d; }
        .strength-medium { width: 66%; background: #ffd700; }
        .strength-strong { width: 100%; background: #00ff88; }

        /* Register Button */
        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            border: none;
            border-radius: 12px;
            color: #000;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            margin-top: 10px;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.5);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(0, 255, 136, 0.05) 100%);
            padding: 50px 40px;
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
            font-size: 2.2rem;
            font-weight: 900;
            color: #fff;
            margin-bottom: 20px;
            text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
            position: relative;
            z-index: 2;
        }

        .hero-text {
            color: #8a8f98;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 35px;
            position: relative;
            z-index: 2;
        }

        /* Benefits List */
        .benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .benefit-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 237, 78, 0.1));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            border: 2px solid rgba(255, 215, 0, 0.3);
            flex-shrink: 0;
        }

        .benefit-icon i {
            font-size: 1.3rem;
            color: #ffd700;
        }

        .benefit-text {
            color: #8a8f98;
            font-size: 0.9rem;
        }

        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 12px 18px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
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

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #8a8f98;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
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
                font-size: 1.7rem;
            }
            
            .logo-icon {
                font-size: 2.8rem;
            }
            
            .form-section {
                padding: 30px 20px;
            }

            .register-card {
                border-radius: 20px;
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

    <!-- Register Container -->
    <div class="register-container">
        <div class="register-card">
            <div class="card-glow"></div>
            
            <div class="row g-0">
                <!-- Left - Form Section -->
                <div class="col-lg-6">
                    <div class="form-section">
                        <!-- Logo -->
                        <div class="logo-container">
                            <div class="logo-icon">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <h1 class="brand-name">MGR PLAY</h1>
                            <p class="brand-subtitle">Crea tu cuenta de administrador</p>
                        </div>

                        <!-- Form -->
                        <form method="POST" action="{{ route('registro.submit') }}" id="registerForm">
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

                            <div class="row">
                                <!-- Nombre -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">
                                            <i class="fas fa-user"></i>
                                            Nombre
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('nombre') is-invalid @enderror" 
                                            id="nombre" 
                                            name="nombre"
                                            placeholder="Tu nombre"
                                            value="{{ old('nombre') }}"
                                            required>
                                        @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Apellido -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido" class="form-label">
                                            <i class="fas fa-user"></i>
                                            Apellido
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('apellido') is-invalid @enderror" 
                                            id="apellido" 
                                            name="apellido"
                                            placeholder="Tu apellido"
                                            value="{{ old('apellido') }}"
                                            required>
                                        @error('apellido')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    Correo Electrónico
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email"
                                    placeholder="tu@email.com"
                                    value="{{ old('email') }}"
                                    required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                        class="form-control @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password"
                                        placeholder="Mínimo 8 caracteres"
                                        required
                                        onkeyup="checkPasswordStrength()">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'passwordIcon1')">
                                        <i class="fas fa-eye" id="passwordIcon1"></i>
                                    </button>
                                </div>
                                <div class="password-strength">
                                    <div class="password-strength-bar" id="strengthBar"></div>
                                </div>
                                @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock"></i>
                                    Confirmar Contraseña
                                </label>
                                <div class="password-wrapper">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password_confirmation" 
                                        name="password_confirmation"
                                        placeholder="Repite tu contraseña"
                                        required>
                                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'passwordIcon2')">
                                        <i class="fas fa-eye" id="passwordIcon2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-register">
                                <i class="fas fa-user-plus me-2"></i>
                                Crear Cuenta
                            </button>

                            <!-- Login Link -->
                            <div class="login-link">
                                ¿Ya tienes cuenta? 
                                <a href="{{ route('login') }}">Inicia sesión aquí</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right - Hero Section -->
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-section">
                        <h2 class="hero-title">Únete a MGR PLAY</h2>
                        <p class="hero-text">
                            Crea tu cuenta de administrador y comienza a gestionar torneos, equipos y jugadores 
                            de manera profesional con las mejores herramientas del mercado.
                        </p>

                        <!-- Benefits -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <p class="benefit-text">
                                <strong style="color: #fff;">Acceso completo</strong><br>
                                Panel de administración con todas las funcionalidades
                            </p>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <p class="benefit-text">
                                <strong style="color: #fff;">Gestión ilimitada</strong><br>
                                Crea y administra todos los torneos que necesites
                            </p>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <p class="benefit-text">
                                <strong style="color: #fff;">Estadísticas avanzadas</strong><br>
                                Analiza el rendimiento y resultados en tiempo real
                            </p>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <p class="benefit-text">
                                <strong style="color: #fff;">Control total</strong><br>
                                Administra equipos, jugadores, canchas y árbitros
                            </p>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <p class="benefit-text">
                                <strong style="color: #fff;">Acceso desde cualquier lugar</strong><br>
                                Plataforma responsive optimizada para todos los dispositivos
                            </p>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <p class="benefit-text">
                                <strong style="color: #fff;">Soporte dedicado</strong><br>
                                Asistencia técnica para resolver cualquier duda
                            </p>
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
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            
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

        // Password Strength Checker
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthBar');
            
            // Remove previous classes
            strengthBar.className = 'password-strength-bar';
            
            if (password.length === 0) {
                strengthBar.style.width = '0%';
                return;
            }
            
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            
            // Character variety checks
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            // Apply strength class
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
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
            if (document.querySelector('.hero-section')) {
                document.querySelector('.hero-section').style.animation = 'fadeInUp 0.8s ease 0.2s forwards';
            }
        });
    </script>
</body>
</html>