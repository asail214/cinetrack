<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'CineTrack - Your Personal Movie Library')</title>
    
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
    
    <!-- Custom CSS -->
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
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
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
        
        /* Animated background particles */
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
        
        /* Enhanced Navigation */
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
        
        .nav-link:hover::before {
            left: 0;
        }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.3);
        }
        
        /* Enhanced Cards */
        .card {
            background: var(--bg-card) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 20px !important;
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(229, 9, 20, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        
        .card:hover::before {
            opacity: 1;
        }
        
        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 
                0 20px 40px var(--shadow),
                0 0 0 1px rgba(229, 9, 20, 0.3),
                inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        
        /* Movie Card Enhancements */
        .movie-card {
            height: 100%;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        .movie-poster-container {
            position: relative;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
            background: linear-gradient(45deg, #1a1a1a, #2a2a2a);
        }
        
        .movie-poster {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: all 0.4s ease;
        }
        
        .movie-card:hover .movie-poster {
            transform: scale(1.1);
            filter: brightness(1.2) contrast(1.1);
        }
        
        /* Status Badge Animations */
        .status-badge {
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(229, 9, 20, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(229, 9, 20, 0); }
            100% { box-shadow: 0 0 0 0 rgba(229, 9, 20, 0); }
        }
        
        /* Enhanced Buttons */
        .btn {
            font-weight: 600;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(229, 9, 20, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(229, 9, 20, 0.4);
            background: linear-gradient(135deg, #f40612 0%, #ff1525 100%);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }
        
        .btn-secondary:hover {
            transform: translateY(-3px);
            background: linear-gradient(135deg, #495057 0%, #343a40 100%);
        }
        
        /* Statistics Cards */
        .stats-card {
            background: var(--gradient-dark);
            border: 1px solid rgba(229, 9, 20, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
        }
        
        .stats-number {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
        }
        
        /* Form Enhancements */
        .form-control, .form-select {
            background: rgba(37, 37, 37, 0.8) !important;
            border: 2px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 15px !important;
            color: var(--text-primary) !important;
            padding: 1rem !important;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .form-control:focus, .form-select:focus {
            background: rgba(37, 37, 37, 0.9) !important;
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.25) !important;
            transform: translateY(-2px);
        }
        
        .form-label {
            color: var(--text-primary) !important;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Alert Enhancements */
        .alert {
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(20px);
            border-left: 4px solid;
            animation: slideInDown 0.5s ease;
        }
        
        @keyframes slideInDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border-left-color: var(--success);
            color: #d4edda;
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border-left-color: #dc3545;
            color: #f8d7da;
        }
        
        /* Icon Animations */
        .material-icons-outlined, .material-symbols-outlined {
            transition: all 0.3s ease;
        }
        
        .btn:hover .material-icons-outlined,
        .btn:hover .material-symbols-outlined {
            transform: scale(1.2) rotate(5deg);
        }
        
        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 15, 15, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(10px);
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(229, 9, 20, 0.3);
            border-top: 4px solid var(--accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .movie-poster {
                height: 280px;
            }
            
            .btn {
                padding: 0.5rem 1.5rem;
                font-size: 0.9rem;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-hover);
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay" style="display: none;">
        <div class="loading-spinner"></div>
    </div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('movies.index') }}">
            <span class="material-symbols-outlined me-2" style="font-size: 2rem;">movie</span>
            CineTrack
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.index') }}">
                            <span class="material-symbols-outlined me-1">dashboard</span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.create') }}">
                            <span class="material-symbols-outlined me-1">add_circle</span>
                            Add Movie
                        </a>
                    </li>
                </ul>
            @endauth
            
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="material-symbols-outlined me-1">account_circle</span>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <span class="material-symbols-outlined me-2">settings</span>Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <span class="material-symbols-outlined me-2">logout</span>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <span class="material-symbols-outlined me-1">login</span>
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <span class="material-symbols-outlined me-1">person_add</span>
                            Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main class="container-fluid" style="margin-top: 100px; padding-bottom: 3rem;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-4" style="background: var(--gradient-dark); border-top: 1px solid rgba(229, 9, 20, 0.3);">
        <div class="container">
            <p class="mb-0" style="color: var(--text-secondary);">
                <span class="material-symbols-outlined me-2">favorite</span>
                Made with love for movie enthusiasts &copy; {{ date('Y') }} CineTrack
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        
        // Loading overlay
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }
        
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }
        
        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Form submission loading
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                showLoading();
            });
        });
        
        // Page load complete
        window.addEventListener('load', function() {
            hideLoading();
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Enhanced hover effects
        document.querySelectorAll('.movie-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>