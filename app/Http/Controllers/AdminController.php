<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as AdminUser;
use Illuminate\Support\Facades\DB;
use App\Models\LogActivity;

class AdminController extends Controller
{
    public function index()
    {
        // get latest 10 log activities
        $logActivities = LogActivity::latest()->take(10)->get();
        return view('admin.dashboard', compact('logActivities'));
    }

    // Admin Login
    public function login()
    {
        return view('admin.login');
    }

    // Admin Do Login
    public function doLogin(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (auth()->attempt($request->only('email', 'password'))) {
            // Redirect to the dashboard
            return redirect()->route('admin.dashboard');
        }

        // Redirect back to the login page
        return back()->with('error', 'Invalid login details');
    }

    // Admin Logout
    public function logout()
    {
        auth()->logout();

        return redirect()->route('admin.login');
    }

    // Admin Profile
    public function profile()
    {
        // Get the authenticated user
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    // Admin Settings
    public function settings()
    {
        return view('admin.settings');
    }

    // Admin Users
    public function users()
    {
        $users = AdminUser::when(request('keyword'), function ($query) {
            return $query->where('name', 'like', '%' . request('keyword') . '%');
        })
            ->where('id', '!=', auth()->id())
            ->paginate(2)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'unique:users|required|email',
            'username' => 'unique:users|nullable|regex:/^[a-zA-Z0-9_]+$/',
            'password' => 'required|string|min:8',
            'role' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        // make username like slug
        $request['username'] = $request['username'] ?? $request['name'];
        $request['username'] = str_replace(' ', '_', $request['username']);

        $user = adminUser::create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = encrypt($user->id) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/users');
            $image->move($destinationPath, $name);
            $user->image = $name;
            $user->save();
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function show(AdminUser $adminUser)
    {
        return view('admin.users.show', compact('adminUser'));
    }

    public function edit(AdminUser $adminUser)
    {
        return view('admin.users.edit', compact('adminUser'));
    }

    public function update(Request $request, AdminUser $adminUser)
    {
        // Validate the request
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|unique:users,email,' . $adminUser->id . '|email|max:255',
            'username' => 'nullable|unique:users,username,' . $adminUser->id . '|regex:/^[a-zA-Z0-9_]+$/|max:255',
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
                $name = encrypt($adminUser->id) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/users');

                // Ensure the destination directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $name);

                // Delete the old image if it exists
                if ($adminUser->image && file_exists(public_path('/images/users/' . $adminUser->image))) {
                    unlink(public_path('/images/users/' . $adminUser->image));
                }

                // Update the image path in the data array
                $data['image'] = $name;
            }

            // Handle the password if provided
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }

            // Update the user data
            $adminUser->update($data);

            // Commit the transaction
            DB::commit();

            // Redirect to the users index page with success message
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            return redirect()->route('admin.users.index')->with('error', 'An error occurred while updating the user, name or username can not be empty.');
        }
    }



    public function destroy(AdminUser $adminUser)
    {
        // Delete the star and the image from the storage
        $adminUser->delete();

        if ($adminUser->image) {
            $image_path = public_path('/images/users/' . $adminUser->image);
            if (file_exists($image_path)) unlink($image_path);
        }


        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}