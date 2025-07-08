@extends('layouts.app')

@section('title', 'Add Movie - CineTrack')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <!-- Header -->
            <div class="text-center mb-5" data-aos="fade-down">
                <h1 class="display-4 fw-bold mb-3" style="font-family: 'Cinzel', serif; background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <span class="material-symbols-outlined me-3" style="font-size: 3rem; vertical-align: middle;">add_circle</span>
                    Add New Movie
                </h1>
                <p class="lead text-light">Add a movie to your personal cinematic collection</p>
            </div>

            <!-- Form Card -->
            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header border-0 text-center py-4">
                    <h4 class="card-title text-light mb-0">
                        <span class="material-symbols-outlined me-2">movie_filter</span>
                        Movie Details
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" id="movieForm">
                        @csrf
                        
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
                                       value="{{ old('title') }}" 
                                       required
                                       placeholder="Enter the movie title"
                                       autocomplete="off">
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
                                           value="{{ old('poster_url') }}"
                                           placeholder="https://example.com/poster.jpg">
                                    <button type="button" class="btn btn-outline-secondary" onclick="previewPoster()">
                                        <span class="material-symbols-outlined">preview</span>
                                    </button>
                                </div>
                                <div class="form-text text-muted">
                                    <span class="material-symbols-outlined me-1">info</span>
                                    Find poster URLs from TMDb, IMDb, or other movie databases
                                </div>
                                @error('poster_url')
                                    <div class="invalid-feedback d-block">
                                        <span class="material-symbols-outlined me-1">error</span>
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                <!-- Poster Preview -->
                                <div id="posterPreview" class="mt-3 text-center" style="display: none;">
                                    <img id="posterImage" class="img-thumbnail" style="max-width: 200px; max-height: 300px; border-radius: 15px;">
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
                                    Upload Poster Image
                                </label>
                                <div class="upload-area p-4 text-center border rounded-3" 
                                     style="border: 2px dashed rgba(255,255,255,0.3); transition: all 0.3s ease;"
                                     ondrop="handleFileDrop(event)" 
                                     ondragover="handleDragOver(event)"
                                     ondragleave="handleDragLeave(event)">
                                    <span class="material-symbols-outlined display-4 text-muted mb-3">cloud_upload</span>
                                    <p class="text-muted mb-2">Drag & drop your poster here or click to browse</p>
                                    <input type="file" 
                                           class="form-control @error('poster_file') is-invalid @enderror" 
                                           id="poster_file" 
                                           name="poster_file" 
                                           accept="image/*"
                                           onchange="previewUploadedFile(this)">
                                </div>
                                <div class="form-text text-muted">
                                    <span class="material-symbols-outlined me-1">info</span>
                                    Maximum file size: 2MB. Supported formats: JPEG, PNG, WebP
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
                                    <option value="">Choose a category...</option>
                                    <option value="Action" {{ old('category') === 'Action' ? 'selected' : '' }}>🎯 Action</option>
                                    <option value="Comedy" {{ old('category') === 'Comedy' ? 'selected' : '' }}>😂 Comedy</option>
                                    <option value="Drama" {{ old('category') === 'Drama' ? 'selected' : '' }}>🎭 Drama</option>
                                    <option value="Horror" {{ old('category') === 'Horror' ? 'selected' : '' }}>👻 Horror</option>
                                    <option value="Romance" {{ old('category') === 'Romance' ? 'selected' : '' }}>💕 Romance</option>
                                    <option value="Sci-Fi" {{ old('category') === 'Sci-Fi' ? 'selected' : '' }}>🚀 Sci-Fi</option>
                                    <option value="Thriller" {{ old('category') === 'Thriller' ? 'selected' : '' }}>🔪 Thriller</option>
                                    <option value="Animation" {{ old('category') === 'Animation' ? 'selected' : '' }}>🎨 Animation</option>
                                    <option value="Documentary" {{ old('category') === 'Documentary' ? 'selected' : '' }}>📖 Documentary</option>
                                    <option value="Fantasy" {{ old('category') === 'Fantasy' ? 'selected' : '' }}>🧙‍♂️ Fantasy</option>
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
                                    <option value="Pending" {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}>
                                        🕐 Want to Watch
                                    </option>
                                    <option value="Watched" {{ old('status') === 'Watched' ? 'selected' : '' }}>
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
                                           {{ old('is_public') ? 'checked' : '' }}>
                                    <label class="form-check-label text-light" for="is_public">
                                        <span class="material-symbols-outlined me-2">public</span>
                                        Make this movie visible to other users
                                        <small class="d-block text-muted mt-1">
                                            Public movies can be discovered by other CineTrack users
                                        </small>
                                    </label>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-12" data-aos="fade-up" data-aos-delay="900">
                                <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5" id="submitBtn">
                                        <span class="material-symbols-outlined me-2">add_circle</span>
                                        <span class="btn-text">Add Movie</span>
                                        <div class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                    <a href="{{ route('movies.index') }}" class="btn btn-secondary btn-lg px-5">
                                        <span class="material-symbols-outlined me-2">cancel</span>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card mt-4" data-aos="fade-up" data-aos-delay="1000">
                <div class="card-body">
                    <h6 class="card-title text-light">
                        <span class="material-symbols-outlined me-2">lightbulb</span>
                        Pro Tips
                    </h6>
                    <ul class="list-unstyled mb-0 text-muted">
                        <li class="mb-2">
                            <span class="material-symbols-outlined me-2 text-info">search</span>
                            Find high-quality posters on <strong>The Movie Database (TMDb)</strong> or <strong>IMDb</strong>
                        </li>
                        <li class="mb-2">
                            <span class="material-symbols-outlined me-2 text-warning">image</span>
                            Use images with a <strong>2:3 aspect ratio</strong> (like 300x450px) for best results
                        </li>
                        <li>
                            <span class="material-symbols-outlined me-2 text-success">public</span>
                            Public movies help build a community of movie enthusiasts
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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

