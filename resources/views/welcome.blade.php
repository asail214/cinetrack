@extends('layouts.app')

@section('title', 'Welcome to CineTrack')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 80vh;">
    <!-- Cinema Stage Effect -->
    <div class="cinema-stage position-relative mb-5" style="width: 600px; max-width: 90vw; height: 320px; background: radial-gradient(ellipse at center, #1a1a1a 60%, #0f0f0f 100%); box-shadow: 0 20px 60px 10px #000, 0 0 0 8px var(--accent); border-radius: 40px 40px 80px 80px / 40px 40px 120px 120px; overflow: hidden;">
        <div class="spotlight" style="position: absolute; top: 0; left: 50%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(229,9,20,0.25) 0%, transparent 80%); transform: translateX(-50%);"></div>
        <div class="stage-curtain" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: repeating-linear-gradient(135deg, rgba(229,9,20,0.12) 0 8px, transparent 8px 16px); pointer-events: none;"></div>
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <h1 class="display-2 fw-bold mb-3" style="font-family: 'Cinzel', serif; background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-shadow: 0 0 40px rgba(229,9,20,0.5);">
                <span class="material-symbols-outlined me-2" style="font-size: 3rem; vertical-align: middle;">movie</span>
                CineTrack
            </h1>
            <p class="lead text-light mb-4" style="color: var(--text-secondary) !important; font-size: 1.3rem; max-width: 500px;">
                Your personal movie library. Discover, track, and organize your cinematic journey with style.
            </p>
            <a href="{{ route('login') }}" class="btn btn-lg btn-primary px-5 py-3" style="font-size: 1.3rem; border-radius: 30px;">
                <span class="material-symbols-outlined me-2">login</span>
                Login to CineTrack
            </a>
        </div>
    </div>
</div>
@endsection
