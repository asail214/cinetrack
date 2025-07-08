@extends('layouts.app')

@section('title', 'Dashboard - CineTrack')

@section('content')
    {{-- Header --}}
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="color: #e50914; font-size: 3rem; margin-bottom: 1rem;">📽️ My Movie Watchlist</h1>
        <p style="color: #cccccc; font-size: 1.2rem;">Keep track of your favorite movies and what you want to watch next</p>
    </div>

    {{-- Statistics Cards --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        <div style="background: #2a2a2a; padding: 2rem; border-radius: 10px; text-align: center; border: 2px solid #333;">
            <div style="font-size: 4rem; margin-bottom: 0.5rem;">🎬</div>
            <div style="font-size: 3rem; color: #e50914; font-weight: bold;">{{ $totalMovies }}</div>
            <div style="color: #cccccc; margin-top: 0.5rem;">Total Movies</div>
        </div>
        <div style="background: #2a2a2a; padding: 2rem; border-radius: 10px; text-align: center; border: 2px solid #333;">
            <div style="font-size: 4rem; margin-bottom: 0.5rem;">✅</div>
            <div style="font-size: 3rem; color: #28a745; font-weight: bold;">{{ $watchedMovies }}</div>
            <div style="color: #cccccc; margin-top: 0.5rem;">Watched</div>
        </div>
        <div style="background: #2a2a2a; padding: 2rem; border-radius: 10px; text-align: center; border: 2px solid #333;">
            <div style="font-size: 4rem; margin-bottom: 0.5rem;">🕐</div>
            <div style="font-size: 3rem; color: #ffc107; font-weight: bold;">{{ $pendingMovies }}</div>
            <div style="color: #cccccc; margin-top: 0.5rem;">Pending</div>
        </div>
    </div>

    {{-- Add Movie Button --}}
    <div style="text-align: center; margin-bottom: 3rem;">
        <a href="{{ route('movies.create') }}" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem;">
            ➕ Add New Movie
        </a>
    </div>

    {{-- Movies Grid --}}
    @if($movies->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            @foreach($movies as $movie)
                <div style="background: #2a2a2a; border-radius: 10px; overflow: hidden; border: 2px solid #333;">
                    {{-- Movie Poster --}}
                    <div style="position: relative; height: 400px; overflow: hidden;">
                        <img 
                            src="{{ $movie->poster }}" 
                            alt="{{ $movie->title }}"
                            style="width: 100%; height: 100%; object-fit: cover;"
                            onerror="this.src='https://via.placeholder.com/300x400/333/fff?text=No+Image'"
                        >
                        {{-- Status Badge --}}
                        <div style="position: absolute; top: 10px; right: 10px; 
                                    background: {{ $movie->status === 'Watched' ? '#28a745' : '#ffc107' }}; 
                                    color: {{ $movie->status === 'Watched' ? 'white' : 'black' }}; 
                                    padding: 0.5rem 1rem; border-radius: 20px; font-weight: bold; font-size: 0.9rem;">
                            {{ $movie->status === 'Watched' ? '✅ Watched' : '🕐 Pending' }}
                        </div>
                    </div>
                    
                    {{-- Movie Info --}}
                    <div style="padding: 1.5rem;">
                        <h3 style="color: #ffffff; margin: 0 0 1rem 0; font-size: 1.3rem;">{{ $movie->title }}</h3>
                        
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                            <span style="background: #555; color: #ffffff; padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.9rem;">
                                🏷️ {{ $movie->category }}
                            </span>
                            @if($movie->is_public)
                                <span style="background: #17a2b8; color: #ffffff; padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.9rem;">
                                    🌍 Public
                                </span>
                            @endif
                        </div>
                        
                        <div style="color: #cccccc; font-size: 0.9rem; margin-bottom: 1.5rem;">
                            📅 Added: {{ $movie->created_at->format('M j, Y') }}
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div style="display: flex; gap: 0.5rem;">
                            {{-- Toggle Status --}}
                            <form action="{{ route('movies.update', $movie) }}" method="POST" style="flex: 1;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="title" value="{{ $movie->title }}">
                                <input type="hidden" name="poster_url" value="{{ $movie->poster_url }}">
                                <input type="hidden" name="category" value="{{ $movie->category }}">
                                <input type="hidden" name="status" value="{{ $movie->status === 'Watched' ? 'Pending' : 'Watched' }}">
                                <button type="submit" style="width: 100%; padding: 0.5rem; border: none; border-radius: 5px; cursor: pointer; 
                                        background: {{ $movie->status === 'Watched' ? '#ffc107' : '#28a745' }}; 
                                        color: {{ $movie->status === 'Watched' ? 'black' : 'white' }}; font-weight: bold;">
                                    {{ $movie->status === 'Watched' ? '🕐 Pending' : '✅ Watched' }}
                                </button>
                            </form>
                            
                            {{-- Edit Button --}}
                            <a href="{{ route('movies.edit', $movie) }}" 
                               style="background: #007bff; color: white; padding: 0.5rem 1rem; border-radius: 5px; text-decoration: none;">
                                ✏️
                            </a>
                            
                            {{-- Delete Button --}}
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Delete {{ $movie->title }}?')"
                                        style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div style="text-align: center; padding: 4rem; background: #2a2a2a; border-radius: 10px; border: 2px dashed #555;">
            <div style="font-size: 6rem; margin-bottom: 2rem;">🎬</div>
            <h3 style="color: #e50914; margin-bottom: 1rem; font-size: 2rem;">No Movies Yet!</h3>
            <p style="color: #cccccc; margin-bottom: 2rem; font-size: 1.2rem;">Start building your movie library by adding your first movie.</p>
            <a href="{{ route('movies.create') }}" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.1rem;">
                ➕ Add Your First Movie
            </a>
        </div>
    @endif
@endsection