<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/balonPestaña.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


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
    <footer>
        <div class=" p-4 text-center text-white">
            Realizado por - @@Cristian Fernando Solano Villamizar - <br>
            @@Juan David Carrillo Mojica <br>
            2025</div>
    </footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>