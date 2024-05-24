<?php

namespace App\Http\Controllers;

use App\Models\Stars as AdminStars;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminStarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show all stars with pagination and search query from url
        $stars = AdminStars::when(request('keyword'), function ($query) {
            return $query->where('name', 'like', '%' . request('keyword') . '%');
        })->paginate(2)->withQueryString();

        return view('admin.stars.index', compact('stars'));
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
        // Validate the request, only name required, the rest is optional
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable',
            'biography' => 'nullable',
        ]);

        // Slug
        $request['slug'] = Str::slug($request->name);

        // if there's already a slug with the same name, add a random number to the slug
        if (AdminStars::whereSlug($request['slug'])->first()) {
            $request['slug'] = $request['slug'] . '-' . rand(1, 1000);
        }

        // if successful, it will create a new star and save the picture to the storage (if provided)
        $star = AdminStars::create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = encrypt($star->id) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/stars');
            $image->move($destinationPath, $name);
            $star->image = $name;
            $star->save();
        }

        // Redirect to the stars index page
        return redirect()->route('admin.stars.index')->with('success', 'Star created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminStars $adminStars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminStars $adminStars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminStars $adminStars)
    {
        // Slug
        $request['slug'] = Str::slug($request->name);

        // if there's already a slug with the same name, add a random number to the slug
        if (AdminStars::whereSlug($request['slug'])->where('id', '!=', $adminStars->id)->first()) {
            $request['slug'] = $request['slug'] . '-' . rand(1, 1000);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            $oldImagePath = public_path('/images/stars/' . $adminStars->image);

            // if there's a new image, handle the file upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = encrypt($adminStars->id) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/stars');

                // Ensure the destination directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $name);

                // If there was an old image, delete it
                if ($adminStars->image && file_exists($oldImagePath)) {
                    if (!unlink($oldImagePath)) {
                        throw new \Exception("Failed to delete old image at: $oldImagePath");
                    }
                }

                // Update the image path in the model
                $adminStars->image = $name;
            }

            // Update the rest of the model's data
            $adminStars->update($request->except('image')); // exclude image from update

            // Save the model again to ensure the image path is updated
            $adminStars->save();

            // Commit the transaction
            DB::commit();

            // Redirect to the stars index page
            return redirect()->route('admin.stars.index')->with('success', 'Star updated successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            return redirect()->route('admin.stars.index')->with('error', 'An error occurred while updating the star.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminStars $adminStars)
    {
        // Delete the star and the image from the storage
        $adminStars->delete();

        if ($adminStars->image) {
            $image_path = public_path('/images/stars/' . $adminStars->image);
            if (file_exists($image_path)) unlink($image_path);
        }

        // Redirect to the stars index page
        return redirect()->route('admin.stars.index')->with('success', 'Star deleted successfully');
    }
}
