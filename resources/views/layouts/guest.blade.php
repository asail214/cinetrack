<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CineTrack') }} - Authentication</title>
    
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
        
        * { 
            font-family: 'Poppins', sans-serif; 
            box-sizing: border-box;
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
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
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
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 1.8rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
            transition: all 0.3s ease;
            text-decoration: none;
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
            text-decoration: none;
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
        
        .nav-link:hover::before { left: 0; }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.3);
        }
        
        .auth-container {
            margin-top: 120px;
            margin-bottom: 40px;
            width: 100%;
            max-width: 480px;
            padding: 0 20px;
        }
        
        .auth-card {
            background: var(--bg-card) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 25px !important;
            backdrop-filter: blur(20px);
            overflow: hidden;
            position: relative;
            box-shadow: 
                0 20px 40px var(--shadow), 
                0 0 0 1px rgba(229, 9, 20, 0.2), 
                inset 0 0 0 1px rgba(255, 255, 255, 0.1);
            padding: 3rem 2.5rem;
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .auth-title {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .auth-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin: 0;
        }
        
        .form-floating {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-control {
            background: rgba(37, 37, 37, 0.8) !important;
            border: 2px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 15px !important;
            color: var(--text-primary) !important;
            padding: 1.5rem 1rem 0.5rem !important;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 1rem;
            height: auto;
        }
        
        .form-floating > label {
            color: var(--text-secondary) !important;
            padding: 0.75rem 1rem;
            font-weight: 500;
        }
        
        .form-control:focus {
            background: rgba(37, 37, 37, 0.9) !important;
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.25) !important;
            transform: translateY(-2px);
        }
        
        .form-control:focus + label,
        .form-control:not(:placeholder-shown) + label {
            color: var(--accent) !important;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        }
        
        .form-check {
            margin: 1.5rem 0;
        }
        
        .form-check-input {
            background-color: rgba(37, 37, 37, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.25);
        }
        
        .form-check-label {
            color: var(--text-primary);
            font-weight: 500;
            margin-left: 0.5rem;
        }
        
        .btn {
            font-weight: 600;
            border-radius: 25px;
            padding: 1rem 2rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
            width: 100%;
            margin: 1rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
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
            color: white;
        }
        
        .btn-link {
            color: var(--accent) !important;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            background: none;
            padding: 0.5rem 0;
            width: auto;
            margin: 0;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-link:hover {
            color: var(--accent-hover) !important;
            text-decoration: underline;
            transform: none;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .auth-links p {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }
        
        .auth-links a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .auth-links a:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }
        
        .alert {
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(20px);
            border-left: 4px solid;
            animation: slideInDown 0.5s ease;
            margin-bottom: 1.5rem;
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
        
        .invalid-feedback {
            display: block;
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .social-login {
            margin: 2rem 0;
            text-align: center;
        }
        
        .social-login .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .social-login .divider::before,
        .social-login .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .social-login .divider span {
            padding: 0 1rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        @media (max-width: 576px) {
            .auth-card {
                padding: 2rem 1.5rem;
                margin: 0 10px;
            }
            
            .auth-title {
                font-size: 2rem;
            }
            
            .navbar-brand {
                font-size: 1.3rem;
            }
            
            .auth-container {
                margin-top: 100px;
            }
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 15, 15, 0.9);
            display: none;
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
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="material-symbols-outlined me-2" style="font-size: 1.8rem;">movie</span>
                CineTrack
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <span class="material-symbols-outlined me-1">login</span>
                            Sign In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <span class="material-symbols-outlined me-1">person_add</span>
                            Get Started
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="auth-container">
        <div class="auth-card">
            {{ $slot }}
        </div>
        
        <div class="footer-text">
            <p>
                <span class="material-symbols-outlined me-2" style="vertical-align: middle;">favorite</span>
                Made with love for movie enthusiasts &copy; {{ date('Y') }} CineTrack
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Loading overlay functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }
        
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }
        
        // Form submission loading
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                showLoading();
            });
        });
        
        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                if (bootstrap.Alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            });
        }, 5000);
        
        // Page load complete
        window.addEventListener('load', function() {
            hideLoading();
        });
        
        // Enhanced form validation feedback
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(function(form) {
                const inputs = form.querySelectorAll('.form-control');
                
                inputs.forEach(function(input) {
                    input.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            this.classList.remove('is-invalid');
                            this.classList.add('is-valid');
                        }
                    });
                    
                    input.addEventListener('blur', function() {
                        if (this.value.trim() === '' && this.hasAttribute('required')) {
                            this.classList.add('is-invalid');
                            this.classList.remove('is-valid');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>