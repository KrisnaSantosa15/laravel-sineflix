<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGenreController;
use App\Http\Controllers\AdminStarsController;
use App\Http\Controllers\AdminMovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'member'])->name('dashboard');

Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // Admin Users
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{adminUser:username}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{adminUser:username}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{adminUser:username}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{adminUser:username}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // Admin Genres
    Route::get('/genres', [AdminGenreController::class, 'index'])->name('admin.genres.index');
    Route::get('/genres/create', [AdminGenreController::class, 'create'])->name('admin.genres.create');
    Route::post('/genres', [AdminGenreController::class, 'store'])->name('admin.genres.store');
    Route::get('/genres/{adminGenre:slug}', [AdminGenreController::class, 'show'])->name('admin.genres.show');
    Route::get('/genres/{adminGenre:slug}/edit', [AdminGenreController::class, 'edit'])->name('admin.genres.edit');
    Route::put('/genres/{adminGenre:slug}', [AdminGenreController::class, 'update'])->name('admin.genres.update');
    Route::delete('/genres/{adminGenre:slug}', [AdminGenreController::class, 'destroy'])->name('admin.genres.destroy');

    // Admin Stars
    Route::get('/stars', [AdminStarsController::class, 'index'])->name('admin.stars.index');
    Route::get('/stars/create', [AdminStarsController::class, 'create'])->name('admin.stars.create');
    Route::post('/stars', [AdminStarsController::class, 'store'])->name('admin.stars.store');
    Route::get('/stars/{adminStars:slug}', [AdminStarsController::class, 'show'])->name('admin.stars.show');
    Route::get('/stars/{adminStars:slug}/edit', [AdminStarsController::class, 'edit'])->name('admin.stars.edit');
    Route::put('/stars/{adminStars:slug}', [AdminStarsController::class, 'update'])->name('admin.stars.update');
    Route::delete('/stars/{adminStars:slug}', [AdminStarsController::class, 'destroy'])->name('admin.stars.destroy');

    // Admin Movies
    Route::get('/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
    Route::get('/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
    Route::post('/movies', [AdminMovieController::class, 'store'])->name('admin.movies.store');
    Route::get('/movies/{adminMovie:slug}', [AdminMovieController::class, 'show'])->name('admin.movies.show');
    Route::get('/movies/{adminMovie:slug}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
    Route::put('/movies/{adminMovie:slug}', [AdminMovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('/movies/{adminMovie:slug}', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');
});

require __DIR__ . '/auth.php';
