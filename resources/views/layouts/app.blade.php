<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/balonPestaña.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    

</head>
<body>
    <style>
        body{
            font-family: "Play", sans-serif;
            font-optical-sizing: auto;
            background-image: url("{{ asset('img/2713.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
        }

        .logo-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(45deg, #00ff88, #00ccff);
            border-radius: 4px;
            display: flex;
            align-items: center;
            align-items: center;
            font-weight: bold;
            font-size: 14px;
            color: #000;
        }

        .container-principal{
            background-color: #000;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
    </style>

    <div class=" p-4 text-center text-white bg-custom ">
        @yield('titleContent')
    </div>
    
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <footer>
        <div class=" p-4 text-center text-white">
            Realizado por - @@Cristian Fernando Solano Villamizar - <br>
            @@Juan David Carrillo Mojica <br>
            2025</div>
    </footer>
</body>

</html>