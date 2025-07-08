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
    padding: 0.75rem 1rem !important;
    margin: 0 0.25rem;
    border-radius: 25px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
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

.nav-link:hover::before,
.nav-link.active::before {
    left: 0;
}

.nav-link:hover,
.nav-link.active {
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(229, 9, 20, 0.3);
}

.nav-link.active {
    font-weight: 600;
    background: rgba(229, 9, 20, 0.15) !important;
    border: 1px solid rgba(229, 9, 20, 0.3);
    color: var(--accent) !important;
}

/* User Avatar Styles */
.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(229, 9, 20, 0.3);
}

.user-avatar-large {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(229, 9, 20, 0.4);
}

.user-avatar:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(229, 9, 20, 0.5);
}

.user-avatar .material-symbols-outlined,
.user-avatar-large .material-symbols-outlined {
    color: white;
    font-size: 1.5rem;
}

.user-avatar-large .material-symbols-outlined {
    font-size: 2rem;
}

/* User Info */
.user-info {
    text-align: left;
}

.user-name {
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--text-primary);
    display: block;
    line-height: 1.2;
}

.user-role {
    font-size: 0.75rem;
    color: var(--text-secondary) !important;
    font-weight: 400;
}

/* User Menu Trigger */
.user-menu-trigger {
    background: rgba(37, 37, 37, 0.3) !important;
    border-radius: 50px !important;
    padding: 0.5rem 1rem !important;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.user-menu-trigger:hover {
    background: rgba(37, 37, 37, 0.6) !important;
    border-color: rgba(229, 9, 20, 0.3);
    transform: translateY(-2px);
}

.user-menu-trigger .material-symbols-outlined:last-child {
    transition: transform 0.3s ease;
}

.user-menu-trigger[aria-expanded="true"] .material-symbols-outlined:last-child {
    transform: rotate(180deg);
}

/* Enhanced Dropdown */
.dropdown-menu {
    background: var(--bg-card) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 15px !important;
    backdrop-filter: blur(20px);
    box-shadow: 0 20px 40px var(--shadow), 0 0 0 1px rgba(229, 9, 20, 0.2);
    margin-top: 0.5rem;
    min-width: 220px;
    animation: dropdownFadeIn 0.3s ease;
}

.user-dropdown {
    background: var(--bg-card) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 20px !important;
    backdrop-filter: blur(20px);
    box-shadow: 
        0 20px 40px var(--shadow), 
        0 0 0 1px rgba(229, 9, 20, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    margin-top: 1rem;
    min-width: 280px;
    animation: dropdownSlideIn 0.3s ease;
    overflow: hidden;
}

@keyframes dropdownFadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes dropdownSlideIn {
    from { 
        opacity: 0; 
        transform: translateY(-15px) scale(0.95); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0) scale(1); 
    }
}

.dropdown-item {
    color: var(--text-primary) !important;
    padding: 0.85rem 1.5rem;
    transition: all 0.3s ease;
    border-radius: 12px;
    margin: 0.25rem 0.75rem;
    display: flex;
    align-items: center;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.dropdown-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    transition: all 0.3s ease;
    z-index: -1;
    opacity: 0.1;
}

.dropdown-item:hover::before {
    left: 0;
    opacity: 1;
}

.dropdown-item:hover {
    background: transparent !important;
    color: white !important;
    transform: translateX(8px);
    font-weight: 600;
}

.dropdown-item.logout-btn {
    margin-top: 0.5rem;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.dropdown-item.logout-btn::before {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.dropdown-item.logout-btn:hover {
    color: white !important;
    border-color: #dc3545;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.dropdown-item.text-danger:hover {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
}

.dropdown-header {
    color: var(--text-primary) !important;
    font-weight: 600;
    padding: 1.25rem 1.5rem 0.75rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(229, 9, 20, 0.05);
    margin: 0;
}

.dropdown-header h6 {
    color: var(--text-primary);
    font-weight: 700;
    margin: 0;
}

.dropdown-divider {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    margin: 0.75rem 0;
    opacity: 1;
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
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
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
    border: 2px solid transparent;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(229, 9, 20, 0.4);
    background: linear-gradient(135deg, #f40612 0%, #ff1525 100%);
    color: white;
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    border: 2px solid transparent;
}

.btn-secondary:hover {
    transform: translateY(-3px);
    background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    color: white;
}

.btn-outline-primary {
    background: transparent;
    color: var(--accent);
    border: 2px solid var(--accent);
}

.btn-outline-primary:hover {
    background: var(--gradient-primary);
    color: white;
    border-color: var(--accent);
    transform: translateY(-2px);
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.btn-danger:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.btn-success:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
}

/* Enhanced Form Controls */
.form-control, .form-select {
    background: rgba(37, 37, 37, 0.8) !important;
    border: 2px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 15px !important;
    color: var(--text-primary) !important;
    padding: 1rem !important;
    font-weight: 500;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    font-size: 1rem;
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
    font-size: 1rem;
}

.input-group-text {
    background: var(--bg-secondary) !important;
    border-color: rgba(255,255,255,0.1) !important;
    color: var(--text-secondary) !important;
    border-radius: 15px 0 0 15px !important;
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

/* Responsive Design */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.5rem;
    }
    
    .nav-link {
        padding: 0.5rem !important;
        margin: 0.1rem;
        font-size: 0.9rem;
    }
    
    .btn {
        padding: 0.6rem 1.5rem;
        font-size: 0.8rem;
    }
    
    .dropdown-menu {
        min-width: 200px;
    }
    
    .user-info {
        display: none !important;
    }
    
    .user-dropdown {
        min-width: 250px;
        margin-top: 0.5rem;
    }
    
    .user-avatar {
        width: 35px;
        height: 35px;
    }
    
    .user-menu-trigger {
        padding: 0.4rem 0.8rem !important;
    }
}

@media (max-width: 576px) {
    .navbar-nav {
        padding: 1rem 0;
    }
    
    .nav-link {
        text-align: center;
        margin: 0.25rem 0;
        border-radius: 15px;
    }
    
    .dropdown-menu {
        position: static !important;
        transform: none !important;
        box-shadow: none;
        border: none;
        background: rgba(37, 37, 37, 0.9) !important;
        margin: 1rem 0;
    }
    
    .user-dropdown {
        position: static !important;
        transform: none !important;
        box-shadow: none;
        border: none;
        background: rgba(37, 37, 37, 0.9) !important;
        margin: 1rem 0;
        border-radius: 15px;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: var(--gradient-primary);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--accent-hover);
}

/* Navbar Toggler Enhanced */
.navbar-toggler {
    border: none !important;
    padding: 0.5rem;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.navbar-toggler:hover {
    background: rgba(229, 9, 20, 0.1);
    transform: scale(1.1);
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.25);
}

/* Loading States */
.btn:disabled {
    opacity: 0.7;
    transform: none !important;
    cursor: not-allowed;
}

.btn.loading {
    pointer-events: none;
}

/* Success/Error States */
.is-valid {
    border-color: #28a745 !important;
}

.is-invalid {
    border-color: #dc3545 !important;
}

.valid-feedback, .invalid-feedback {
    font-size: 0.9rem;
    margin-top: 0.5rem;
    padding: 0.5rem;
    border-radius: 10px;
}

.valid-feedback {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.invalid-feedback {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

/* Logout confirmation animation */
.logout-btn {
    position: relative;
}

.logout-btn:active {
    transform: scale(0.98);
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
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <!-- Left side navigation -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movies.index') ? 'active' : '' }}" 
                           href="{{ route('movies.index') }}">
                            <span class="material-symbols-outlined me-1">dashboard</span>
                            My Movies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movies.create') ? 'active' : '' }}" 
                           href="{{ route('movies.create') }}">
                            <span class="material-symbols-outlined me-1">add_circle</span>
                            Add Movie
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.index') }}?status=Pending">
                            <span class="material-symbols-outlined me-1">schedule</span>
                            Watchlist
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.index') }}?status=Watched">
                            <span class="material-symbols-outlined me-1">check_circle</span>
                            Watched
                        </a>
                    </li>
                </ul>
                
                <!-- Right side user menu -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center user-menu-trigger" 
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar me-2">
                                <span class="material-symbols-outlined">account_circle</span>
                            </div>
                            <div class="user-info d-none d-md-block">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <small class="user-role d-block text-muted">Movie Enthusiast</small>
                            </div>
                            <span class="material-symbols-outlined ms-2">expand_more</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                            <li>
                                <div class="dropdown-header d-flex align-items-center">
                                    <div class="user-avatar-large me-3">
                                        <span class="material-symbols-outlined">account_circle</span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('movies.index') }}">
                                    <span class="material-symbols-outlined me-2">dashboard</span>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('movies.create') }}">
                                    <span class="material-symbols-outlined me-2">add_circle</span>
                                    Add New Movie
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <span class="material-symbols-outlined me-2">settings</span>
                                    Profile Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('movies.index') }}?status=Watched">
                                    <span class="material-symbols-outlined me-2">movie</span>
                                    My Collection
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('movies.index') }}?status=Pending">
                                    <span class="material-symbols-outlined me-2">bookmark</span>
                                    Watchlist
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn text-danger">
                                        <span class="material-symbols-outlined me-2">logout</span>
                                        Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @else
                <!-- Guest navigation -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <span class="material-symbols-outlined me-1">login</span>
                            Sign In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-outline-primary" href="{{ route('register') }}">
                            <span class="material-symbols-outlined me-1">person_add</span>
                            Get Started
                        </a>
                    </li>
                </ul>
            @endauth
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