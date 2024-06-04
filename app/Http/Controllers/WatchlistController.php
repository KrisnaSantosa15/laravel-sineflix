<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watchlist;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class WatchlistController extends Controller
{

    public function index()
    {
        // Get the user's watchlist
        $watchlist = Watchlist::where('user_id', Auth::id())->get();
        $movies = $watchlist->pluck('movie_id')->toArray();
        $movieRecommendations = DB::select('CALL GenerateMovieRecommendations(?, ?)', [Auth::id(), 5]);
        // $myWatchlist = Movie::whereIn('id', $movies)->get();

        // get myWatchlist from view named UserWatchlist
        $myWatchlist = DB::select('SELECT * FROM UserWatchlist WHERE user_id = ?', [Auth::id()]);

        // Return the watchlist view with the watchlist data
        return view('watchlist', compact('myWatchlist', 'movieRecommendations'));
    }

    public function toggle(Request $request)
    {
        // Validate the request data
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Check if the movie is already in the watchlist
        $watchlist = Watchlist::where('user_id', Auth::id())
            ->where('movie_id', $request->movie_id)
            ->first();

        if ($watchlist) {
            // If it exists, remove it
            $watchlist->delete();
            return response()->json(['success' => true, 'action' => 'removed', 'message' => 'Movie removed from watchlist']);
        } else {
            // If it doesn't exist, add it
            Watchlist::create([
                'user_id' => Auth::id(),
                'movie_id' => $request->movie_id,
            ]);
            return response()->json(['success' => true, 'action' => 'added', 'message' => 'Movie added to watchlist']);
        }
    }

    public function delete(Request $request, Watchlist $watchlist)
    {
        // Validate the request data
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Check if the movie is in the watchlist
        $watchlist = Watchlist::where('user_id', Auth::id())
            ->where('movie_id', $request->movie_id)
            ->first();

        if ($watchlist) {
            // If it exists, remove it
            $watchlist->delete();
            return redirect()->back()->with('success', 'Movie removed from watchlist');
        } else {
            // If it doesn't exist, return an error
            return redirect()->back()->with('error', 'Movie not found in watchlist');
        }
    }
}
