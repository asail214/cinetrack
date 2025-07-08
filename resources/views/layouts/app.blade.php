<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CineTrack')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        
        .navbar {
            background: #000;
            padding: 1rem 2rem;
            border-bottom: 2px solid #e50914;
        }
        
        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e50914;
            text-decoration: none;
        }
        
        .navbar .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .navbar .nav-links a {
            color: #ffffff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .navbar .nav-links a:hover {
            color: #e50914;
            background: rgba(229, 9, 20, 0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .btn-primary {
            background-color: #e50914;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #b8070f;
        }
        
        .btn-secondary {
            background-color: #333;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('movies.index') }}" class="logo">
                🎬 CineTrack
            </a>
            
            <div class="nav-links">
                @auth
                    <a href="{{ route('movies.index') }}">📽️ Dashboard</a>
                    <a href="{{ route('movies.create') }}">➕ Add Movie</a>
                    <span style="color: #e50914;">👋 {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; padding: 0.5rem 1rem; border-radius: 5px;">
                            🚪 Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">🔐 Login</a>
                    <a href="{{ route('register') }}">📝 Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div style="background: #28a745; color: white; padding: 1rem; text-align: center;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #dc3545; color: white; padding: 1rem; text-align: center;">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="text-align: center; padding: 2rem; color: #666; border-top: 1px solid #333;">
        <p>&copy; {{ date('Y') }} CineTrack. Your Personal Movie Library.</p>
    </footer>
</body>
</html>