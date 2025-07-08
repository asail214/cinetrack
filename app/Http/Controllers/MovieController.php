<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        $movies = Movie::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalMovies = $movies->count();
        $watchedMovies = $movies->where('status', 'Watched')->count();
        $pendingMovies = $movies->where('status', 'Pending')->count();
        
        return view('movies.index', compact('movies', 'totalMovies', 'watchedMovies', 'pendingMovies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster_url' => 'nullable|url',
            'poster_file' => 'nullable|image|max:2048',
            'category' => 'required|string',
            'status' => 'required|in:Pending,Watched',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['is_public'] = $request->has('is_public');
        
        // Handle file upload
        if ($request->hasFile('poster_file')) {
            $file = $request->file('poster_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('posters', $filename, 'public');
            $data['poster_file'] = $path;
        }
        
        Movie::create($data);
        
        return redirect()->route('movies.index')
            ->with('success', 'Movie added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        // Check if user owns this movie
        if ($movie->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        // Check if user owns this movie
        if ($movie->user_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'poster_url' => 'nullable|url',
            'poster_file' => 'nullable|image|max:2048',
            'category' => 'required|string',
            'status' => 'required|in:Pending,Watched',
        ]);
        
        $data = $request->all();
        $data['is_public'] = $request->has('is_public');
        
        // Handle file upload
        if ($request->hasFile('poster_file')) {
            // Delete old file
            if ($movie->poster_file) {
                Storage::disk('public')->delete($movie->poster_file);
            }
            
            $file = $request->file('poster_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('posters', $filename, 'public');
            $data['poster_file'] = $path;
        }
        
        $movie->update($data);
        
        return redirect()->route('movies.index')
            ->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // Check if user owns this movie
        if ($movie->user_id !== Auth::id()) {
            abort(403);
        }
        
        // Delete file if exists
        if ($movie->poster_file) {
            Storage::disk('public')->delete($movie->poster_file);
        }
        
        $movie->delete();
        
        return redirect()->route('movies.index')
            ->with('success', 'Movie deleted successfully!');
    }
}