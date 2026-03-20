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
            background: radial-gradient(circle at top, #0a0a0a, #000 80%);
            color: #eaeaea;
        }

        .bg-effect {
            position: fixed;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 30%, rgba(0,255,136,0.08), transparent 40%),
                        radial-gradient(circle at 80% 70%, rgba(0,255,136,0.08), transparent 40%);
            z-index: -1;
        }

        .neon-card {
            background: linear-gradient(145deg, #0a0a0a, #111);
            border: 1px solid rgba(0, 255, 136, 0.2);
            box-shadow: 
                0 0 15px rgba(0,255,136,0.2),
                0 0 30px rgba(0,255,136,0.1);
            border-radius: 12px;
        }

        .neon-text {
            color: #00ff88;
            text-shadow: 
                0 0 5px #00ff88,
                0 0 10px #00ff88,
                0 0 20px #00ff88;
        }

        /* HEADER */
        .neon-header {
            background: rgba(10, 10, 10, 0.9);
            border-bottom: 1px solid rgba(0,255,136,0.2);
            backdrop-filter: blur(6px);
        }
    </style>
</head>

<body class="font-sans antialiased">

<div class="bg-effect"></div>

<div class="min-h-screen">

    <!-- NAVBAR -->
    @include('layouts.navigation')

    <!-- HEADER -->
    @isset($header)
        <header class="neon-header shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="neon-text">
                    {{ $header }}
                </div>
            </div>
        </header>
    @endisset

    <!-- CONTENT -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

</div>

</body>
</html>