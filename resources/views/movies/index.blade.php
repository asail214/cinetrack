@extends('layouts.app')

@section('title', 'Dashboard - CineTrack')

@section('content')
<div class="container-fluid px-4">
    <!-- Hero Section -->
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="display-3 fw-bold mb-3" style="font-family: 'Cinzel', serif; background: linear-gradient(135deg, #e50914 0%, #f40612 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            <span class="material-symbols-outlined me-3" style="font-size: 4rem; vertical-align: middle;">movie_filter</span>
            My CineTrack Library
        </h1>
        <p class="lead text-light mb-4" style="color: var(--text-secondary) !important; font-size: 1.3rem;">
            Discover, track, and organize your cinematic journey
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('movies.create') }}" class="btn btn-primary btn-lg" data-aos="zoom-in" data-aos-delay="200">
                <span class="material-symbols-outlined me-2">add_circle</span>
                Add New Movie
            </a>
            <button class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#filtersModal" data-aos="zoom-in" data-aos-delay="300">
                <span class="material-symbols-outlined me-2">filter_list</span>
                Filters
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card stats-card h-100 text-center">
                <div class="card-body p-4">
                    <span class="material-symbols-outlined display-1 mb-3" style="color: var(--accent);">movie</span>
                    <h2 class="stats-number display-4 mb-2">{{ $totalMovies }}</h2>
                    <p class="text-light fs-5 mb-0">Total Movies</p>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar" style="background: var(--gradient-primary); width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card stats-card h-100 text-center">
                <div class="card-body p-4">
                    <span class="material-symbols-outlined display-1 mb-3 text-success">check_circle</span>
                    <h2 class="stats-number display-4 mb-2 text-success">{{ $watchedMovies }}</h2>
                    <p class="text-light fs-5 mb-0">Watched</p>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalMovies > 0 ? ($watchedMovies / $totalMovies) * 100 : 0 }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card stats-card h-100 text-center">
                <div class="card-body p-4">
                    <span class="material-symbols-outlined display-1 mb-3 text-warning">schedule</span>
                    <h2 class="stats-number display-4 mb-2 text-warning">{{ $pendingMovies }}</h2>
                    <p class="text-light fs-5 mb-0">Want to Watch</p>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: {{ $totalMovies > 0 ? ($pendingMovies / $totalMovies) * 100 : 0 }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card" data-aos="fade-up">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="card-title mb-0 text-light">
                                <span class="material-symbols-outlined me-2">library_books</span>
                                Your Movie Collection
                            </h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="viewMode" id="gridView" autocomplete="off" checked>
                                <label class="btn btn-outline-light" for="gridView">
                                    <span class="material-symbols-outlined">grid_view</span>
                                </label>
                                <input type="radio" class="btn-check" name="viewMode" id="listView" autocomplete="off">
                                <label class="btn btn-outline-light" for="listView">
                                    <span class="material-symbols-outlined">list</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Movies Grid -->
    @if($movies->count() > 0)
        <div class="row g-4" id="moviesGrid">
            @foreach($movies as $index => $movie)
                <div class="col-lg-3 col-md-4 col-sm-6 movie-item" data-aos="fade-up" data-aos-delay="{{ ($index % 8) * 100 }}">
                    <div class="card movie-card h-100 position-relative">
                        <!-- Movie Poster -->
                        <div class="movie-poster-container position-relative">
                            <img src="{{ $movie->poster }}" 
                                 class="movie-poster" 
                                 alt="{{ $movie->title }}"
                                 loading="lazy"
                                 onerror="this.src='https://via.placeholder.com/300x450/252525/ffffff?text=No+Poster+Available'">
                            
                            <!-- Status Badge -->
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge status-badge fs-6 px-3 py-2 rounded-pill
                                    {{ $movie->status === 'Watched' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    <span class="material-symbols-outlined me-1" style="font-size: 1rem;">
                                        {{ $movie->status === 'Watched' ? 'check_circle' : 'schedule' }}
                                    </span>
                                    {{ $movie->status }}
                                </span>
                            </div>
                            
                            <!-- Quick Actions Overlay -->
                            <div class="position-absolute bottom-0 start-0 end-0 p-3 d-flex gap-2 opacity-0 quick-actions" 
                                 style="background: linear-gradient(transparent, rgba(0,0,0,0.8)); transition: opacity 0.3s ease;">
                                <!-- Toggle Status -->
                                <form action="{{ route('movies.update', $movie) }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="title" value="{{ $movie->title }}">
                                    <input type="hidden" name="poster_url" value="{{ $movie->poster_url }}">
                                    <input type="hidden" name="category" value="{{ $movie->category }}">
                                    <input type="hidden" name="status" value="{{ $movie->status === 'Watched' ? 'Pending' : 'Watched' }}">
                                    <button type="submit" class="btn btn-sm w-100 {{ $movie->status === 'Watched' ? 'btn-warning' : 'btn-success' }}"
                                            title="{{ $movie->status === 'Watched' ? 'Mark as Pending' : 'Mark as Watched' }}">
                                        <span class="material-symbols-outlined">
                                            {{ $movie->status === 'Watched' ? 'schedule' : 'check_circle' }}
                                        </span>
                                    </button>
                                </form>
                                
                                <!-- Edit Button -->
                                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-sm btn-primary" title="Edit Movie">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete Movie"
                                            onclick="return confirm('Are you sure you want to delete {{ $movie->title }}?')">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Movie Info -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-light fw-bold mb-2" style="font-size: 1.1rem; line-height: 1.3;">
                                {{ $movie->title }}
                            </h5>
                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-secondary rounded-pill">
                                    <span class="material-symbols-outlined me-1" style="font-size: 0.9rem;">category</span>
                                    {{ $movie->category }}
                                </span>
                                @if($movie->is_public)
                                    <span class="badge bg-info rounded-pill">
                                        <span class="material-symbols-outlined me-1" style="font-size: 0.9rem;">public</span>
                                        Public
                                    </span>
                                @endif
                            </div>
                            
                            <div class="mt-auto">
                                <small class="text-muted d-flex align-items-center">
                                    <span class="material-symbols-outlined me-1" style="font-size: 1rem;">calendar_today</span>
                                    Added {{ $movie->created_at->format('M j, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if(method_exists($movies, 'links'))
            <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                {{ $movies->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="text-center py-5" data-aos="fade-up">
            <div class="card mx-auto" style="max-width: 600px;">
                <div class="card-body p-5">
                    <span class="material-symbols-outlined display-1 text-muted mb-4" style="font-size: 8rem;">movie</span>
                    <h3 class="text-light mb-3">No Movies Yet!</h3>
                    <p class="text-muted mb-4 fs-5">Start building your cinematic library by adding your first movie.</p>
                    <a href="{{ route('movies.create') }}" class="btn btn-primary btn-lg">
                        <span class="material-symbols-outlined me-2">add_circle</span>
                        Add Your First Movie
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Filters Modal -->
<div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-light" id="filtersModalLabel">
                    <span class="material-symbols-outlined me-2">filter_list</span>
                    Filter Movies
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('movies.index') }}">
                    <div class="mb-4">
                        <label for="categoryFilter" class="form-label">
                            <span class="material-symbols-outlined me-2">category</span>
                            Category
                        </label>
                        <select class="form-select" id="categoryFilter" name="category">
                            <option value="">All Categories</option>
                            <option value="Action">🎯 Action</option>
                            <option value="Comedy">😂 Comedy</option>
                            <option value="Drama">🎭 Drama</option>
                            <option value="Horror">👻 Horror</option>
                            <option value="Romance">💕 Romance</option>
                            <option value="Sci-Fi">🚀 Sci-Fi</option>
                            <option value="Thriller">🔪 Thriller</option>
                            <option value="Animation">🎨 Animation</option>
                            <option value="Documentary">📖 Documentary</option>
                            <option value="Fantasy">🧙‍♂️ Fantasy</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="statusFilter" class="form-label">
                            <span class="material-symbols-outlined me-2">check_circle</span>
                            Status
                        </label>
                        <select class="form-select" id="statusFilter" name="status">
                            <option value="">All Status</option>
                            <option value="Watched">✅ Watched</option>
                            <option value="Pending">🕐 Want to Watch</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <span class="material-symbols-outlined me-2">search</span>
                            Apply Filters
                        </button>
                        <a href="{{ route('movies.index') }}" class="btn btn-secondary">
                            <span class="material-symbols-outlined">clear</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Movie Card Hover Effects */
.movie-card:hover .quick-actions {
    opacity: 1 !important;
}

.movie-card:hover {
    transform: translateY(-10px) scale(1.02);
}

/* Enhanced animations */
@keyframes movieCardFloat {
    0%, 100% { transform: translateY(0px) scale(1); }
    50% { transform: translateY(-5px) scale(1.01); }
}

.movie-card:hover {
    animation: movieCardFloat 0.6s ease-in-out;
}

/* Progress bar animations */
.progress-bar {
    animation: progressFill 1.5s ease-in-out;
}

@keyframes progressFill {
    0% { width: 0% !important; }
}

/* Modal enhancements */
.modal-content {
    border-radius: 20px;
    backdrop-filter: blur(20px);
}

/* Custom badge styles */
.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* Button group enhancements */
.btn-group .btn {
    border-radius: 10px;
    margin: 0 2px;
}

/* Stats card hover effect */
.stats-card:hover {
    transform: translateY(-5px);
}

/* Enhanced dropdown */
.dropdown-menu {
    background: var(--bg-card);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    backdrop-filter: blur(20px);
}

.dropdown-item {
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: var(--gradient-primary);
    color: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View mode toggle
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const moviesGrid = document.getElementById('moviesGrid');
    
    if (listView && gridView && moviesGrid) {
        listView.addEventListener('change', function() {
            if (this.checked) {
                moviesGrid.className = 'row g-2';
                document.querySelectorAll('.movie-item').forEach(item => {
                    item.className = 'col-12 movie-item';
                });
            }
        });
        
        gridView.addEventListener('change', function() {
            if (this.checked) {
                moviesGrid.className = 'row g-4';
                document.querySelectorAll('.movie-item').forEach(item => {
                    item.className = 'col-lg-3 col-md-4 col-sm-6 movie-item';
                });
            }
        });
    }
    
    // Stagger animations for movie cards
    const movieCards = document.querySelectorAll('.movie-card');
    movieCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Enhanced search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.movie-item').forEach(item => {
                const title = item.querySelector('.card-title').textContent.toLowerCase();
                const category = item.querySelector('.badge').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || category.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection