<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: radial-gradient(circle at top, #0a0a0a, #000000 80%);
            color: #eaeaea;
        }

        /* Fondo con efecto */
        .bg-effect {
            position: fixed;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 30%, rgba(0,255,136,0.08), transparent 40%),
                        radial-gradient(circle at 80% 70%, rgba(0,255,136,0.08), transparent 40%);
            z-index: -1;
        }

        /* Card */
        .neon-card {
            background: linear-gradient(145deg, #0a0a0a, #111);
            border: 1px solid rgba(0, 255, 136, 0.2);
            box-shadow: 
                0 0 15px rgba(0,255,136,0.2),
                0 0 30px rgba(0,255,136,0.1);
            border-radius: 12px;
        }

        /* Texto neon */
        .neon-text {
            color: #00ff88;
            text-shadow: 
                0 0 5px #00ff88,
                0 0 10px #00ff88,
                0 0 20px #00ff88;
        }

        /* Inputs */
        input {
            background-color: #0f0f0f !important;
            border: 1px solid #222 !important;
            color: #eaeaea !important;
        }

        input:focus {
            border-color: #00ff88 !important;
            box-shadow: 0 0 5px #00ff88 !important;
        }

        /* Botones */
        button, .btn-neon {
            background: transparent;
            border: 1px solid #00ff88;
            color: #00ff88;
            transition: 0.3s;
        }

        button:hover, .btn-neon:hover {
            background: #00ff88;
            color: #000;
            box-shadow: 0 0 10px #00ff88;
        }
    </style>
</head>

<body class="font-sans antialiased">

<div class="bg-effect"></div>

<div class="min-h-screen flex flex-col justify-center items-center">

    <!-- Logo -->
    <div class="mb-4 text-center">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-green-400" />
        </a>
        <h1 class="neon-text text-2xl mt-2">GesTor</h1>
    </div>

    <!-- Card -->
    <div class="w-full sm:max-w-md px-6 py-6 neon-card">
        {{ $slot }}
    </div>

</div>

</body>
</html>