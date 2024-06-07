<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use App\Models\Watchlist;
use Illuminate\Support\Facades\DB;

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
        $watchlist = Watchlist::where('user_id', Auth::id())->pluck('movie_id')->toArray();
        // avg rating
        $averageRating = DB::select('SELECT GetAverageRating(?) AS avg_rating', [$movie->id]);
        return view('movies.show', compact('movie', 'watchlist', 'averageRating'));
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

    // search ajax
    public function searchAjax(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $search = $request->search;
        $movies = Movie::where('title', 'like', '%' . $search . '%')->get();

        return response()->json(['movies' => $movies]);
    }
}
