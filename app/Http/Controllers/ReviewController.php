<?php

namespace App\Http\Controllers;

use App\Models\Review; // Import the Review model

use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import the Str class

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|numeric|between:0,10',
            'movie_id' => 'required|exists:movies,id',
        ]);

        Review::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Review added successfully!');
    }
}
