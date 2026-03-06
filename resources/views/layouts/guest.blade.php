<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Models\Setting::get('site_name', 'PayTech | Sistema') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @if ($favicon = \App\Models\Setting::get('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            background: #050505;
            color: #fff;
            overflow-x: hidden;
        }

        .aurora-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: #050505;
            overflow: hidden;
        }

        .aurora-spot-1 {
            position: absolute;
            top: -10%;
            right: -10%;
            width: 60%;
            height: 60%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
            filter: blur(80px);
        }

        .aurora-spot-2 {
            position: absolute;
            bottom: -10%;
            left: -10%;
            width: 60%;
            height: 60%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
            filter: blur(80px);
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .glass-card-v5 {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 1px 1px rgba(255, 255, 255, 0.05);
            width: 100%;
            max-width: 420px;
            border-radius: 1.5rem;
            padding: 3rem;
            transition: transform 0.3s ease;
        }

        .logo-v5 {
            max-height: 70px;
            width: auto;
            filter: drop-shadow(0 0 12px rgba(99, 102, 241, 0.3));
            margin-bottom: 20px;
        }

        .system-title-v5 {
            font-weight: 700;
            letter-spacing: 0.2em;
            color: #f8fafc;
            text-transform: uppercase;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .footer-v5 {
            margin-top: 3rem;
            color: rgba(148, 163, 184, 0.3);
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            font-weight: 600;
            text-transform: uppercase;
            text-align: center;
        }
    </style>
</head>

<body class="antialiased">
    <div class="aurora-bg">
        <div class="aurora-spot-1"></div>
        <div class="aurora-spot-2"></div>
    </div>

    <main class="main-container">
        <div class="mb-10 text-center">
            <a href="/" class="flex flex-col items-center no-underline">
                @if ($logo = \App\Models\Setting::get('logo_system'))
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="Logo" class="logo-v5">
                @else
                    <x-application-logo class="w-16 h-16 fill-current text-indigo-500 logo-v5" />
                @endif
            </a>
        </div>

        <div class="glass-card-v5">
            {{ $slot }}
        </div>

        <footer class="footer-v5">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'PayTech') }}
        </footer>
    </main>
</body>

</html>
