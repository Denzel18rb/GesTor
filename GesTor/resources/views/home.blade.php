<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>GesTor</title>

    <style>
        body {
            background: radial-gradient(circle at top, #0f0f0f, #000000 80%);
            color: #eaeaea;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Glow verde */
        .neon-text {
            color: #00ff88;
            text-shadow: 
                0 0 5px #00ff88,
                0 0 10px #00ff88,
                0 0 20px #00ff88;
        }

        /* Card principal */
        .main-card {
            background: linear-gradient(145deg, #0a0a0a, #111);
            border: 1px solid rgba(0, 255, 136, 0.2);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 
                0 0 15px rgba(0, 255, 136, 0.2),
                0 0 30px rgba(0, 255, 136, 0.1);
        }

        /* Botones */
        .btn-neon {
            background: transparent;
            color: #00ff88;
            border: 1px solid #00ff88;
            transition: 0.3s;
        }

        .btn-neon:hover {
            background: #00ff88;
            color: #000;
            box-shadow: 0 0 10px #00ff88, 0 0 20px #00ff88;
        }

        /* Navbar */
        .nav-link-custom {
            color: #ccc;
            transition: 0.3s;
        }

        .nav-link-custom:hover {
            color: #00ff88;
            text-shadow: 0 0 5px #00ff88;
        }

        /* Fondo con efecto */
        .bg-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 20%, rgba(0,255,136,0.1), transparent 40%),
                        radial-gradient(circle at 70% 80%, rgba(0,255,136,0.1), transparent 40%);
            z-index: -1;
        }
    </style>
</head>
<body>

<div class="bg-effect"></div>

<!-- NAV -->
<header class="container py-3">
    @if (Route::has('login'))
        <nav class="d-flex justify-content-end gap-3">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-neon">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link-custom">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-neon">Register</a>
                @endif
            @endauth
        </nav>
    @endif
</header>

<!-- CONTENIDO PRINCIPAL -->
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="main-card text-center col-md-6">
        <h1 class="neon-text mb-4">GesTor</h1>
        <p class="mb-4">
            Gestiona tus proyectos con un equipo de trabajo de forma eficiente y moderna.
        </p>

        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-neon">Empezar</a>
            <a href="{{ route('register') }}" class="btn btn-neon">Crear cuenta</a>
        </div>
    </div>
</div>

</body>
</html>