<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'release_date',
        'type',
        'director',
        'plot_summary',
        'rating',
        'poster_url',
        'trailer_url',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function stars()
    {
        return $this->belongsToMany(Stars::class);
    }

    public function watchlist()
    {
        return $this->belongsToMany(Watchlist::class);
    }

    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}
