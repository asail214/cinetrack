<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poster_url',
        'poster_file',
        'category',
        'status',
        'user_id',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    // Get poster URL (either uploaded file or external URL)
    public function getPosterAttribute(): string
    {
        if ($this->poster_file) {
            return asset('storage/' . $this->poster_file);
        }
        
        return $this->poster_url ?: 'https://via.placeholder.com/300x400/333/fff?text=No+Image';
    }

    // Check if has uploaded poster
    public function hasUploadedPoster(): bool
    {
        return !empty($this->poster_file);
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}