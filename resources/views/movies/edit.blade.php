@extends('layouts.app')

@section('title', 'Edit Movie - CineTrack')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <!-- Header -->
            <div class="text-center mb-5" data-aos="fade-down">
                <h1 class="display-4 fw-bold mb-3" style="font-family: 'Cinzel', serif; background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <span class="material-symbols-outlined me-3" style="font-size: 3rem; vertical-align: middle;">edit</span>
                    Edit Movie
                </h1>
                <p class="lead text-light">Update "{{ $movie->title }}" details</p>
                
                <!-- Movie Info Badge -->
                <div class="d-inline-flex align-items-center gap-3 mt-3 p-3 rounded-pill" 
                     style="background: rgba(229, 9, 20, 0.1); border: 1px solid rgba(229, 9, 20, 0.3);">
                    <span class="badge bg-{{ $movie->status === 'Watched' ? 'success' : 'warning' }} rounded-pill px-3 py-2">
                        <span class="material-symbols-outlined me-1" style="font-size: 1rem;">
                            {{ $movie->status === 'Watched' ? 'check_circle' : 'schedule' }}
                        </span>
                        {{ $movie->status }}
                    </span>
                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                        <span class="material-symbols-outlined me-1" style="font-size: 1rem;">category</span>
                        {{ $movie->category }}
                    </span>
                    <span class="text-muted">
                        <span class="material-symbols-outlined me-1">calendar_today</span>
                        Added {{ $movie->created_at->format('M j, Y') }}
                    </span>
                </div>
            </div>

            <!-- Current Poster Preview -->
            @if($movie->poster)
                <div class="text-center mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card d-inline-block">
                        <div class="card-body p-3">
                            <h6 class="card-title text-light mb-3">
                                <span class="material-symbols-outlined me-2">image</span>
                                Current Poster
                            </h6>
                            <img src="{{ $movie->poster }}" 
                                 alt="{{ $movie->title }}" 
                                 class="img-thumbnail current-poster"
                                 style="max-width: 200px; max-height: 300px; border-radius: 15px; border: 3px solid var(--accent);">
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header border-0 text-center py-4">
                    <h4 class="card-title text-light mb-0">
                        <span class="material-symbols-outlined me-2">edit_note</span>
                        Update Movie Details
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data" id="editMovieForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <!-- Movie Title -->
                            <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                                <label for="title" class="form-label">
                                    <span class="material-symbols-outlined me-2">title</span>
                                    Movie Title *
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $movie->title) }}" 
                                       required
                                       placeholder="Enter the movie title">
                                @error('title')
                                    <div class="invalid-feedback">
                                        <span class="material-symbols-outlined me-1">error</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Poster URL -->
                            <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                                <label for="poster_url" class="form-label">
                                    <span class="material-symbols-outlined me-2">image</span>
                                    Poster URL
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="material-symbols-outlined">link</span>
                                    </span>
                                    <input type="url" 
                                           class="form-control @error('poster_url') is-invalid @enderror" 
                                           id="poster_url" 
                                           name="poster_url" 
                                           value="{{ old('poster_url', $movie->poster_url) }}"
                                           placeholder="https://example.com/poster.jpg">
                                    <button type="button" class="btn btn-outline-secondary" onclick="previewPoster()">
                                        <span class="material-symbols-outlined">preview</span>
                                    </button>
                                </div>
                                @error('poster_url')
                                    <div class="invalid-feedback d-block">
                                        <span class="material-symbols-outlined me-1">error</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                <!-- New Poster Preview -->
                                <div id="posterPreview" class="mt-3 text-center" style="display: none;">
                                    <div class="card d-inline-block">
                                        <div class="card-body p-3">
                                            <h6 class="card-title text-light mb-2">New Poster Preview</h6>
                                            <img id="posterImage" class="img-thumbnail" style="max-width: 200px; max-height: 300px; border-radius: 15px; border: 3px solid var(--success);">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- OR Divider -->
                            <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="450">
                                <div class="position-relative">
                                    <hr style="border-color: rgba(255,255,255,0.2);">
                                    <span class="position-absolute top-50 start-50 translate-middle px-3" 
                                          style="background: var(--bg-card); color: var(--text-secondary);">OR</span>
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="col-12" data-aos="fade-up" data-aos-delay="500">
                                <label for="poster_file" class="form-label">
                                    <span class="material-symbols-outlined me-2">upload</span>
                                    Upload New Poster (Optional)
                                </label>
                                <div class="upload-area p-4 text-center border rounded-3" 
                                     style="border: 2px dashed rgba(255,255,255,0.3); transition: all 0.3s ease;"
                                     ondrop="handleFileDrop(event)" 
                                     ondragover="handleDragOver(event)"
                                     ondragleave="handleDragLeave(event)">
                                    <span class="material-symbols-outlined display-4 text-muted mb-3">cloud_upload</span>
                                    <p class="text-muted mb-2">Upload a new poster to replace the current one</p>
                                    <input type="file" 
                                           class="form-control @error('poster_file') is-invalid @enderror" 
                                           id="poster_file" 
                                           name="poster_file" 
                                           accept="image/*"
                                           onchange="previewUploadedFile(this)">
                                </div>
                                <div class="form-text text-muted">
                                    <span class="material-symbols-outlined me-1">info</span>
                                    Leave empty to keep the current poster. Max size: 2MB
                                </div>
                                @error('poster_file')
                                    <div class="invalid-feedback d-block">
                                        <span class="material-symbols-outlined me-1">error</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Category and Status Row -->
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                                <label for="category" class="form-label">
                                    <span class="material-symbols-outlined me-2">category</span>
                                    Category *
                                </label>
                                <select class="form-select form-select-lg @error('category') is-invalid @enderror" 
                                        id="category" 
                                        name="category" 
                                        required>
                                    <option value="Action" {{ old('category', $movie->category) === 'Action' ? 'selected' : '' }}>🎯 Action</option>
                                    <option value="Comedy" {{ old('category', $movie->category) === 'Comedy' ? 'selected' : '' }}>😂 Comedy</option>
                                    <option value="Drama" {{ old('category', $movie->category) === 'Drama' ? 'selected' : '' }}>🎭 Drama</option>
                                    <option value="Horror" {{ old('category', $movie->category) === 'Horror' ? 'selected' : '' }}>👻 Horror</option>
                                    <option value="Romance" {{ old('category', $movie->category) === 'Romance' ? 'selected' : '' }}>💕 Romance</option>
                                    <option value="Sci-Fi" {{ old('category', $movie->category) === 'Sci-Fi' ? 'selected' : '' }}>🚀 Sci-Fi</option>
                                    <option value="Thriller" {{ old('category', $movie->category) === 'Thriller' ? 'selected' : '' }}>🔪 Thriller</option>
                                    <option value="Animation" {{ old('category', $movie->category) === 'Animation' ? 'selected' : '' }}>🎨 Animation</option>
                                    <option value="Documentary" {{ old('category', $movie->category) === 'Documentary' ? 'selected' : '' }}>📖 Documentary</option>
                                    <option value="Fantasy" {{ old('category', $movie->category) === 'Fantasy' ? 'selected' : '' }}>🧙‍♂️ Fantasy</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        <span class="material-symbols-outlined me-1">error</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                                <label for="status" class="form-label">
                                    <span class="material-symbols-outlined me-2">check_circle</span>
                                    Status *
                                </label>
                                <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="Pending" {{ old('status', $movie->status) === 'Pending' ? 'selected' : '' }}>
                                        🕐 Want to Watch
                                    </option>
                                    <option value="Watched" {{ old('status', $movie->status) === 'Watched' ? 'selected' : '' }}>
                                        ✅ Already Watched
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        <span class="material-symbols-outlined me-1">error</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Public Visibility -->
                            <div class="col-12" data-aos="fade-up" data-aos-delay="800">
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_public" 
                                           name="is_public" 
                                           value="1" 
                                           {{ old('is_public', $movie->is_public) ? 'checked' : '' }}>
                                    <label class="form-check-label text-light" for="is_public">
                                        <span class="material-symbols-outlined me-2">public</span>
                                        Make this movie visible to other users
                                        <small class="d-block text-muted mt-1">
                                            {{ $movie->is_public ? 'Currently public' : 'Currently private' }}
                                        </small>
                                    </label>
                                </div>
                            </div>

                            <!-- Change Log -->
                            <div class="col-12" data-aos="fade-up" data-aos-delay="850">
                                <div class="alert alert-info">
                                    <h6 class="alert-heading">
                                        <span class="material-symbols-outlined me-2">history</span>
                                        Movie History
                                    </h6>
                                    <hr>
                                    <div class="row text-sm">
                                        <div class="col-md-6">
                                            <strong>Created:</strong> {{ $movie->created_at->format('M j, Y \a\t g:i A') }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Last Updated:</strong> {{ $movie->updated_at->format('M j, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-12" data-aos="fade-up" data-aos-delay="900">
                                <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5" id="updateBtn">
                                        <span class="material-symbols-outlined me-2">save</span>
                                        <span class="btn-text">Update Movie</span>
                                        <div class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                    <a href="{{ route('movies.index') }}" class="btn btn-secondary btn-lg px-5">
                                        <span class="material-symbols-outlined me-2">cancel</span>
                                        Cancel
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <span class="material-symbols-outlined me-2">delete</span>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-light" id="deleteModalLabel">
                    <span class="material-symbols-outlined me-2 text-danger">warning</span>
                    Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <span class="material-symbols-outlined display-1 text-danger mb-3">delete_forever</span>
                <h5 class="text-light mb-3">Delete "{{ $movie->title }}"?</h5>
                <p class="text-muted">This action cannot be undone. The movie will be permanently removed from your library.</p>
            </div>
            <div class="modal-footer border-top-0 justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <span class="material-symbols-outlined me-2">cancel</span>
                    Cancel
                </button>
                <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <span class="material-symbols-outlined me-2">delete_forever</span>
                        Yes, Delete Movie
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Current poster styling */
.current-poster {
    transition: all 0.3s ease;
    cursor: pointer;
}

.current-poster:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 35px rgba(229, 9, 20, 0.3);
}

/* Enhanced upload area */
.upload-area:hover {
    border-color: var(--accent) !important;
    background: rgba(229, 9, 20, 0.05);
    transform: scale(1.02);
}

.upload-area.drag-over {
    border-color: var(--accent) !important;
    background: rgba(229, 9, 20, 0.1);
    transform: scale(1.05);
}

/* Alert styling */
.alert-info {
    background: rgba(23, 162, 184, 0.1);
    border: 1px solid rgba(23, 162, 184, 0.3);
    color: #b3e5fc;
}

/* Modal enhancements */
.modal-content {
    border-radius: 20px;
    backdrop-filter: blur(20px);
}

/* Form comparison indicators */
.form-control.changed,
.form-select.changed {
    border-left: 4px solid var(--warning);
}

.form-control.changed:focus,
.form-select.changed:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}
</style>

<script>
// Store original values for change detection
const originalValues = {
    title: "{{ $movie->title }}",
    poster_url: "{{ $movie->poster_url }}",
    category: "{{ $movie->category }}",
    status: "{{ $movie->status }}",
    is_public: {{ $movie->is_public ? 'true' : 'false' }}
};

// Poster URL preview
function previewPoster() {
    const url = document.getElementById('poster_url').value;
    const preview = document.getElementById('posterPreview');
    const image = document.getElementById('posterImage');
    
    if (url && url !== originalValues.poster_url) {
        image.src = url;
        image.onload = function() {
            preview.style.display = 'block';
        };
        image.onerror = function() {
            preview.style.display = 'none';
            alert('Unable to load image from this URL. Please check the URL and try again.');
        };
    } else {
        preview.style.display = 'none';
    }
}

// Auto-preview when URL is changed
document.getElementById('poster_url').addEventListener('input', function() {
    clearTimeout(this.previewTimeout);
    this.previewTimeout = setTimeout(previewPoster, 1000);
    checkForChanges();
});

// File upload preview
function previewUploadedFile(input) {
    const preview = document.getElementById('posterPreview');
    const image = document.getElementById('posterImage');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
            preview.style.display = 'block';
            
            // Clear poster URL when file is uploaded
            document.getElementById('poster_url').value = '';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Drag and drop functionality
function handleDragOver(e) {
    e.preventDefault();
    e.currentTarget.classList.add('drag-over');
}

function handleDragLeave(e) {
    e.preventDefault();
    e.currentTarget.classList.remove('drag-over');
}

function handleFileDrop(e) {
    e.preventDefault();
    e.currentTarget.classList.remove('drag-over');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('poster_file').files = files;
        previewUploadedFile(document.getElementById('poster_file'));
    }
}

// Check for changes and highlight modified fields
function checkForChanges() {
    const fields = ['title', 'poster_url', 'category', 'status'];
    
    fields.forEach(field => {
        const element = document.getElementById(field);
        if (element.value !== originalValues[field]) {
            element.classList.add('changed');
        } else {
            element.classList.remove('changed');
        }
    });
    
    const isPublicCheckbox = document.getElementById('is_public');
    if (isPublicCheckbox.checked !== originalValues.is_public) {
        isPublicCheckbox.parentNode.classList.add('changed');
    } else {
        isPublicCheckbox.parentNode.classList.remove('changed');
    }
}

// Add change detection to all form fields
document.querySelectorAll('#editMovieForm input, #editMovieForm select').forEach(element => {
    element.addEventListener('input', checkForChanges);
    element.addEventListener('change', checkForChanges);
});

// Form submission with loading state
document.getElementById('editMovieForm').addEventListener('submit', function() {
    const updateBtn = document.getElementById('updateBtn');
    const btnText = updateBtn.querySelector('.btn-text');
    const spinner = updateBtn.querySelector('.spinner-border');
    
    updateBtn.disabled = true;
    btnText.textContent = 'Updating...';
    spinner.classList.remove('d-none');
});

// Warn user about unsaved changes
let hasUnsavedChanges = false;

document.querySelectorAll('#editMovieForm input, #editMovieForm select').forEach(element => {
    element.addEventListener('input', () => hasUnsavedChanges = true);
    element.addEventListener('change', () => hasUnsavedChanges = true);
});

document.getElementById('editMovieForm').addEventListener('submit', () => {
    hasUnsavedChanges = false;
});

window.addEventListener('beforeunload', function(e) {
    if (hasUnsavedChanges) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + S to save
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        document.getElementById('editMovieForm').dispatchEvent(new Event('submit'));
    }
});

// Initialize change detection on page load
document.addEventListener('DOMContentLoaded', function() {
    checkForChanges();
    
    // If there's an existing poster URL, show it
    if (document.getElementById('poster_url').value) {
        previewPoster();
    }
});
</script>
@endsection