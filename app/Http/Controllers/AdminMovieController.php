<?php

namespace App\Http\Controllers;

use App\Models\Movie as AdminMovie;
use App\Models\Genre;
use App\Models\Stars;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show all movies with pagination and search query from url
        $types = ['MOVIE', 'SERIES', 'K-SERIES'];
        $genres = Genre::all();
        $stars = Stars::all();
        $movies = AdminMovie::when(request('keyword'), function ($query) {
            return $query->where('title', 'like', '%' . request('keyword') . '%');
        })->paginate(2)->withQueryString();

        return view('admin.movies.index', compact(['movies', 'genres', 'stars', 'types']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'release_date' => 'required',
            'type' => 'required',
            'director' => 'required',
            'plot_summary' => 'required',
            'rating' => 'required|numeric|min:0|max:5|',
            'poster_url' => 'required',
            'trailer_url' => 'required',
        ]);

        // Create a new movie
        $request['slug'] = Str::slug($request->title);
        AdminMovie::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'release_date' => $request->release_date,
            'type' => $request->type,
            'director' => $request->director,
            'plot_summary' => $request->plot_summary,
            'rating' => $request->rating,
            'poster_url' => $request->poster_url,
            'trailer_url' => $request->trailer_url,
        ]);

        // Add the genres to movies_genres table, the genres are stored in an array because it's a many to many relationship, and use select2 for the genres
        $movie = AdminMovie::whereSlug($request['slug'])->first();
        $movie->genres()->attach($request->genres);

        // Add the stars to movies_stars table
        $movie->stars()->attach($request->stars);
        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminMovie $adminMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminMovie $adminMovie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminMovie $adminMovie)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'release_date' => 'required',
            'type' => 'required',
            'director' => 'required',
            'plot_summary' => 'required',
            'rating' => 'required|numeric|min:0|max:5|',
            'poster_url' => 'required',
            'trailer_url' => 'required',
        ]);

        // Update a movie
        $request['slug'] = Str::slug($request->title);
        $adminMovie->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'release_date' => $request->release_date,
            'type' => $request->type,
            'director' => $request->director,
            'plot_summary' => $request->plot_summary,
            'rating' => $request->rating,
            'poster_url' => $request->poster_url,
            'trailer_url' => $request->trailer_url,
        ]);

        // Sync the genres to movies_genres table
        $adminMovie->genres()->sync($request->genres);

        // Sync the stars to movies_stars table
        $adminMovie->stars()->sync($request->stars);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminMovie $adminMovie)
    {
        // Delete a movie and detach the genres and stars from the pivot table
        $adminMovie->genres()->detach();
        $adminMovie->stars()->detach();
        $adminMovie->delete();
        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully');
    }
}
