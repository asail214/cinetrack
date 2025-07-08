<x-guest-layout>
    <div class="auth-header" data-aos="fade-down">
        <h1 class="auth-title">
            <span class="material-symbols-outlined me-2" style="font-size: 2.5rem; vertical-align: middle;">person_add</span>
            Join CineTrack
        </h1>
        <p class="auth-subtitle">Create your account and start your movie journey</p>
    </div>

    <form method="POST" action="{{ route('register') }}" data-aos="fade-up" data-aos-delay="200">
        @csrf

        <!-- Name -->
        <div class="form-floating" data-aos="fade-up" data-aos-delay="300">
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Enter your full name"
            >
            <label for="name">
                <span class="material-symbols-outlined me-2" style="font-size: 1.2rem; vertical-align: middle;">person</span>
                Full Name
            </label>
            @error('name')
                <div class="invalid-feedback">
                    <span class="material-symbols-outlined me-1">error</span>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-floating" data-aos="fade-up" data-aos-delay="400">
            <input 
                type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
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
        <div class="form-floating" data-aos="fade-up" data-aos-delay="500">
            <input 
                type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                id="password" 
                name="password" 
                required 
                autocomplete="new-password"
                placeholder="Create a password"
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

        <!-- Confirm Password -->
        <div class="form-floating" data-aos="fade-up" data-aos-delay="600">
            <input 
                type="password" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                id="password_confirmation" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="Confirm your password"
            >
            <label for="password_confirmation">
                <span class="material-symbols-outlined me-2" style="font-size: 1.2rem; vertical-align: middle;">lock_reset</span>
                Confirm Password
            </label>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    <span class="material-symbols-outlined me-1">error</span>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Terms Agreement -->
        <div class="form-check" data-aos="fade-up" data-aos-delay="700">
            <input 
                class="form-check-input" 
                type="checkbox" 
                id="terms" 
                name="terms"
                required
            >
            <label class="form-check-label" for="terms">
                <span class="material-symbols-outlined me-1" style="font-size: 1rem; vertical-align: middle;">verified_user</span>
                I agree to the <a href="#" class="text-decoration-none" style="color: var(--accent);">Terms of Service</a> 
                and <a href="#" class="text-decoration-none" style="color: var(--accent);">Privacy Policy</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" data-aos="fade-up" data-aos-delay="800">
            <span class="material-symbols-outlined me-2">person_add</span>
            Create My CineTrack Account
        </button>
    </form>

    <!-- Social Login Divider -->
    <div class="social-login" data-aos="fade-up" data-aos-delay="900">
        <div class="divider">
            <span>Or sign up with</span>
        </div>
    </div>

    <!-- Sign In Link -->
    <div class="auth-links" data-aos="fade-up" data-aos-delay="1000">
        <p class="mb-0">Already have a CineTrack account?</p>
        <a href="{{ route('login') }}" class="btn-link">
            <span class="material-symbols-outlined me-1" style="font-size: 1rem; vertical-align: middle;">login</span>
            Sign in to your account
        </a>
    </div>
</x-guest-layout>