<?php

namespace App\Http\Controllers;

use App\Models\Genre as AdminGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Define the number of items per page
        $perPage = 5;

        // Show all genres with pagination and search query from url
        $genres = AdminGenre::when(request('keyword'), function ($query) {
            return $query->where('name', 'like', '%' . request('keyword') . '%');
        })->paginate($perPage, ['*'], 'page')->withQueryString();

        // Calculate the starting item number for the current page
        $startItem = ($genres->currentPage() - 1) * $perPage + 1;

        return view('admin.genres.index', compact('genres', 'startItem'));


        return view('admin.genres.index', compact('genres'));
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

        // Validate request
        $request->validate([
            'name' => 'required|unique:genres',
        ]);

        // Store genre with slug generated from name
        $request['slug'] = Str::slug($request->name);
        AdminGenre::create($request->all());

        // Add session success message for toast
        session()->flash('success', 'Genre created successfully.');

        return redirect()->route('admin.genres.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminGenre $adminGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminGenre $adminGenre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminGenre $adminGenre)
    {
        // Update genre
        $request['slug'] = Str::slug($request->name);
        $adminGenre->update($request->all());

        // Add session success message for toast
        session()->flash('success', 'Genre updated successfully.');

        return redirect()->route('admin.genres.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminGenre $adminGenre)
    {
        // Delete genre
        $adminGenre->delete();

        // Add session success message for toast
        session()->flash('success', 'Genre deleted successfully.');

        return redirect()->route('admin.genres.index');
    }
}
