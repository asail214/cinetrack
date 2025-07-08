<x-guest-layout>
    <div class="auth-header" data-aos="fade-down">
        <h1 class="auth-title">
            <span class="material-symbols-outlined me-2" style="font-size: 2.5rem; vertical-align: middle;">login</span>
            Welcome Back
        </h1>
        <p class="auth-subtitle">Sign in to continue your cinematic journey</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" data-aos="fade-up" data-aos-delay="200">
        @csrf

        <!-- Email Address -->
        <div class="form-floating" data-aos="fade-up" data-aos-delay="300">
            <input 
                type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="Enter your email"
            >
            <label for="email">
                <span class="material-symbols-outlined me-2" style="font-size: 1.2rem; vertical-align: middle;">email</span>
                Email Address
            </label>
            @error('email')
                <div class="invalid-feedback">
                    <span class="material-symbols-outlined me-1">error</span>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-floating" data-aos="fade-up" data-aos-delay="400">
            <input 
                type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                id="password" 
                name="password" 
                required 
                autocomplete="current-password"
                placeholder="Enter your password"
            >
            <label for="password">
                <span class="material-symbols-outlined me-2" style="font-size: 1.2rem; vertical-align: middle;">lock</span>
                Password
            </label>
            @error('password')
                <div class="invalid-feedback">
                    <span class="material-symbols-outlined me-1">error</span>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check" data-aos="fade-up" data-aos-delay="500">
            <input 
                class="form-check-input" 
                type="checkbox" 
                id="remember_me" 
                name="remember"
            >
            <label class="form-check-label" for="remember_me">
                <span class="material-symbols-outlined me-1" style="font-size: 1rem; vertical-align: middle;">bookmark</span>
                Remember me for 30 days
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" data-aos="fade-up" data-aos-delay="600">
            <span class="material-symbols-outlined me-2">login</span>
            Sign In to CineTrack
        </button>

        <!-- Forgot Password Link -->
        @if (Route::has('password.request'))
            <div class="text-center" data-aos="fade-up" data-aos-delay="700">
                <a class="btn-link" href="{{ route('password.request') }}">
                    <span class="material-symbols-outlined me-1" style="font-size: 1rem; vertical-align: middle;">help</span>
                    Forgot your password?
                </a>
            </div>
        @endif
    </form>

    <!-- Social Login Divider -->
    <div class="social-login" data-aos="fade-up" data-aos-delay="800">
        <div class="divider">
            <span>Or continue with</span>
        </div>
    </div>

    <!-- Sign Up Link -->
    <div class="auth-links" data-aos="fade-up" data-aos-delay="900">
        <p class="mb-0">New to CineTrack?</p>
        <a href="{{ route('register') }}" class="btn-link">
            <span class="material-symbols-outlined me-1" style="font-size: 1rem; vertical-align: middle;">person_add</span>
            Create your account and start tracking movies
        </a>
    </div>
</x-guest-layout>