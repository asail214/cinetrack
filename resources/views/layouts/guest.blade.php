<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CineTrack') }}</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Cinzel:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0f0f0f;
            --bg-secondary: #1a1a1a;
            --bg-card: #252525;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --accent: #e50914;
            --accent-hover: #f40612;
            --success: #28a745;
            --warning: #ffc107;
            --info: #17a2b8;
            --shadow: rgba(0, 0, 0, 0.5);
            --shadow-hover: rgba(229, 9, 20, 0.3);
            --gradient-primary: linear-gradient(135deg, #e50914 0%, #f40612 100%);
            --gradient-dark: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        }
        * { font-family: 'Poppins', sans-serif; }
        body {
            background: var(--bg-primary);
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(229, 9, 20, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(229, 9, 20, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(229, 9, 20, 0.08) 0%, transparent 50%);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 20px 30px, rgba(255,255,255,0.1), transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.05), transparent),
                radial-gradient(1px 1px at 90px 40px, rgba(255,255,255,0.08), transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.03), transparent);
            background-repeat: repeat;
            background-size: 200px 200px;
            animation: sparkle 20s linear infinite;
            pointer-events: none;
            z-index: -1;
        }
        @keyframes sparkle {
            0% { transform: translateY(0px) translateX(0px); }
            100% { transform: translateY(-200px) translateX(-200px); }
        }
        .navbar {
            background: var(--gradient-dark) !important;
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--accent);
            box-shadow: 0 8px 32px var(--shadow);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 2rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
            transition: all 0.3s ease;
        }
        .navbar-brand:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 0 10px rgba(229, 9, 20, 0.8));
        }
        .nav-link {
            color: var(--text-primary) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            transition: all 0.3s ease;
            z-index: -1;
        }
        .nav-link:hover::before { left: 0; }
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.3);
        }
        .card {
            background: var(--bg-card) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 20px !important;
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 40px var(--shadow), 0 0 0 1px rgba(229, 9, 20, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">CineTrack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card p-5" style="min-width: 350px; max-width: 400px; width: 100%; background: #232323 !important; border: 1.5px solid var(--accent); box-shadow: 0 8px 32px rgba(229,9,20,0.15), 0 1.5px 0 var(--accent); border-radius: 22px;">
            {{ $slot }}
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>
