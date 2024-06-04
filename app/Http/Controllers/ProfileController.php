<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|unique:users,email,' . $user->id . '|email|max:255',
            'username' => 'nullable|unique:users,username,' . $user->id . '|regex:/^[a-zA-Z0-9_]+$/|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create a data array to store the updated values
        $data = $request->except(['image', 'password']);

        // Handle the username slug conversion
        if (isset($data['username'])) {
            $data['username'] = str_replace(' ', '_', $data['username']);
        } elseif (isset($data['name'])) {
            $data['username'] = str_replace(' ', '_', $data['name']);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = encrypt($user->id) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/users');

                // Ensure the destination directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $name);

                // Delete the old image if it exists
                if ($user->image && file_exists(public_path('/images/users/' . $user->image))) {
                    unlink(public_path('/images/users/' . $user->image));
                }

                // Update the image path in the data array
                $data['image'] = $name;
            }

            // Handle the password if provided
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }

            // Update the user data
            $user->update($data);

            // Commit the transaction
            DB::commit();

            // Redirect to the users index page with success message
            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            return redirect()->route('profile.edit')->with('error', 'An error occurred while updating the profile. ' . $e->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
