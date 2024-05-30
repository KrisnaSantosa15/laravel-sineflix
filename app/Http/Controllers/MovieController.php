<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use App\Models\Watchlist;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->get();
        $genres = Genre::withCount('movies')->get();
        $watchlist = Watchlist::where('user_id', Auth::id())->pluck('movie_id')->toArray();


        return view('welcome', compact('movies', 'genres', 'watchlist'));
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function type($type)
    {
        $movies = Movie::where('type', $type)->get();
        $genres = Genre::withCount('movies')->get();

        return view('movies.type', compact('movies', 'genres', 'type'));
    }

    public function genre(Genre $genre)
    {
        $movies = $genre->movies;
        $genres = Genre::withCount('movies')->get();

        return view('movies.genre', compact('movies', 'genres', 'genre'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $search = $request->search;
        $movies = Movie::where('title', 'like', '%' . $search . '%')->get();
        $genres = Genre::withCount('movies')->get();

        return view('movies.search', compact('movies', 'genres', 'search'));
    }
}