/* Form animations */
.form-control:focus, .form-select:focus {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(229, 9, 20, 0.15) !important;
}

/* Enhanced switches */
.form-check-input:checked {
    background-color: var(--accent);
    border-color: var(--accent);
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25);
}

/* Button loading state */
.btn:disabled {
    opacity: 0.7;
}

/* Input group enhancements */
.input-group-text {
    background: var(--bg-secondary);
    border-color: rgba(255,255,255,0.1);
    color: var(--text-secondary);
}

/* Poster preview animations */
#posterPreview img {
    transition: all 0.3s ease;
    border: 3px solid var(--accent);
}

#posterPreview img:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(229, 9, 20, 0.3);
}
</style>

<script>
// Poster URL preview
function previewPoster() {
    const url = document.getElementById('poster_url').value;
    const preview = document.getElementById('posterPreview');
    const image = document.getElementById('posterImage');
    
    if (url) {
        image.src = url;
        image.onload = function() {
            preview.style.display = 'block';
            AOS.refresh(); // Refresh AOS for new elements
        };
        image.onerror = function() {
            preview.style.display = 'none';
            alert('Unable to load image from this URL. Please check the URL and try again.');
        };
    } else {
        preview.style.display = 'none';
    }
}

// Auto-preview when URL is entered
document.getElementById('poster_url').addEventListener('input', function() {
    clearTimeout(this.previewTimeout);
    this.previewTimeout = setTimeout(previewPoster, 1000);
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

// Form submission with loading state
document.getElementById('movieForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    submitBtn.disabled = true;
    btnText.textContent = 'Adding Movie...';
    spinner.classList.remove('d-none');
});

// Auto-fill from movie database (basic example)
document.getElementById('title').addEventListener('blur', function() {
    const title = this.value.trim();
    if (title && !document.getElementById('poster_url').value) {
        // This is where you could integrate with a movie API
        // For now, just show a helpful message
        console.log('Consider fetching poster from movie database for:', title);
    }
});

// Form validation enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Add real-time validation
    const titleInput = document.getElementById('title');
    const categorySelect = document.getElementById('category');
    
    titleInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        }
    });
    
    categorySelect.addEventListener('change', function() {
        if (this.value) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        }
    });
    
    // Character counter for title
    titleInput.addEventListener('input', function() {
        const maxLength = 255;
        const currentLength = this.value.length;
        let feedback = this.parentNode.querySelector('.char-counter');
        
        if (!feedback) {
            feedback = document.createElement('div');
            feedback.className = 'char-counter form-text text-muted mt-1';
            this.parentNode.appendChild(feedback);
        }
        
        feedback.innerHTML = `
            <span class="material-symbols-outlined me-1">edit</span>
            ${currentLength}/${maxLength} characters
        `;
        
        if (currentLength > maxLength * 0.9) {
            feedback.classList.remove('text-muted');
            feedback.classList.add('text-warning');
        } else {
            feedback.classList.remove('text-warning');
            feedback.classList.add('text-muted');
        }
    });
});

// Enhanced file size validation
document.getElementById('poster_file').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        
        if (file.size > maxSize) {
            this.classList.add('is-invalid');
            
            // Show custom error message
            let errorDiv = this.parentNode.querySelector('.file-size-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'file-size-error invalid-feedback d-block';
                this.parentNode.appendChild(errorDiv);
            }
            
            errorDiv.innerHTML = `
                <span class="material-symbols-outlined me-1">error</span>
                File size too large. Maximum allowed size is 2MB.
            `;
            
            // Clear the file input
            this.value = '';
            document.getElementById('posterPreview').style.display = 'none';
        } else {
            this.classList.remove('is-invalid');
            const errorDiv = this.parentNode.querySelector('.file-size-error');
            if (errorDiv) {
                errorDiv.remove();
            }
        }
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + Enter to submit form
    if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('movieForm').dispatchEvent(new Event('submit'));
    }
    
    // Escape to cancel (go back)
    if (e.key === 'Escape') {
        if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
            window.location.href = "{{ route('movies.index') }}";
        }
    }
});

// Auto-save to localStorage (optional feature)
function autoSave() {
    const formData = {
        title: document.getElementById('title').value,
        poster_url: document.getElementById('poster_url').value,
        category: document.getElementById('category').value,
        status: document.getElementById('status').value,
        is_public: document.getElementById('is_public').checked
    };
    
    localStorage.setItem('cinetrack_draft_movie', JSON.stringify(formData));
}

// Load auto-saved data
function loadAutoSaved() {
    const saved = localStorage.getItem('cinetrack_draft_movie');
    if (saved) {
        const data = JSON.parse(saved);
        
        if (confirm('Found unsaved movie data. Would you like to restore it?')) {
            document.getElementById('title').value = data.title || '';
            document.getElementById('poster_url').value = data.poster_url || '';
            document.getElementById('category').value = data.category || '';
            document.getElementById('status').value = data.status || 'Pending';
            document.getElementById('is_public').checked = data.is_public || false;
            
            // Preview poster if URL exists
            if (data.poster_url) {
                previewPoster();
            }
        }
    }
}

// Set up auto-save
document.querySelectorAll('#movieForm input, #movieForm select').forEach(element => {
    element.addEventListener('input', autoSave);
    element.addEventListener('change', autoSave);
});

// Clear auto-save on successful submission
document.getElementById('movieForm').addEventListener('submit', function() {
    localStorage.removeItem('cinetrack_draft_movie');
});

// Load auto-saved data when page loads
window.addEventListener('load', loadAutoSaved);
</script>
@endsection