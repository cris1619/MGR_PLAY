# MGR PLAY

Sistema web para la gestión de torneos deportivos de la región Málaga García Rovira. Permite administrar usuarios, equipos, jugadores, canchas, árbitros, partidos y torneos, con autenticación y panel de administración.

## Tabla de Contenidos
- [Descripción General](#descripción-general)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Instalación y Configuración](#instalación-y-configuración)
- [Uso Básico](#uso-básico)
- [Modelos y Controladores](#modelos-y-controladores)
- [Servicios](#servicios)
- [Rutas Principales](#rutas-principales)
- [Vistas](#vistas)
- [Pruebas](#pruebas)
- [Tecnologías y Dependencias](#tecnologías-y-dependencias)
- [Licencia](#licencia)

---

## Descripción General
MGR PLAY es una aplicación web desarrollada con Laravel y Vite, orientada a la gestión integral de torneos deportivos. Permite el registro y administración de usuarios, equipos, jugadores, canchas, árbitros y partidos, así como la visualización y control de torneos.

## Estructura del Proyecto
```
├── app/
│   ├── Http/
│   │   ├── Controllers/   # Lógica de negocio y endpoints
│   │   ├── Requests/      # Validaciones de formularios
│   ├── Models/            # Modelos Eloquent (Admin, Equipos, Jugadores, etc.)
│   ├── Providers/         # Servicios y providers de Laravel
│   ├── Services/          # Servicios personalizados
├── bootstrap/             # Bootstrap de la app
├── config/                # Configuración de Laravel
├── database/
│   ├── migrations/        # Migraciones de base de datos
│   ├── seeders/           # Datos de ejemplo
├── public/                # Archivos públicos y assets
├── resources/
│   ├── views/             # Vistas Blade (login, welcome, etc.)
│   ├── css/ js/           # Estilos y scripts
├── routes/                # Definición de rutas (web.php, console.php)
├── storage/               # Archivos generados y logs
├── tests/                 # Pruebas unitarias y funcionales
├── vendor/                # Dependencias PHP
├── composer.json          # Dependencias y scripts PHP
├── package.json           # Dependencias y scripts JS
├── vite.config.js         # Configuración de Vite
└── README.md              # Documentación
```

## Instalación y Configuración
1. **Requisitos:** PHP >= 8.2, Composer, Node.js, npm.
2. Clona el repositorio:
   ```powershell
   git clone <url-del-repo>
   cd MGR_PLAY
   ```
3. Instala dependencias:
   ```powershell
   composer install
   npm install
   ```
4. Configura el entorno:
   ```powershell
   cp .env.example .env
   php artisan key:generate
   ```
5. Ejecuta migraciones y seeders:
   ```powershell
   php artisan migrate --seed
   ```
6. Activar public para gestionar imagenes:
   ```
   php artisan storage:link
   -Ir archivo .env
   -FILESYSTEM_DISK=local -> asi esta
   -FILESYSTEM_DISK=public -> asi debe quedar
   ```
7. Inicia el servidor:
   ```powershell
   npm run dev
   php artisan serve
   ```

## Uso Básico
- Accede a la app en `http://localhost:8000`.
- Inicia sesión como administrador para acceder al panel.
- Navega por los módulos: usuarios, equipos, jugadores, canchas, árbitros, torneos y partidos.

## Modelos y Controladores
- **Modelos:** Representan entidades como `Admin`, `Equipos`, `Jugadores`, `Canchas`, etc. Usan Eloquent ORM para interactuar con la base de datos.
- **Controladores:** Gestionan la lógica de negocio y las peticiones HTTP. Ejemplo: `AdminController` maneja login, registro y logout.

## Servicios
- Los servicios como `userService` proveen métodos para obtener estadísticas (total de jugadores, equipos, canchas, etc.) y lógica reutilizable.

## Rutas Principales
- Definidas en `routes/web.php`:
  - `/login`, `/logout`, `/registro`: Autenticación y registro.
  - `/usuario/index`, `/usuario/listaEquipos`, `/usuario/listaJugadores`: Panel de usuario.
  - `/Municipios/*`, `/Canchas/*`, `/Equipos/*`: CRUD de entidades.
  - `/welcome`: Página principal tras login.

## Vistas
- **Blade Templates:**
  - `login.blade.php`: Formulario de acceso.
  - `welcome.blade.php`: Panel principal tras autenticación.
  - `layouts/app.blade.php`: Layout base con estilos y navegación.
- **Estilos:** Integración con Bootstrap y Tailwind para diseño moderno y responsivo.

## Pruebas
- Pruebas unitarias y funcionales en `tests/Unit` y `tests/Feature`.
- Ejecuta las pruebas con:
  ```powershell
  php artisan test
  ```

## Tecnologías y Dependencias
- **Backend:** Laravel 12, PHP 8.2
- **Frontend:** Vite, TailwindCSS, Bootstrap
- **Autenticación:** Laravel Auth
- **ORM:** Eloquent
- **Testing:** PHPUnit, Pest
- **Otros:** Axios, FontAwesome

## Licencia
Este proyecto está bajo la licencia MIT.

---

### Créditos
Desarrollado por cris1619 y colaboradores.
